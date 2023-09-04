<script setup lang="ts">
import { computed, ComputedRef } from "vue";
import { User } from "@/types";
import { useForm, usePage } from "@inertiajs/vue3";
import { UserInformation } from "@/types/UserInformationType";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/Information/TextInput.vue";

const props = defineProps<{
    data: UserInformation;
}>();

const user: ComputedRef<User> = computed((): User => {
    return usePage().props.auth.user;
});

const form = useForm({
    user_id: user.value.id,
    name: props.data.information.name ?? null,
    email: props.data.information.email ?? null,
    first_name: props.data.information.user_information?.first_name ?? null,
    last_name: props.data.information.user_information?.last_name ?? null,
    company_name: props.data.information.user_information?.company_name ?? null,
    address: props.data.information.user_information?.address ?? null,
    address2: props.data.information.user_information?.address2 ?? null,
    city: props.data.information.user_information?.city ?? null,
    country: props.data.information.user_information?.country?.name ?? null,
    state_province: props.data.information.user_information?.state_province ?? null,
    zip_postal_code: props.data.information.user_information?.zip_postal_code ?? null,
    phone: props.data.information.user_information?.phone ?? null,
});

const submit = () => {
    form.patch(route("information.update"), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <form class="md:col-span-2" @submit.prevent="submit">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
            <div class="col-span-full">
                <InputLabel for="name">Name</InputLabel>

                <div class="mt-2">
                    <div
                        class="flex rounded-md ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                        <TextInput
                            id="name" v-model="form.name" type="text" name="name" autocomplete="username"
                            :placeholder="data.information.name"/>
                    </div>

                    <InputError
                        :message="form.errors.name"
                        class="mt-2"
                    />
                </div>
            </div>

            <div class="col-span-full">
                <InputLabel for="email">Email address</InputLabel>

                <div class="mt-2">
                    <TextInput id="email" v-model="form.email" name="email" type="email" autocomplete="email"/>
                </div>

                <InputError
                    :message="form.errors.email"
                    class="mt-2"
                />
            </div>

            <div class="sm:col-span-3">
                <InputLabel for="first-name">First Name</InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="first-name" v-model="form.first_name" type="text" name="first-name"
                        autocomplete="given-name"/>
                </div>

                <InputError
                    :message="form.errors.first_name"
                    class="mt-2"
                />
            </div>

            <div class="sm:col-span-3">
                <InputLabel for="last-name">Last name</InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="last-name"
                        v-model="form.last_name"
                        type="text"
                        name="last-name"
                        autocomplete="family-name"
                    />
                </div>

                <InputError
                    :message="form.errors.last_name"
                    class="mt-2"
                />
            </div>

            <div class="col-span-full">
                <InputLabel for="company">Company</InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="company" v-model="form.company_name" name="company" type="text"
                        autocomplete="organization"/>
                </div>

                <InputError
                    :message="form.errors.company_name"
                    class="mt-2"
                />
            </div>

            <div class="col-span-full">
                <InputLabel for="address">Address</InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="address" v-model="form.address" name="address" type="text" autocomplete="street-address"/>
                </div>

                <InputError
                    :message="form.errors.address"
                    class="mt-2"
                />
            </div>

            <div class="col-span-full">
                <InputLabel for="address2">
                    Apartment, suite, etc.
                </InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="address2" v-model="form.address2" name="address2" type="text" autocomplete="text"/>
                </div>

                <InputError
                    :message="form.errors.address2"
                    class="mt-2"
                />
            </div>

            <div class="sm:col-span-3">
                <InputLabel for="city">
                    City
                </InputLabel>

                <div class="mt-2">
                    <TextInput id="city" v-model="form.city" type="text" name="city" autocomplete="address-level2"/>
                </div>

                <InputError
                    :message="form.errors.city"
                    class="mt-2"
                />
            </div>

            <div class="sm:col-span-3">
                <InputLabel for="last-name">Country</InputLabel>

                <div class="mt-2">
                    <select
                        id="country"
                        v-model="form.country"
                        autocomplete="country-name"
                        class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                        name="country"
                    >
                        <option
                            v-for="country in data.countries?.sort((a, b) => a.name.localeCompare(b.name))"
                            :key="country.id"
                        >
                            {{ country.name }}
                        </option>
                    </select>
                </div>

                <InputError
                    :message="form.errors.country"
                    class="mt-2"
                />
            </div>

            <div class="sm:col-span-3">
                <InputLabel for="region">
                    Sate / Province
                </InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="region" v-model="form.state_province" type="text" name="region"
                        autocomplete="address-level1"/>
                </div>

                <InputError
                    :message="form.errors.state_province"
                    class="mt-2"
                />
            </div>

            <div class="sm:col-span-3">
                <InputLabel for="zip_postal_code">
                    Postal code
                </InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="zip_postal_code" v-model="form.zip_postal_code" type="text" name="zip_postal_code"
                        autocomplete="postal-code"/>
                </div>

                <InputError
                    :message="form.errors.zip_postal_code"
                    class="mt-2"
                />
            </div>

            <div class="col-span-full">
                <InputLabel for="phone">
                    Phone
                </InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="phone" v-model="form.phone" name="phone" type="text" autocomplete="tel"/>
                </div>

                <InputError
                    :message="form.errors.phone"
                    class="mt-2"
                />
            </div>
        </div>

        <div class="mt-8 flex">
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved. Refresh to
                        see
                        changes!</p>
                </Transition>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
