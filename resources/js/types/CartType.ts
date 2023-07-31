export interface Cart {
    [key: string]: CartType;
}

export interface CartType {
    id: number;
    rowId: string;
    name: string;
    qty: number;
    price: number;
    options: Options;
    tax: string;
    subtotal: string;
}

export interface Options {
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
