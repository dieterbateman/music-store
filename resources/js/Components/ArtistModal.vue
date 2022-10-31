<template>
    <div class="root">
        <div class="flex justify-end">
            <button
                class="button btnGrey"
                v-if="isNewArtist"
                @click="isModalOpen = true"
            >
                New Artist
            </button>
            <button
                class="text-left font-medium text-blue-600 dark:text-blue-500 hover:underline"
                v-else-if="!isNewArtist"
                @click="
                    isModalOpen = true;
                    form.name = artist?.name;
                "
            >
                Edit
            </button>
        </div>
        <teleport to="body">
            <div class="modal" v-if="isModalOpen">
                <div ref="modal">
                    <form autocomplete="off" @submit.prevent="clearForm()">
                        <label class="txtLabel" for="name"
                            ><span>Artist Name:</span></label
                        >
                        <input
                            class="txtInput"
                            id="name"
                            type="text"
                            required
                            v-model="form.name"
                        />

                        <div class="pt-2">
                            <button
                                type="submit"
                                class="button btnGrey"
                                v-if="form.name && isNewArtist"
                                @click="submit(true)"
                            >
                                Submit
                            </button>
                            <button
                                type="submit"
                                class="button btnGrey"
                                v-if="form.name != artist?.name && !isNewArtist"
                                @click="submit(false)"
                            >
                                Update
                            </button>

                            <button
                                type="submit"
                                class="button deleteButton"
                                v-if="
                                    !isNewArtist &&
                                    form.name != null &&
                                    form.name === artist?.name
                                "
                                @click="destroyArtist(artist?.id)"
                            >
                                Delete
                            </button>

                            <button
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
import { ref, watch, reactive } from "vue";
import { onClickOutside } from "@vueuse/core";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        isNewArtist: Boolean,
        artist: Object,
    },

    setup(props) {
        const form = useForm({
            name: null,
        });
        function clearForm() {
            isModalOpen.value = false;
            form.name = null;
        }

        const isModalOpen = ref(false);
        const modal = ref(null);
        watch(isModalOpen, function (isModalOpen) {
            if (isModalOpen) {
                window.scrollTo(0, 0);
                document.documentElement.style.overflow = "hidden";
            }
            document.documentElement.style.overflow = "auto";
        });
        onClickOutside(modal, function () {
            clearForm();
        });

        function submit(isNew) {
            if (isNew) {
                form.post(route("artists.store"));
            } else if (!isNew) {
                form.put(route("artists.update", { artist: props.artist.id }));
            }
        }

        function destroyArtist(id) {
            if (
                confirm("Are you sure you want to partake in cancel culture?")
            ) {
                form.delete(route("artists.destroy", id));
            }
        }

        return {
            isModalOpen,
            modal,
            form,
            clearForm,
            destroyArtist,
            submit,
        };
    },
};
</script>

<style></style>
