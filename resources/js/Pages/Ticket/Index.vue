<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TicketIndex from '@/Components/Ticket/TicketIndex.vue';

defineProps({
    tickets: {
        type: Array,
        default: null,
    },
    requestParam: {
        type: Object,
        default: {
            'search': '',
            'entries': 10,
            'page': 1
        }
    },
});
</script>

<template>
    <AppLayout title="Ticket list" moduleName="Support Tickets" currentPage="Ticket list">
         <TicketIndex
         :tickets="tickets"
         :requestParam="requestParam"
         />
    </AppLayout>
</template>

