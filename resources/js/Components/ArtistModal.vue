<template>
    <div class="root">
        <div class="flex justify-end">
            <button
                class="button btnGrey ml-4"
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
                    form.name = name;
                "
            >
                Edit
            </button>
        </div>
        <teleport to="body">
            <div class="modal" v-if="isModalOpen">
                <div ref="modal">
                    <form
                        autocomplete="off"
                        @submit.prevent="
                            form.name = null;
                            isModalOpen = false;
                        "
                    >
                        <label
                            class="txtLabel"
                            for="name"
                            ><span>Artist Name:</span></label
                        >
                        <input
                            class="txtInput"
                            id="name"
                            type="text"
                            required=""
                            v-model="form.name"
                        />

                        <div class="pt-2">
                            <button
                                type="submit"
                                class="button btnGrey"
                                v-if="form.name && isNewArtist"
                                @click="form.post(route('artists.store'))"
                            >
                                Submit
                            </button>
                            <button
                                type="submit"
                                class="button btnGrey"
                                v-if="form.name != name && !isNewArtist"
                                @click="
                                    form.put(
                                        route('artists.update', {
                                            id: id,
                                            name: name,
                                        })
                                    )
                                "
                            >
                                Update
                            </button>

                            <button
                                type="submit"
                                class="button deleteButton"
                                v-if="
                                    !isNewArtist &&
                                    form.name != null &&
                                    form.name === name
                                "
                                @click="destroyArtist(id)"
                            >
                                Delete
                            </button>

                            <button
                                class="button btnGrey float-right"
                                @click="
                                    isModalOpen = false;
                                    form.name = null;
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
        isNewArtist: Boolean,
        id: Number,
        name: String,
    },
    components: {
        Link,
    },

    setup() {
        const form = useForm({
            name: null,
        });
        const isModalOpen = ref(false);
        const modal = ref(null);
        onClickOutside(modal, function () {
            isModalOpen.value = false;
            form.name = null;
        });
        function destroyArtist(id) {
            if (confirm("Are you sure you want to partake in cancel culture?")) {
                Inertia.delete(route("artists.destroy", id));
            }
        }
        watch(isModalOpen, function (isModalOpen) {
            if (isModalOpen) {
                window.scrollTo(0,0);
                document.documentElement.style.overflow = "hidden";
            }
            document.documentElement.style.overflow = "auto";
        });
        return {
            isModalOpen,
            modal,
            form,
            destroyArtist,
        };
    },
};
</script>

<style>

</style>
