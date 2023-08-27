export interface UserInformation {
    information: Information;
    countries?: (CountriesEntity)[] | null;
}
export interface Information {
    id: number;
    name: string;
    email: string;
    email_verified_at?: null;
    created_at: string;
    updated_at: string;
    user_information: UserInformation1;
}
export interface UserInformation1 {
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
    country?: CountriesEntity | null;
}
export interface CountriesEntity {
    id: number;
    name: string;
    created_at: string;
    updated_at: string;
}
