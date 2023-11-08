<script setup>
import WebLayout from '@/Layouts/WebLayout.vue';
import SupportTicketForm from "../Components/Web/SupportTicketForm.vue";
import {getSectionByName, getSectionStatusByName} from '../commonMethods'

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    homePage: {
        type: Object,
        default: null,
    },
});

//get sections
const newsSection = getSectionByName(props.homePage, 'Inquiry form');

//get sections status
const newsSectionStatus = getSectionStatusByName(props.homePage, 'Inquiry form');


</script>

<template>
    <WebLayout title="Inquiry Page" :canLogin="canLogin" :canRegister="canRegister">

        <SupportTicketForm :section="newsSection" v-if="newsSectionStatus" />

    </WebLayout>
</template>
