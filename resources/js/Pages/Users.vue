<script setup>
import {
  Card,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card'

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    users: Array
})
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Registered users
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <Card v-for="u in users" >
                        <CardHeader>
                            <CardTitle>{{ u.name }}</CardTitle>
                            <CardDescription>{{ u.email }}</CardDescription>
                        </CardHeader>
                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
