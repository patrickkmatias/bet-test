<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const user = usePage().props.auth.user;

const form = useForm({
    affiliate_id: user.affiliate.id,
    value: "",
});
</script>

<template>
    <form
        @submit.prevent="form.post(route('commissions.store'))"
        class="w-full gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3"
    >
        <div class="grid gap-1">
            <InputLabel for="value" value="Value" />

            <TextInput
                id="value"
                type="numeric"
                class="px-2 h-8 mt-1 block w-full"
                v-model="form.value"
                required
            />
        </div>

        <PrimaryButton class="w-fit" type="submit"> Send </PrimaryButton>
    </form>
</template>
