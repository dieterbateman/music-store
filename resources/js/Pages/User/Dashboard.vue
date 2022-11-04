<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Music Overview
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="text-xl"></h1>
                        <div class="flex shrink gap-2">
                            <input
                                type="text"
                                placeholder="Search"
                                class="!w-48 txtInput"
                                v-model="search"
                            /><select
                                class="!w-28 txtInput"
                                name="searchBy"
                                id="searchBy"
                                v-model="searchBy"
                            >
                                <option value="any" selected>All</option>
                                <option value="title">Album</option>
                                <option value="artist">Artist</option>
                                <option value="genre">Genre</option>
                            </select>

                            <!-- here -->
                            <div class="w-full">
                                <div class="flex shrink gap-2 float-right">
                                    <select
                                        class="txtInput"
                                        name="sortBy"
                                        id="sortBy"
                                        v-model="sortBy"
                                        @change="
                                            ascending = true;
                                            sortAlbums();
                                        "
                                    >
                                        <option value="">Sort by</option>
                                        <option value="artist">Artist</option>
                                        <option value="genre">Genre</option>
                                    </select>
                                    <button
                                        class="pr-2"
                                        type="button"
                                        v-if="ascending"
                                        @click="sortAlbums()"
                                    >
                                        <svg
                                            width="20px"
                                            height="20px"
                                            viewBox="0 0 20 20"
                                            version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                        >
                                            <!-- Uploaded to SVGRepo https://www.svgrepo.com -->
                                            <title>
                                                ic_fluent_text_sort_descending_20_filled
                                            </title>
                                            <desc>Created with Sketch.</desc>
                                            <g
                                                id="🔍-System-Icons"
                                                stroke="none"
                                                stroke-width="1"
                                                fill="none"
                                                fill-rule="evenodd"
                                            >
                                                <g
                                                    id="ic_fluent_text_sort_descending_20_filled"
                                                    fill="#212121"
                                                    fill-rule="nonzero"
                                                >
                                                    <path
                                                        d="M13.5000006,2 C13.9142,2 14.25,2.33579 14.25,2.75 L14.25,15.5241 L16.7383,13.2017 C17.0411,12.9191 17.5157,12.9355 17.7983,13.2383 C18.0809,13.5411 18.0646,14.0157 17.7617,14.2983 L14.0117,17.7983 C13.7236,18.0672 13.2764,18.0672 12.9883,17.7983 L9.23826,14.2983 C8.93545,14.0157 8.91909,13.5411 9.20171,13.2383 C9.48434,12.9355 9.95893,12.9191 10.2617,13.2017 L12.75,15.5241 L12.75,2.75 C12.75,2.33579 13.0858,2 13.5000006,2 Z M6.00002,10 C6.31967,10 6.6042,10.2026 6.70876,10.5047 L8.95876,17.0047 C9.09425,17.3961 8.88678,17.8232 8.49535,17.9587 C8.10393,18.0942 7.67677,17.8868 7.54128,17.4953 L7.19674,16.5 L4.8033,16.5 L4.45876,17.4953 C4.32327,17.8868 3.89611,18.0942 3.50469,17.9587 C3.11326,17.8232 2.90579,17.3961 3.04128,17.0047 L5.29128,10.5047 C5.39584,10.2026 5.68037,10 6.00002,10 Z M6.00002,13.0428 L5.32253,15 L6.67751,15 L6.00002,13.0428 Z M8,2 C8.2821,2 8.54033,2.15829 8.66834,2.40967 C8.79635,2.66104 8.77247,2.96299 8.60656,3.19113 L5.47283,7.5 L8,7.5 C8.41422,7.5 8.75,7.83579 8.75,8.25 C8.75,8.66421 8.41422,9 8,9 L4,9 C3.71791,9 3.45967,8.84171 3.33167,8.59033 C3.20366,8.33896 3.22753,8.03701 3.39345,7.80887 L6.52718,3.5 L4,3.5 C3.58579,3.5 3.25,3.16421 3.25,2.75 C3.25,2.33579 3.58579,2 4,2 L8,2 Z"
                                                        id="🎨-Color"
                                                    ></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                    <button
                                        class="pr-2"
                                        type="button"
                                        v-if="!ascending"
                                        @click="sortAlbums()"
                                    >
                                        <svg
                                            width="20px"
                                            height="20px"
                                            viewBox="0 0 20 20"
                                            version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                        >
                                            <!-- Uploaded to SVGRepo https://www.svgrepo.com -->
                                            <title>
                                                ic_fluent_text_sort_ascending_20_filled
                                            </title>
                                            <desc>Created with Sketch.</desc>
                                            <g
                                                id="🔍-System-Icons"
                                                stroke="none"
                                                stroke-width="1"
                                                fill="none"
                                                fill-rule="evenodd"
                                            >
                                                <g
                                                    id="ic_fluent_text_sort_ascending_20_filled"
                                                    fill="#212121"
                                                    fill-rule="nonzero"
                                                >
                                                    <path
                                                        d="M8,11 C8.2821,11 8.54033,11.1583 8.66834,11.4097 C8.79635,11.661 8.77247,11.963 8.60656,12.1911 L5.47283,16.5 L8,16.5 C8.41422,16.5 8.75,16.8358 8.75,17.25 C8.75,17.6642 8.41422,18 8,18 L4,18 C3.71791,18 3.45967,17.8417 3.33167,17.5903 C3.20366,17.339 3.22753,17.037 3.39345,16.8089 L6.52718,12.5 L4,12.5 C3.58579,12.5 3.25,12.1642 3.25,11.75 C3.25,11.3358 3.58579,11 4,11 L8,11 Z M13.5000006,2 C13.9142,2 14.25,2.33579 14.25,2.75 L14.25,15.5241 L16.7383,13.2017 C17.0411,12.9191 17.5157,12.9355 17.7983,13.2383 C18.0809,13.5411 18.0646,14.0157 17.7617,14.2983 L14.0117,17.7983 C13.7236,18.0672 13.2764,18.0672 12.9883,17.7983 L9.23826,14.2983 C8.93545,14.0157 8.91909,13.5411 9.20171,13.2383 C9.48434,12.9355 9.95893,12.9191 10.2617,13.2017 L12.75,15.5241 L12.75,2.75 C12.75,2.33579 13.0858,2 13.5000006,2 Z M6.00002,2 C6.31967,2 6.6042,2.2026 6.70876,2.50467 L8.95876,9.00467 C9.09425,9.39609 8.88678,9.82325 8.49535,9.95874 C8.10393,10.0942 7.67677,9.88676 7.54128,9.49533 L7.19674,8.5 L4.8033,8.5 L4.45876,9.49533 C4.32327,9.88676 3.89611,10.0942 3.50469,9.95874 C3.11326,9.82325 2.90579,9.39609 3.04128,9.00467 L5.29128,2.50467 C5.39584,2.2026 5.68037,2 6.00002,2 Z M6.00002,5.0428 L5.32253,7 L6.67751,7 L6.00002,5.0428 Z"
                                                        id="🎨-Color"
                                                    ></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                    <!-- here -->
                                </div>
                            </div>
                        </div>

                        <div
                            class="pt-8 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-8"
                        >
                            <album-card
                                v-for="album in filteredAlbums"
                                :key="album.id"
                                :album="album"
                            ></album-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { ref, watch, onMounted, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import AlbumCard from "@/Components/AlbumCard.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        albums: Object,
    },
    components: {
        AlbumCard,
        Head,
        AuthenticatedLayout,
    },
    data() {
        return {
            search: "",
            allAlbums: this.albums,
            searchBy: "any",
            sortBy: "",
            ascending: false,
        };
    },
    computed: {
        filteredAlbums() {
            var key = this.searchBy;
            if (key === "any") {
                return this.allAlbums.filter((album) => {
                    return (
                        album.title
                            .toLowerCase()
                            .includes(this.search.toLowerCase()) ||
                        album.artist
                            .toLowerCase()
                            .includes(this.search.toLowerCase()) ||
                        album.genre
                            .toLowerCase()
                            .includes(this.search.toLowerCase())
                    );
                });
            } else {
                return this.allAlbums.filter((album) => {
                    return album[key]
                        .toLowerCase()
                        .includes(this.search.toLowerCase());
                });
            }
        },
    },
    methods: {
        sortAlbums() {
            var key = "";
            if (this.sortBy === "artist") {
                key = "artist";
            } else if (this.sortBy === "genre") {
                key = "genre";
            }
            this.ascending
                ? this.allAlbums.sort((a, b) => (a[key] > b[key] ? 1 : -1))
                : this.allAlbums.sort((a, b) => (a[key] < b[key] ? 1 : -1));
            this.ascending = !this.ascending;
        },
    },
};
</script>
