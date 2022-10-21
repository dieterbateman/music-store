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
                        <input
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 rounded-md shadow-sm mt-1 block w-full"
                            id="artist"
                            type="text"
                            required=""
                            v-model="form.artist"
                        />
                        <!-- Insert artist dropdown here: {{ artists }} -->
                        <label
                            class="pt-3 block font-medium text-lg text-gray-700"
                            for="genre"
                            ><span>Genre:</span></label
                        >
                        <input
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 rounded-md shadow-sm mt-1 block w-full"
                            id="genre"
                            type="text"
                            required=""
                            v-model="form.genre"
                        />
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
                                @click="form.post(route('albums.store')); clearForm()"
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
        };
    },
};
</script>

<style></style>
