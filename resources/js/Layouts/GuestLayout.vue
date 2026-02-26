<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="min-h-screen flex flex-col items-center justify-center bg-[#0f172a] relative overflow-hidden font-sans"
    >
        <!-- Elementos de fundo decorativos -->
        <div
            class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-600/20 rounded-full blur-[120px] pointer-events-none"
        ></div>
        <div
            class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-600/20 rounded-full blur-[120px] pointer-events-none"
        ></div>

        <div class="z-10 w-full flex flex-col items-center">
            <div class="mb-6">
                <Link href="/">
                    <ApplicationLogo
                        class="w-20 h-20 fill-current text-white drop-shadow-lg"
                    />
                </Link>
            </div>

            <slot />
        </div>
    </div>
</template>
