<script lang="ts" setup>
import { Product } from "@/types/ProductType";
import ProductImage from "@/Components/Product/ProductImage.vue";
import ProductDetails from "@/Components/Product/ProductDetails.vue";
import ProductTabGroup from "@/Components/Product/ProductTabGroup.vue";

defineProps<{
    product: Product;
}>();
</script>

<template>
    <div
        class="lg:grid lg:grid-cols-7 lg:grid-rows-1 lg:gap-x-8 lg:gap-y-10 xl:gap-x-16"
    >
        <!-- Product image -->
        <ProductImage
            :image="product.information.product_information_picture.image"
            :name="product.name"
        />

        <!-- Product details -->
        <ProductDetails
            :category="product.information.category.name"
            :description="product.information.description"
            :highlights="product.information.highlights"
            :name="product.name"
            :price="product.information.price"
        />

        <div
            class="mx-auto mt-16 w-full max-w-2xl lg:col-span-4 lg:mt-0 lg:max-w-none"
        >
            <ProductTabGroup
                :category-name="product.information.category.name"
                :faqs="product.faqs"
                :product-id="product.id"
                :reviews="product.reviews"
                :specification="product.specifications"
            />
        </div>
    </div>
</template>

<style scoped></style>
