<template>
    <div class="">
        <div
            class="max-w-fit bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700"
        >
            <a href="#">
                <img
                    class="rounded-t-lg"
                    :src="album.artwork"
                    :alt="album.title"
                />
            </a>
            <div class="p-2">
                <a href="#">
                    <h5
                        class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        {{ album.title }}
                    </h5>
                    <h4 class="pt-1 font-normal text-gray-700 dark:text-gray-400">
                        {{ album.artist }}
                    </h4>
                </a>
                <p class=" font-normal text-gray-700 dark:text-gray-400">
                    {{ album.genre }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, watch, reactive } from "vue";
import { onClickOutside } from "@vueuse/core";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        album: Object,
    },

    setup(props) {
        return {};
    },
};
</script>

<style></style>
