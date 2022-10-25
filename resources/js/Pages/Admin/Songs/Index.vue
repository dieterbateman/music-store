<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import SongModal from "@/Components/SongModal.vue";

const props = defineProps({
    songs: Object,
    album: Object,
});
</script>

<template>
    <Head title="Admin" />

    <AuthenticatedLayout>
        <template #header>
            <div class="content-center h-24">
                <img
                    class="rounded-full float-left mx-3 h-24 w-24"
                    :src="album.artwork"
                    :alt="album.title + ' by ' + album.artist"
                />
                <div
                    class="pt-5 h-24 content-center clear-right font-extrabold text-2xl text-gray-700 leading-tight"
                >
                    <h1>
                        {{ album.title }} <br />
                        by {{ album.artist }} <br />
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-0 pb-6 items-center">
                            <Link
                                class="button btnGrey"
                                :href="route('albums.index')"
                                >Back</Link
                            >
                            <song-modal :album="album" class="float-right"></song-modal>
                        </div>
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
                                            Songs
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="song in songs"
                                        :key="song.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800"
                                    >
                                        <!-- <td class="py-4 px-6">
                                            <img
                                                class="h-20 w-20"
                                                :src="album.artwork"
                                                :alt="
                                                    album.title +
                                                    ' by ' +
                                                    album.artist
                                                "
                                            />
                                        </td> -->
                                        <th
                                            scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            {{ song.title }}
                                        </th>
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
