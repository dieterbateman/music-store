<template>
    <div class="">
        <div
            class="max-w-fit bg-white rounded-lg border border-gray-300 shadow-xl dark:bg-gray-800 dark:border-gray-700"
        >
            <Link
                :href="
                    route('dashboard.songs', {
                        album: album.id,
                    })
                "
            >
                <img
                    class="rounded-t-lg"
                    :src="album.artwork"
                    :alt="album.title"
                />

                <div class="p-2">
                    <h5
                        class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        {{ album.title }}
                    </h5>
                    <h4
                        class="pt-1 font-normal text-gray-700 dark:text-gray-400"
                    >
                        {{ album.artist }}
                    </h4>

                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{ album.genre }}
                    </p>

                </div>
            </Link>
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
    components: {
        Link,
    },

};
</script>

<style></style>
