<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/Components/ui/select";

import { useForm, usePage, router } from "@inertiajs/vue3";
import { ref, onMounted, watch, computed } from "vue";

const props = defineProps({
    mode: String,
    affiliate_id: Number
});

const user = computed(() => usePage().props.auth.user);

const form = useForm({
    affiliate: {
        user_id: user.value.id,
        birthdate: null,
        cpf: null,
        phone_number: null,
    },
    address: {
        state: null,
        city: null,
        street: null,
    },
});

function removeNullEntries(obj) {
    return Object.fromEntries(Object.entries(obj).filter(([_, v]) => v !== null))
}

const selectedState = computed(() => form.address.state);

const states = ref([]);
const cities = ref([]);

async function fetchStates() {
    try {
        const response = await fetch(
            "https://servicodados.ibge.gov.br/api/v1/localidades/estados"
        );
        if (!response.ok) throw new Error("Error fetching states");
        states.value = await response.json();
    } catch (error) {
        console.error(error.message);
    }
}

async function fetchCities() {
    if (form.address.state) {
        try {
            const response = await fetch(
                `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${form.address.state}/municipios`
            );
            if (!response.ok) throw new Error("Error fetching cities");
            cities.value = await response.json();
        } catch (error) {
            console.error(error.message);
        }
    } else {
        cities.value = []; // Clear cities if no state is selected
    }
}

onMounted(fetchStates);

watch(selectedState, fetchCities);

function submit() {
    if (props.mode == "create") 
        form.post(route('affiliate.store'))
    else {
        form.affiliate = removeNullEntries(form.affiliate)
        form.address = removeNullEntries(form.address)
        form.patch(route('affiliate.update', props.affiliate_id), )
    }
}
</script>

<template>
    <form
        @submit.prevent="submit()"
        class="w-full gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3"
    >
        <div class="grid gap-1">
            <InputLabel for="cpf" value="CPF" />

            <TextInput
                id="cpf"
                type="text"
                class="px-2 h-8 mt-1 block w-full"
                v-model="form.affiliate.cpf"
                :required="mode == 'create'"
                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                placeholer="123.456.789-00"
                autofocus
            />
        </div>

        <div class="grid gap-1">
            <InputLabel for="birthdate" value="Birthdate" />

            <TextInput
                id="birthdate"
                type="date"
                placeholder="dd/mm/yyyy"
                class="px-2 h-8 mt-1 block w-full"
                maxlength="10"
                v-model="form.affiliate.birthdate"
                :required="mode == 'create'"
                pattern="\d{2}/\d{2}/\d{4}"
            />
        </div>

        <div class="grid gap-1">
            <InputLabel for="phone_number" value="Phone number" />

            <TextInput
                id="phone_number"
                type="text"
                placeholder="(11) 98765-4321"
                maxlength="15"
                class="px-2 h-8 mt-1 block w-full"
                v-model="form.affiliate.phone_number"
                :required="mode == 'create'"
            />
        </div>

        <div class="grid gap-1">
            <InputLabel for="state" value="State" />

            <Select id="state" v-model="form.address.state" :required="mode == 'create'">
                <SelectTrigger class="w-[180px]">
                    <SelectValue placeholder="Select a state" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectLabel>States</SelectLabel>
                        <SelectItem
                            v-for="state in states"
                            :key="state.id"
                            :value="state.sigla"
                            >{{ state.nome }}</SelectItem
                        >
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="grid gap-1">
            <InputLabel for="city" value="City" />

            <Select id="city" v-model="form.address.city" :required="mode == 'create'">
                <SelectTrigger class="w-[180px]">
                    <SelectValue placeholder="Select a city" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectLabel>Cities</SelectLabel>
                        <SelectItem
                            v-for="city in cities"
                            :key="city.id"
                            :value="city.nome"
                            >{{ city.nome }}</SelectItem
                        >
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>

        <div class="grid gap-1">
            <InputLabel for="street" value="Street" />

            <TextInput
                id="street"
                type="text"
                class="px-2 h-8 mt-1 block w-full"
                v-model="form.address.street"
                :required="mode == 'create'"
            />
        </div>

        <PrimaryButton class="w-fit" type="submit"> Send </PrimaryButton>
    </form>
</template>
