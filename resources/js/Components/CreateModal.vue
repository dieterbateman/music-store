<template>
    <div class="root">
        <button @click="isModalOpen=true">New Artist</button>
        <teleport to="body">
            <div class="modal" v-if="isModalOpen">
                <div ref="modal">
                    <form
                        @submit.prevent="
                            form.post(route('artists.store'));
                            form.name = null;
                        "
                    >
                        <label
                            class="block font-medium text-lg text-gray-700"
                            for="name"
                            ><span>Artist Name:</span></label
                        >
                        <input
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 rounded-md shadow-sm mt-1 block w-full"
                            id="name"
                            type="text"
                            required=""
                            v-model="form.name"
                        />
                        <button
                            type="submit"
                            v-if="form.name"
                            class="pt-3 pl-2"
                        >
                            Submit
                        </button>
                        <button
                            class="pt-3 float-right"
                            @click="
                                isModalOpen = false;
                                form.name = null;
                            "
                        >
                            Close
                        </button>
                    </form>
                </div>
            </div>
        </teleport>
    </div>
</template>

<script>
import { ref } from "vue";
import { onClickOutside } from "@vueuse/core";
import { Link, useForm } from "@inertiajs/inertia-vue3";

export default {
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
        return {
            isModalOpen,
            modal,
            form,
        };
    },
};
</script>

<style>
.root {
    position: relative;
}
.modal {
    position: absolute;
    background-color: rgba(0, 0, 0, 0.3);
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal > div {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
}
</style>
