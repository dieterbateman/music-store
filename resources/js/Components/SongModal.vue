<template>
    <div class="root">
        <div class="flex justify-end">
            <button
                class="button btnGrey ml-4"
                @click="isModalOpen = true"
            >
                Add Songs
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


                        <label class="txtLabel" for="song"
                            ><span>Songs:</span></label
                        >
                        <input
                            class="px-1 py-1 txtInput"
                            id="song"
                            type="file"
                            name="song"
                            required=""
                            v-on:change="form.song = $event.target.files[0]"
                        />
                        

                        <div class="pt-2">
                            <button
                                type="submit"
                                class="button btnGrey"

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

export default {
    props: {
        album: Object,
    },
    components: {
        Link,
    },

    setup() {
        const form = useForm({
            title: null,
            artist: null,
            song: null,
        });
        const isModalOpen = ref(false);
        const modal = ref(null);

        onClickOutside(modal, function () {
            clearForm();
        });

        function clearForm() {
            isModalOpen.value = false;
            // form.get(route('albums.index'));
        }

        function updateSong(e) {
            form.song.value = e.form.song[0];
        }

        // watch(selectedArtist, function (selectedArtist) {
        //     if (selectedArtist === null) {
        //         form.artist = selectedArtist;
        //     } else {
        //         form.artist = selectedArtist.name;
        //     }
        // });

        //Formatting data here in frontend since it requires very little computational power
        // watch(selectedGenre, function (selectedGenre) {
        //     var multipleGenres = Object.values(selectedGenre);
        //     var stringOfGenres = multipleGenres.toString();
        //     var selectedGenres = stringOfGenres.replace(/,/g, ", ");
        //     form.genre = selectedGenres;
        // });

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
            updateSong,
            // selectedArtist,
            // selectedGenre,
            // genres,
        };
    },
};
</script>

<style></style>
