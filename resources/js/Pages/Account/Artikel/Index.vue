<template>
    <AuthenticatedLayout>
        <!-- form -->
        <div class="flex justify-center">
            <form @submit.prevent="submit">
                <select v-model="form.kategori_id" required>
                    <option value="">-Select kategori</option>
                    <option v-for="kategori in kategoris" :key="kategori.id" :value="kategori.id">{{ kategori.name
                        }}</option>
                </select>
                <input type="file" @input="form.tumbnail = $event.target.files[0]" />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
                <TextInput type="text" required v-model="form.judul" placeholder="ex : Tutorial Laravel 11 CRUD" />
                <TextInput type="text" required v-model="form.isi" placeholder="ex : Bla bla bla.." />
                <PrimaryButton>Save</PrimaryButton>
            </form>
        </div>
        <!-- end form -->

        <div class="py-12 flex">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- kontent -->
                        <!-- data -->
                        <div>
                            <div class="form-bold text-3xl pb-3">Artikel List</div>
                            <div v-for="artikel in artikels" :key="artikel.id">
                                <p>{{ artikel.judul }} <span class="text-gray-400 text-xs">{{ new
                Date(artikel.updated_at).toLocaleDateString()
                                        }}</span>
                                </p>
                                <div>
                                    <img :src="showImage() + artikel.tumbnail" class="object-cover h-40 w-80" />
                                </div>
                                <DangerButton @click="destroy(artikel.id)">Delete</DangerButton>
                            </div>
                        </div>
                        <!-- end data -->
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
AuthenticatedLayout
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    artikels: Object,
    kategoris: Object,
});

const form = useForm({
    judul: '',
    isi: '',
    kategori_id: '',
    tumbnail: '',
});

const submit = () => {
    form.post(route("account.artikel.store"), {
        preserveState: false,
        preserveScroll: true,
    });
};

const showImage = () => {
    return "/storage/artikel/";
};


//destroy
const destroy = (artikel) => {
    if (confirm("APA KAMU YAKIN AKAN HAPUS?")) {
        form.delete(route('account.artikel.destroy', artikel));
    }
}
</script>

<style lang="scss" scoped></style>