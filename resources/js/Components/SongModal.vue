<template>
    <div class="root">
        <div class="flex justify-end">
            <button class="button btnGrey" @click="isModalOpen = true">
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
                            ><span>Song:</span></label
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
                                v-if="form.title && form.song"
                                @click="submit(album.id)"
                            >
                                Submit
                            </button>

                            <button
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

    setup(props) {
        const form = useForm({
            title: null,
            song: null,
            albumTitle: props.album.title,
            albumId: props.album.id,
            artist: props.album.artist
        });
        const isModalOpen = ref(false);
        const modal = ref(null);

        onClickOutside(modal, function () {
            clearForm();
        });

        function clearForm() {
            isModalOpen.value = false;
            form.title = null;
            form.song = null;
        };

        // function updateSongs(e) {
        //     form.song.value = e.form.song[0];
        // };

        watch(isModalOpen, function (isModalOpen) {
            if (isModalOpen) {
                window.scrollTo(0, 0);
                document.documentElement.style.overflow = "hidden";
            } else {
                document.documentElement.style.overflow = "auto";
            }
        });

        function submit(id) {
            form.post(route("songs.store", { album: id }));
        }
        return {
            isModalOpen,
            modal,
            form,
            clearForm,
            // updateSongs,
            submit,
        };
    },
};
</script>

<style></style>
