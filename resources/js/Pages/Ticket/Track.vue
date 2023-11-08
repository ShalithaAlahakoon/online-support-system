<script setup>
import WebLayout from '@/Layouts/WebLayout.vue';
import TicketTrack from "@/Components/Ticket/TicketTrack.vue";

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    homePage: {
        type: Object,
        default: null,
    },
    ticket: {
        type: Object,
        default: null,
    },
});



</script>

<template>
    <WebLayout title="Track Ticket Page" :canLogin="canLogin" :canRegister="canRegister">
        <TicketTrack :ticket="ticket"/>
    </WebLayout>
</template>
