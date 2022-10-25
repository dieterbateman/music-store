<template>
    <div class="root">
        <div class="flex justify-end">
            <button
                class="button btnGrey ml-4"
                v-if="isNewAlbum"
                @click="isModalOpen = true"
            >
                New Album
            </button>
        </div>
        <teleport to="body">
            <div class="modal" v-if="isModalOpen">
                <div ref="modal">
                    <form
                        id="modalForm"
                        autocomplete="off"
                        @submit.prevent="clearForm()"
                    >
                        <label class="txtLabel" for="title"
                            ><span>Title:</span></label
                        >
                        <input
                            class="txtInput"
                            id="title"
                            type="text"
                            required=""
                            v-model="form.title"
                        />

                        <label class="txtLabel" for="artist"
                            ><span>Artist:</span></label
                        >
                        <v-select
                            class="txtInput"
                            label="name"
                            :options="artists"
                            v-model="selectedArtist"
                        ></v-select>

                        <label class="txtLabel" for="genre"
                            ><span>Genre:</span></label
                        >
                        <v-select
                            class="txtInput"
                            multiple
                            :options="genres"
                            v-model="selectedGenre"
                        ></v-select>

                        <label class="txtLabel" for="artwork"
                            ><span>Artwork:</span></label
                        >
                        <input
                            class="px-1 py-1 txtInput"
                            id="artwork"
                            type="file"
                            name="artwork"
                            required=""
                            v-on:change="form.artwork = $event.target.files[0]"
                        />

                        <div class="pt-2">
                            <button
                                type="submit"
                                class="button btnGrey"
                                v-if="isNewAlbum"
                                @click="
                                    form.post(route('albums.store'));
                                "
                            >
                                Submit
                            </button>

                            <button
                                class="button btnGrey float-right"
                                @click="
                                    clearForm();
                                "
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
            // form.get(route('albums.index'));
        }

        function updateArtwork(e) {
            form.artwork.value = e.form.artwork[0];
        }

        watch(selectedArtist, function (selectedArtist) {
            if (selectedArtist === null) {
                form.artist = selectedArtist;
            } else {
                form.artist = selectedArtist.name;
            }
        });

        //Formatting data here in frontend since it requires very little computational power
        watch(selectedGenre, function (selectedGenre) {
            var multipleGenres = Object.values(selectedGenre);
            var stringOfGenres = multipleGenres.toString();
            var selectedGenres = stringOfGenres.replace(/,/g, ", ");
            form.genre = selectedGenres;
        });

        watch(isModalOpen, function (isModalOpen) {
            if (isModalOpen) {
                window.scrollTo(0,0);
                document.documentElement.style.overflow = "hidden";
            } else {
                document.documentElement.style.overflow = "auto";
            }
        });
        return {
            isModalOpen,
            modal,
            form,
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
