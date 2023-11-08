<script setup>
import { Head } from '@inertiajs/vue3';
import Navbar from "@/Components/Web/Navbar.vue";
import Footer from "@/Components/Web/Footer.vue";

defineProps({
    title: String,
    canLogin: Boolean,
    canRegister: Boolean
});
</script>
<template>
    <Head :title="title"/>
    <Navbar :canLogin="canLogin" :canRegister="canRegister"/>
     <slot />
    <Footer />
</template>

