<template>
    <div class="root">
        <div class="flex justify-end">
            <button
                class="button hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-4"
                v-if="isNewAlbum"
                @click="isModalOpen = true"
            >
                New Album
            </button>
        </div>
        <teleport to="body">
            <div class="modal" v-if="isModalOpen">
                <div ref="modal">
                    <form autocomplete="off" @submit.prevent="clearForm()">
                        <label
                            class="pt-3 block font-medium text-lg text-gray-700"
                            for="title"
                            ><span>Title:</span></label
                        >
                        <input
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 rounded-md shadow-sm mt-1 block w-full"
                            id="title"
                            type="text"
                            required=""
                            v-model="form.title"
                        />
                        <label
                            class="pt-3 block font-medium text-lg text-gray-700"
                            for="artist"
                            ><span>Artist:</span></label
                        >
                        <v-select
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 rounded-md shadow-sm mt-1 block w-full"
                            label="name"
                            :options="artists"
                            v-model="selectedArtist"
                        ></v-select>
                        <label
                            class="pt-3 block font-medium text-lg text-gray-700"
                            for="genre"
                            ><span>Genre:</span></label
                        >
                        <v-select
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 rounded-md shadow-sm mt-1 block w-full"
                            multiple
                            :options="genres"
                            v-model="selectedGenre"
                        ></v-select>
                        <!-- <input
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 rounded-md shadow-sm mt-1 block w-full"
                            id="genre"
                            type="text"
                            required=""
                            v-model="form.genre"
                        /> -->
                        <label
                            class="pt-3 block font-medium text-lg text-gray-700"
                            for="artwork"
                            ><span>Artwork:</span></label
                        >
                        <input
                            class="px-1 py-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 rounded-md shadow-sm mt-1 block w-full"
                            id="artwork"
                            type="file"
                            name="artwork"
                            required=""
                            v-on:change="form.artwork = $event.target.files[0]"
                        />

                        <div class="pt-2">
                            <button
                                type="submit"
                                class="button hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 mt-3"
                                v-if="form.title && isNewAlbum"
                                @click="
                                    form.post(route('albums.store'));
                                    clearForm();
                                "
                            >
                                Submit
                            </button>
                            <button
                                type="submit"
                                class="button hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 mt-3"
                                v-if="form.title != title && !isNewAlbum"
                                @click="
                                    form.put(
                                        route('artists.update', {
                                            id: id,
                                            title: title,
                                        })
                                    )
                                "
                            >
                                Update
                            </button>

                            <button
                                type="submit"
                                class="button deleteButton hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray transition ease-in-out duration-150 mt-3"
                                v-if="
                                    !isNewAlbum &&
                                    form.title != null &&
                                    form.title === title
                                "
                                @click="destroyArtist(id)"
                            >
                                Delete
                            </button>

                            <button
                                class="button float-right hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 mt-3"
                                @click="clearForm()"
                            >
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </teleport>
    </div>
</template>

<script>
import { ref, watch } from "vue";
import { onClickOutside } from "@vueuse/core";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
    props: {
        isNewAlbum: Boolean,
        id: Number,
        title: String,
        genre: String,
        artist: String,
        album: Object,
        artists: Object,
    },
    components: {
        Link,
        vSelect,
    },

    setup() {
        const form = useForm({
            title: null,
            artist: null,
            genre: null,
            artwork: null,
        });
        const isModalOpen = ref(false);
        const modal = ref(null);
        const selectedArtist = ref(null);
        const selectedGenre = ref(null);
        const genres = ref([
            "Ambient",
            "Classical",
            "Country",
            "Disco",
            "EDM",
            "Folk",
            "Funk",
            "Gospel",
            "Grime",
            "Grunge",
            "Heavy Metal",
            "Hip-Hop & Rap",
            "House",
            "Indie Rock",
            "Jazz",
            "Latin Music",
            "Pop",
            "Psychedelic Rock",
            "Punk Rock",
            "R&B",
            "Reggae",
            "Rock",
            "Soul",
            "Techno",
            "Trap",
        ]);

        onClickOutside(modal, function () {
            clearForm();
        });

        function clearForm() {
            isModalOpen.value = false;
            form.title = null;
            form.genre = null;
            form.artist = null;
        }

        function destroyArtist(id) {
            if (confirm("Are you sure?")) {
                Inertia.delete(route("artists.destroy", id));
            }
        }

        function updateArtwork(e) {
            form.artwork.value = e.form.artwork[0];
        }

        watch(selectedArtist, function (selectedArtist) {
            form.artist = selectedArtist.name;
        });
        watch(selectedGenre, function (selectedGenre) {
            var multipleGenres = Object.values(selectedGenre);
            var stringOfGenres=multipleGenres.toString();
            form.genre = stringOfGenres;
        });

        //         if(Object.keys(selectedGenre).length>1){
        //     console.log(JSON.stringify(Object.values(selectedGenre)));
        //     var multipleGenres=JSON.stringify(Object.values(selectedGenre))
        // } else{
        //     console.log(selectedGenre)
        //     form.genre = selectedGenre;
        // }

        watch(isModalOpen, function (isModalOpen) {
            if (isModalOpen) {
                document.documentElement.style.overflow = "hidden";
            }
            document.documentElement.style.overflow = "auto";
        });
        return {
            isModalOpen,
            modal,
            form,
            destroyArtist,
            clearForm,
            updateArtwork,
            selectedArtist,
            selectedGenre,
            genres,
        };
    },
};
</script>

<style></style>
