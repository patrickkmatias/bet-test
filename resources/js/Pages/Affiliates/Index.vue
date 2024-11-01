<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateEditAffiliateForm from "./Partials/CreateEditAffiliateForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {
    Card,
    CardDescription,
    CardHeader,
    CardTitle,
    CardContent,
} from "@/Components/ui/card";

import { usePage, Head, router } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";

defineProps({
    affiliates: Array,
});

const showForm = ref(false);

const user = computed(() => usePage().props.auth.user);

const affiliate = computed(() => user.value.affiliate);

function toggleAffiliateActivation(id, isActive) {
    router.patch(route("affiliate.update", id), {
        affiliate: {
            active: !isActive,
        },
    });
}

watch(affiliate, () => (showForm.value = false), { deep: true });
</script>
<template>
    <Head title="Affiliates" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Affiliates
                </h2>
                <span class="flex gap-4">
                    <PrimaryButton @click="showForm = !showForm">
                        {{
                            showForm
                                ? "Close form"
                                : affiliate
                                ? "Edit affiliate data"
                                : "Become affiliate"
                        }}
                    </PrimaryButton>
                    <PrimaryButton
                        v-if="affiliate"
                        @click="
                            toggleAffiliateActivation(
                                affiliate.id,
                                affiliate.active
                            )
                        "
                    >
                        {{ affiliate.active ? "in" : "" }}activate affiliation
                    </PrimaryButton>
                </span>
            </div>
        </template>

        <div class="py-12">
            <div class="grid gap-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    v-if="showForm"
                    class="p-6 flex flex-wrap overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <CreateEditAffiliateForm
                        :mode="affiliate ? 'edit' : 'create'"
                        :affiliate_id="affiliate ? affiliate.id : null"
                    ></CreateEditAffiliateForm>
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
                        <CardContent>
                            <PrimaryButton
                                title="Inactivate affiliate"
                                @click="
                                    toggleAffiliateActivation(a.id, a.active)
                                "
                            >
                                <span class="material-symbols-outlined">
                                    expand_circle_down
                                </span>
                            </PrimaryButton>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
