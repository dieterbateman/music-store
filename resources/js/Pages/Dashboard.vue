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
        };
    },
    computed: {
        filteredAlbums() {
            if (this.searchBy === "any") {
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
            } else if (this.searchBy === "album") {
                return this.allAlbums.filter((album) => {
                    return (
                        album.title
                            .toLowerCase()
                            .includes(this.search.toLowerCase())
                    );
                });
            } else if (this.searchBy === "artist") {
                return this.allAlbums.filter((album) => {
                    return (
                        album.artist
                            .toLowerCase()
                            .includes(this.search.toLowerCase())
                    );
                });
            } else if (this.searchBy === "genre") {
                return this.allAlbums.filter((album) => {
                    return (
                        album.genre
                            .toLowerCase()
                            .includes(this.search.toLowerCase())
                    );
                });
            }
        },
    },
};
</script>

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
                        <div class="flex gap-2">
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
                            <option value="any" selected>Any</option>
                            <option value="album">Album</option>
                            <option value="artist">Artist</option>
                            <option value="genre">Genre</option>
                        </select>
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
