export interface CheckoutUserType {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    created_at: string;
    updated_at: string;
    user_information: UserInformation | null;
}

export interface UserInformation {
    id?: number;
    user_id?: number;
    first_name?: string;
    last_name?: string;
    company_name?: string;
    address?: string;
    address2?: string;
    city?: string;
    country_id?: number;
    state_province?: string;
    zip_postal_code?: string;
    phone?: string;
    created_at?: string;
    updated_at?: string;
    country?: Country;
}

export interface Country {
    id: number;
    name: string;
    created_at: string;
    updated_at: string;
}
