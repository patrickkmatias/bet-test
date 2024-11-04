<script setup>
import { Head, router, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateCommissionForm from "./Partials/CreateCommissionForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { computed, ref } from "vue";
import Card from "@/Components/ui/card/Card.vue";
import CardHeader from "@/Components/ui/card/CardHeader.vue";
import CardTitle from "@/Components/ui/card/CardTitle.vue";
import CardDescription from "@/Components/ui/card/CardDescription.vue";
import CardContent from "@/Components/ui/card/CardContent.vue";

defineProps({
    commissions: Array
})

const showForm = ref(false);

// const commissions = computed(() => usePage().props.auth.user.affiliate.commissions);

function deleteCommission(id) {
    return router.delete(route('commissions.destroy', id))
}

</script>

<template>
    <Head title="Commissions" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Commissions
                </h2>
                <PrimaryButton @click="showForm = !showForm">
                    {{ showForm ? "Close form" : "Create Commission" }}
                </PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="grid gap-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    v-if="showForm"
                    class="p-6 flex flex-wrap overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <CreateCommissionForm></CreateCommissionForm>
                </div>

                <div
                    class="p-6 grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <p v-if="commissions.length == 0">
                        You have no commissions!
                    </p>
                    <Card v-for="c in commissions">
                        <CardHeader>
                            <CardTitle>Commission {{ c.id }}</CardTitle>
                            <CardDescription>Value: {{ c.value }}</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <PrimaryButton
                                title="Delete commission"
                                @click="deleteCommission(c.id)"
                            >
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </PrimaryButton>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
