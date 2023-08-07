export interface CheckoutType {
    data: Data;
}
export interface Data {
    user: User;
    order: Order;
}
export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: null;
    created_at: string;
    updated_at: string;
    user_information: UserInformation;
    user_billing: UserBilling;
    user_shipping: UserShipping;
}
export interface UserInformation {
    id: number;
    user_id: number;
    first_name: string;
    last_name: string;
    company_name: string;
    address: string;
    address2?: null;
    city: string;
    country_id?: null;
    state_province: string;
    zip_postal_code: string;
    phone: string;
    created_at: string;
    updated_at: string;
    country?: null;
}
export interface UserBilling {
    id: number;
    user_id: number;
    card_number: number;
    card_name: string;
    card_expiry: string;
    card_cvv: string;
    created_at: string;
    updated_at: string;
}
export interface UserShipping {
    id: number;
    user_id: number;
    shipping_address: string;
    shipping_city: string;
    shipping_state_province: string;
    shipping_country: string;
    created_at: string;
    updated_at: string;
}
export interface Order {
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
