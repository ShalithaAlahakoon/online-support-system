<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ResolvedTicketIndex from '@/Components/Ticket/ResolvedTicketIndex.vue';

defineProps({
    resolvedTickets: {
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
    <AppLayout title="Resolved Support Ticket List" moduleName="Support Tickets" currentPage="Resolved Support Ticket List">
         <ResolvedTicketIndex
         :resolvedTickets="resolvedTickets"
         :requestParam="requestParam"
         />
    </AppLayout>
</template>

