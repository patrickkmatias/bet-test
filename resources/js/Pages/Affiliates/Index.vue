<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateEditAffiliateForm from "./Partials/CreateEditAffiliateForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {
    Card,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";

import { usePage, Head, router } from "@inertiajs/vue3";
import { computed, ref } from "vue";

defineProps({
    affiliates: Array,
});

const viewEditForm = ref(false);

const state = ref("idle");

const user = computed(() => usePage().props.auth.user);

const isActive = computed(() => user.value.affiliate.active);

function toggleAffiliateActivation(id, isActive) {
    router.patch(route("affiliate.update", id), {
        affiliate: {
            active: !isActive,
        },
    });
}
</script>
<template>
    <Head title="Affiliates" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Affiliates
                </h2>
                <PrimaryButton
                    v-if="!user.affiliate"
                    @click="state = 'show_edit_form'"
                >
                    {{
                        state == "show_edit_form"
                            ? "Close form"
                            : "Become affiliate"
                    }}
                </PrimaryButton>
                <PrimaryButton
                    v-if="user.affiliate"
                    @click="toggleAffiliateActivation(user.affiliate.id, user.affiliate.active)"
                >
                    {{ isActive ? "in" : "" }}activate affiliation
                </PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="grid gap-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    v-if="state == 'show_edit_form' && !user.affiliate"
                    class="p-6 flex flex-wrap overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <CreateEditAffiliateForm></CreateEditAffiliateForm>
                </div>

                <!-- <div class="p-6 flex flex-wrap overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <PrimaryButton>
                        Edit your data
                    </PrimaryButton>
                </div> -->

                <div
                    class="p-6 grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <Card v-for="a in affiliates">
                        <CardHeader>
                            <CardTitle>{{ a.user.name }}</CardTitle>
                            <CardDescription>{{ a.cpf }}</CardDescription>
                            <CardDescription>{{
                                a.phone_number
                            }}</CardDescription>
                        </CardHeader>
                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
