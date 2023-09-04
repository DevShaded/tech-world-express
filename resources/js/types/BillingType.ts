export interface BillingInformation {
    billing: Billing;
}

export interface Billing {
    data?: (DataEntity)[] | null;
}

export interface DataEntity {
    id: number;
    card_number: number;
    card_name: string;
    card_expiry: string;
    card_cvv: string;
    created_at: string;
    updated_at: string;
    user_id: number;
    user: User;
}

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: null;
    created_at: string;
    updated_at: string;
}
