<template>
    <div class="root">
        <button @click="isModalOpen = true">New Artist</button>
        <teleport to="body">
            <div class="modal" v-if="isModalOpen" >
                <div ref="modal">
                    <label
                        class="block font-medium text-lg text-gray-700"
                        for="name"
                        ><span>Artist Name</span></label
                    >
                    <input
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5 rounded-md shadow-sm mt-1 block w-full"
                        id="name"
                        type="text"
                        required=""
                        autofocus=""
                    />
                    <button class="pt-2" @click="isModalOpen = false">Close</button>
                </div>
            </div>
        </teleport>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { onClickOutside } from "@vueuse/core";

const isModalOpen = ref(false);
const modal = ref(null);

onClickOutside(modal, () => (isModalOpen.value = false));
</script>

<style>
.root {
    position: relative;
}
.modal {
    position: absolute;
    background-color: rgba(0, 0, 0, 0.1);
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
    padding: 50px;
    border-radius: 10px;
}
</style>
