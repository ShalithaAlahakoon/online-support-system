
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import LogIndex from '@/Components/User/LogIndex.vue';

defineProps({
    logs: {
        type: Object,
        default: null,
    }
});
</script>

<template>
    <AppLayout title="Log List" currentPage="User Log">
         <LogIndex :logs="logs"/>
    </AppLayout>
</template>

