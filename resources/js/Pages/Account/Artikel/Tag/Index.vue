<template>
    <AuthenticatedLayout>
        <div class="py-12 flex">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- kontent -->
                        <!-- data -->
                        <div>
                            <div class="form-bold text-3xl pb-3">Tag List</div>
                            <div v-for="tag in tags" :key="tag.id">
                                <p>{{ tag.name }} <span class="text-gray-400 text-xs">{{ new
                                Date(tag.created_at).toLocaleDateString()
                                        }}</span>
                                </p>
                            </div>
                        </div>
                        <!-- end data -->
                    </div>
                </div>
            </div>
        </div>

        <!-- form -->
        <div class="flex justify-center">
            <form @submit.prevent="submit">
                <TextInput type="text" required v-model="form.name" placeholder="ex : Nginx" />
                <PrimaryButton>Save</PrimaryButton>
            </form>
            <!-- end form -->
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
AuthenticatedLayout
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    tags: Object,
});

const form = useForm({
    name: '',
});

const submit = () => {
    form.post(route("account.tag.store"), {
        preserveState: false,
        preserveScroll: true,
    });
};
</script>

<style lang="scss" scoped></style>