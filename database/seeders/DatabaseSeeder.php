<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category\Category;
use App\Models\Product\Information\ProductInformation;
use App\Models\Product\Information\ProductInformationPicture;
use App\Models\Product\Product;
use App\Models\Product\ProductFaqs;
use App\Models\Product\ProductReviews;
use App\Models\Product\ProductSpecifications;
use App\Models\User;
use App\Models\User\UserBilling;
use App\Models\User\UserInformation;
use App\Models\User\UserOrder;
use App\Models\User\UserOrderItem;
use App\Models\User\UserShipping;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public array $categories = [
        "laptops",
        "smartphones",
        "tablets",
        "gaming",
        "audio",
        "cameras",
        "tvs",
        "wearables",
        "accessories",
        "networking",
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = resolve(DatabaseSeeder::class)->categories;

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }

        $users = User::factory(10)->create();
        $products = Product::factory(10)->create();

        foreach ($users as $user) {
            UserBilling::factory()->create([
                'user_id' => $user['id'],
            ]);

            UserInformation::factory()->create([
                'user_id' => $user['id'],
            ]);

            $userOrders = UserOrder::factory(10)->create([
                'user_id' => $user['id'],
            ]);

            foreach ($products as $product) {
                foreach ($userOrders as $userOrder) {
                    UserOrderItem::factory()->create([
                        'user_order_id' => $userOrder['id'],
                        'product_id' => $product['id']
                    ]);
                }
            }

            UserShipping::factory()->create([
                'user_id' => $user['id']
            ]);
        }

        foreach ($products as $product) {
            // get all categories from database
            $categories = Category::all();

            $productInfo = ProductInformation::factory()->create([
                'product_id' => $product['id'],
                'category_id' => $categories->random()->id,
            ]);

            $productInfoPicture = ProductInformationPicture::factory()->create([
                'product_information_id' => $productInfo->id,
            ]);

            $productInfo->where('id', $productInfo->id)->update([
                'product_information_picture_id' => $productInfoPicture->id,
            ]);

            ProductSpecifications::factory(4)->create([
                'product_id' => $product['id'],
            ]);

            $product->where('id', $product->id)->update([
                'information_id' => $productInfo->id,
            ]);

            ProductFaqs::factory(4)->create([
                'product_id' => $product['id'],
            ]);

            ProductReviews::factory(4)->create([
                'product_id' => $product['id'],
            ]);
        }
    }
}

