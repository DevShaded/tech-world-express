<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/Information/TextInput.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { User } from "@/types";

const user: User = usePage().props.auth.user;

const form = useForm({
    user_id: user.id,
    card_number: null,
    card_name: null,
    card_expiry: null,
    card_cvv: null,
});

const submit = () => {
    form.patch(route("billing.update"), {
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
                <InputLabel for="cc-number">Credit Card Number</InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="cc-number" v-model="form.card_number" name="cc-number" type="text"
                        autocomplete="cc-number"/>
                </div>

                <InputError
                    :message="form.errors.card_number"
                    class="mt-2"
                />
            </div>

            <div class="col-span-full">
                <InputLabel for="cc-number">Name on card</InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="card_name" v-model="form.card_name" name="card_name" type="text"
                        autocomplete="name"/>
                </div>

                <InputError
                    :message="form.errors.card_name"
                    class="mt-2"
                />
            </div>

            <div class="sm:col-span-3">
                <InputLabel for="expiration-date">Expiration date (MM/YY)</InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="expiration-date" v-model="form.card_expiry" type="text" name="expiration-date"
                        autocomplete="cc-exp"/>
                </div>

                <InputError
                    :message="form.errors.card_expiry"
                    class="mt-2"
                />
            </div>

            <div class="sm:col-span-3">
                <InputLabel for="cvc">
                    CVV
                </InputLabel>

                <div class="mt-2">
                    <TextInput
                        id="cvc"
                        v-model="form.card_cvv"
                        type="text"
                        name="cvc"
                        autocomplete="cc-csc"
                    />
                </div>

                <InputError
                    :message="form.errors.card_cvv"
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
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
