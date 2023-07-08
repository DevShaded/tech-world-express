<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Category\Category::factory(10)->create();
        $users = \App\Models\User::factory(10)->create();
        $products = \App\Models\Product\Product::factory(10)->create();

        foreach ($users as $user) {
            \App\Models\User\UserBilling::factory()->create([
                'user_id' => $user['id'],
            ]);

            \App\Models\User\UserInformation::factory()->create([
                'user_id' => $user['id'],
            ]);

            $userOrders = \App\Models\User\UserOrder::factory(10)->create([
                'user_id' => $user['id'],
            ]);

            foreach ($products as $product) {
                foreach ($userOrders as $userOrder) {
                    \App\Models\User\UserOrderItem::factory()->create([
                        'user_order_id' => $userOrder['id'],
                        'product_id' => $product['id']
                    ]);
                }
            }

            \App\Models\User\UserShipping::factory()->create([
                'user_id' => $user['id']
            ]);
        }

        foreach ($products as $product) {
            $productInfo = \App\Models\Product\Information\ProductInformation::factory()->create([
                'product_id' => $product['id']
            ]);

            $productInfoPicture = \App\Models\Product\Information\ProductInformationPicture::factory()->create([
                'product_information_id' => $productInfo->id,
            ]);

            $productInfo->where('id', $productInfo->id)->update([
                'product_information_picture_id' => $productInfoPicture->id,
            ]);

            $productSpecification = \App\Models\Product\ProductSpecification::factory()->create([
                'product_id' => $product['id'],
            ]);

            $product->where('id', $product->id)->update([
                'information_id' => $productInfo->id,
                'specification_id' => $productSpecification->id,
            ]);

            \App\Models\Product\ProductFaqs::factory(4)->create([
                'product_id' => $product['id'],
            ]);

            \App\Models\Product\ProductReviews::factory(4)->create([
                'product_id' => $product['id'],
            ]);
        }
    }
}

