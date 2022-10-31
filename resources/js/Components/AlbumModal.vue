<template>
    <div class="root">
        <div class="flex justify-end">
            <button class="button btnGrey" @click="isModalOpen = true">
                New Album
            </button>
        </div>
        <teleport to="body">
            <div class="modal" v-if="isModalOpen">
                <div ref="modal">
                    <form
                        id="formId"
                        autocomplete="off"
                        v-on:submit="clearForm()"
                    >
                        <label class="txtLabel" for="title"
                            ><span>Title:</span></label
                        >
                        <input
                            class="txtInput"
                            id="title"
                            type="text"
                            required
                            v-model="form.title"
                        />

                        <label class="txtLabel" for="artist"
                            ><span>Artist:</span></label
                        >

                        <v-select
                            id="artist"
                            class="txtInput"
                            label="name"
                            :options="artists"
                            v-model="selectedArtist"
                        ></v-select>

                        <label class="txtLabel" for="genre"
                            ><span>Genre:</span></label
                        >
                        <v-select
                            id="genre"
                            class="txtInput"
                            multiple
                            :options="genreList"
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
                            v-on:change="form.artwork = $event.target.files[0]"
                        />

                        <div class="pt-2">
                            <button
                                type="button"
                                class="button btnGrey"
                                v-if="form.title && form.artist && form.genre"
                                @click="submit()"
                            >
                                Submit
                            </button>

                            <button
                                id="closeBtn"
                                type="button"
                                class="button btnGrey float-right"
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
import { ref, watch, onMounted } from "vue";
import { onClickOutside } from "@vueuse/core";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
    props: {
        artists: Object,
    },
    components: {
        Link,
        vSelect,
    },
    setup(props) {
        const isModalOpen = ref(false);
        const modal = ref(null);
        var form = useForm({
            title: null,
            artist: null,
            genre: null,
            artwork: null,
        });
        const selectedArtist = ref(null);
        const selectedGenre = ref(null);
        const genreList = ref([
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

        watch(isModalOpen, function (isModalOpen) {
            if (isModalOpen) {
                window.scrollTo(0, 0);
                document.documentElement.style.overflow = "hidden";
            } else {
                document.documentElement.style.overflow = "auto";
            }
        });
        onClickOutside(modal, function () {
            clearForm();
        });
        function clearForm() {
            isModalOpen.value = false;
            Inertia.get(route("albums.index"));
        }

        //Sending genres as a string of genres seperated with a comma
        watch(selectedGenre, function (selectedGenre) {
            var multipleGenres = Object.values(selectedGenre);
            var stringOfGenres = multipleGenres.toString();
            var selectedGenres = stringOfGenres.replace(/,/g, ", ");
            form.genre = selectedGenres;
        });
        watch(selectedArtist, function (selectedArtist) {
            form.artist = selectedArtist?.name;
        });

        function submit() {
            let formdata = new FormData();
            formdata.append("title", form.title);
            formdata.append("artist", form.artist);
            formdata.append("genre", form.genre);
            formdata.append("artwork", form.artwork);
            axios
                .post(route("albums.store"), formdata, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(function (response) {
                    // console.log(response);
                    clearForm();
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        return {
            isModalOpen,
            modal,
            form,
            genreList,
            selectedArtist,
            selectedGenre,
            clearForm,
            submit,
        };
    },
};
</script>

<style></style>
