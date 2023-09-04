export interface UserOrders {
    orders: Orders;
}

export interface Orders {
    all?: (AllEntityOrPendingEntityOrProcessingEntityOrShippedEntityOrCompletedEntityOrCancelledEntity)[] | null;
    pending?: (AllEntityOrPendingEntityOrProcessingEntityOrShippedEntityOrCompletedEntityOrCancelledEntity)[] | null;
    processing?: (AllEntityOrPendingEntityOrProcessingEntityOrShippedEntityOrCompletedEntityOrCancelledEntity)[] | null;
    shipped?: (AllEntityOrPendingEntityOrProcessingEntityOrShippedEntityOrCompletedEntityOrCancelledEntity)[] | null;
    completed?: (AllEntityOrPendingEntityOrProcessingEntityOrShippedEntityOrCompletedEntityOrCancelledEntity)[] | null;
    cancelled?: (AllEntityOrPendingEntityOrProcessingEntityOrShippedEntityOrCompletedEntityOrCancelledEntity)[] | null;
}

export interface AllEntityOrPendingEntityOrProcessingEntityOrShippedEntityOrCompletedEntityOrCancelledEntity {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    created_at: string;
    updated_at: string;
    user_orders?: (UserOrdersEntity)[] | null;
}

export interface UserOrdersEntity {
    id: number;
    user_id: number;
    order_date: string;
    total_amount: string;
    status: string;
    created_at: string;
    updated_at: string;
    user_order_items?: (UserOrderItemsEntity)[] | null;
}

export interface UserOrderItemsEntity {
    id: number;
    user_order_id: number;
    product_id: number;
    product_sku: string;
    product_name: string;
    product_price: string;
    quantity: number;
    created_at: string;
    updated_at: string;
    product: Product;
}

export interface Product {
    id: number;
    sku: string;
    name: string;
    slug: string;
    information_id: number;
    created_at: string;
    updated_at: string;
    information: Information;
}

export interface Information {
    id: number;
    product_id: number;
    description: string;
    price: string;
    product_information_picture_id: number;
    highlights: string;
    stock: string;
    category_id: number;
    created_at: string;
    updated_at: string;
    category: Category;
    product_information_picture: ProductInformationPicture;
}

export interface Category {
    id: number;
    name: string;
    created_at: string;
    updated_at: string;
}

export interface ProductInformationPicture {
    id: number;
    product_information_id: number;
    image: string;
    created_at: string;
    updated_at: string;
}
