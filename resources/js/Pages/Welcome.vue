<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
        <div
            v-if="canLogin"
            class="hidden fixed top-0 right-0 px-6 py-4 sm:block"
        >
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="text-sm text-gray-700 dark:text-gray-500 underline"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-700 dark:text-gray-500 underline"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                    >Register</Link
                >
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-6 sm:pt-0">
                <application-logo class="w-32"></application-logo>
            </div>

            <div
                class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
            >
                <div
                    class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-1 md:border-l"
                >
                    <div class="flex items-center">
                        <div class="opacity-50">
                            <svg
                                width="32px"
                                height="32px"
                                viewBox="0 0 48 48"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    width="48"
                                    height="48"
                                    fill="white"
                                    fill-opacity="0.01"
                                />
                                <path
                                    d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44Z"
                                    stroke="black"
                                    stroke-width="4"
                                />
                                <path
                                    d="M4 20.8404C7.01485 19.4168 9.24466 19.2185 10.6894 20.2454C12.8566 21.7859 13.1283 28.064 18.0575 25.0635C22.9867 22.063 15.9467 20.8404 17.475 16.4939C19.0033 12.1474 24.0083 15.5237 24.5059 10.7627C24.8375 7.58862 21.0408 6.37413 13.1156 7.11921"
                                    stroke="black"
                                    stroke-width="4"
                                />
                                <path
                                    d="M36.0001 8C30.2857 12.9886 28.2899 16.0011 30.0127 17.0373C32.5968 18.5917 33.6933 16.4033 36.8467 17.0373C40.0001 17.6714 39.3173 21.9457 37.6587 21.9457C36.0001 21.9457 27.41 20.8518 27.8427 25.865C28.2753 30.8781 33.4422 31.6203 33.4422 34.4211C33.4422 36.2883 32.299 39.146 30.0127 42.9942"
                                    stroke="black"
                                    stroke-width="4"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M6.10461 32.9264C7.0161 32.5288 7.70127 32.2374 8.16011 32.052C12.0072 30.4978 14.8618 30.1314 16.7237 30.953C20.0162 32.4059 18.7504 35.3401 19.7817 36.4211C20.8129 37.5021 23.3881 37.1876 23.3881 39.244C23.3881 40.615 22.9276 42.1637 22.0066 43.8901"
                                    stroke="black"
                                    stroke-width="4"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </div>

                        <div
                            class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"
                        >
                            Browse Music
                        </div>
                    </div>

                    <div class="ml-12">
                        <div
                            class="mt-2 text-gray-600 dark:text-gray-400 text-sm"
                        >
                            Find the lastest music in our Library with new
                            tracks added every week. Whether you are looking for
                            golden oldies or the latest numbers, find it all
                            here, for free. You can browse for specific artists
                            or genres whatever gets your feet moving.
                        </div>
                    </div>
                </div>

                <div
                    class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-1 md:border-l"
                >
                    <div class="flex items-center">
                        <div class="opacity-50">
                            <svg
                                version="1.1"
                                id="Uploaded to svgrepo.com"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                x="0px"
                                y="0px"
                                width="32px"
                                height="32px"
                                viewBox="0 0 32 32"
                                style="enable-background: new 0 0 32 32"
                                xml:space="preserve"
                            >
                                <path
                                    class="stone_een"
                                    d="M17.5,27c-0.827,0-1.5-0.673-1.5-1.5v-20C16,4.673,16.673,4,17.5,4S19,4.673,19,5.5v20 C19,26.327,18.327,27,17.5,27z M9.5,25C8.673,25,8,24.327,8,23.5v-16C8,6.673,8.673,6,9.5,6S11,6.673,11,7.5v16 C11,24.327,10.327,25,9.5,25z M21.5,22c-0.827,0-1.5-0.673-1.5-1.5v-10C20,9.673,20.673,9,21.5,9S23,9.673,23,10.5v10 C23,21.327,22.327,22,21.5,22z M13.5,22c-0.827,0-1.5-0.673-1.5-1.5v-10C12,9.673,12.673,9,13.5,9S15,9.673,15,10.5v10 C15,21.327,14.327,22,13.5,22z M5.5,21C4.673,21,4,20.327,4,19.5v-8C4,10.673,4.673,10,5.5,10S7,10.673,7,11.5v8 C7,20.327,6.327,21,5.5,21z M29.5,20c-0.827,0-1.5-0.673-1.5-1.5v-6c0-0.827,0.673-1.5,1.5-1.5s1.5,0.673,1.5,1.5v6 C31,19.327,30.327,20,29.5,20z M25.5,19c-0.827,0-1.5-0.673-1.5-1.5v-4c0-0.827,0.673-1.5,1.5-1.5s1.5,0.673,1.5,1.5v4 C27,18.327,26.327,19,25.5,19z M1.5,18C0.673,18,0,17.327,0,16.5v-2C0,13.673,0.673,13,1.5,13S3,13.673,3,14.5v2 C3,17.327,2.327,18,1.5,18z"
                                />
                            </svg>
                        </div>

                        <div
                            class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"
                        >
                            Listen & Download
                        </div>
                    </div>

                    <div class="ml-12">
                        <div
                            class="mt-2 text-gray-600 dark:text-gray-400 text-sm"
                        >
                            Listen or download your favourite numbers FREE of
                            charge. All of this and more at the click of a
                            button. Register NOW to get started or LOGIN if you
                            are already a user!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
