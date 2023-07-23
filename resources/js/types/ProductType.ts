export interface Product {
    id: number;
    sku: string;
    name: string;
    slug: string;
    information_id: number;
    specification_id: number;
    created_at: string;
    updated_at: string;
    information: Information;
    specifications: Specification[];
    faqs?: FaqsEntity[] | null;
    reviews?: ReviewsEntity[] | null;
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
    product_information_picture: ProductInformationPicture;
    category: Category;
}

export interface ProductInformationPicture {
    id: number;
    product_information_id: number;
    image: string;
    created_at: string;
    updated_at: string;
}

export interface Category {
    id: number;
    name: string;
    created_at: string;
    updated_at: string;
}

export interface Specification {
    id: number;
    product_id: number;
    name: string;
    value: string;
    created_at: string;
    updated_at: string;
}

export interface FaqsEntity {
    id: number;
    product_id: number;
    question: string;
    answer: string;
    created_at: string;
    updated_at: string;
}

export interface ReviewsEntity {
    id: number;
    product_id: number;
    user_id: number;
    content: string;
    rating: number;
    created_at: string;
    updated_at: string;
    user: User;
}

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    created_at: string;
    updated_at: string;
}
