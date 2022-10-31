<template>
    <Head title="Admin" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                View and Add Albums
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <album-modal
                            :artists="artists" :isModalOpen="false"
                        ></album-modal>
                        <br />
                        <div
                            class="overflow-x-auto relative shadow-md sm:rounded-lg"
                        >
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-s text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            Artwork
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Title
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Artist
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Genre
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="album in albums"
                                        :key="album.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800"
                                    >
                                        <td class="py-4 px-6">
                                            <img
                                                class="h-16 w-16"
                                                :src="album.artwork"
                                                :alt="
                                                    album.title +
                                                    ' by ' +
                                                    album.artist
                                                "
                                            />
                                        </td>
                                        <th
                                            scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            {{ album.title }}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ album.artist }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ album.genre }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <button
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                @click="
                                                    Inertia.get(
                                                        route('songs.show', {
                                                            album: album.id,
                                                        })
                                                    )
                                                "
                                            >
                                                Songs
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import AlbumModal from "@/Components/AlbumModal.vue";
import { Inertia } from "@inertiajs/inertia";


const props = defineProps({
    albums: Object,
    artists: Object,
});
</script>
