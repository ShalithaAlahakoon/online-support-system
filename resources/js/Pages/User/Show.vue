<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import UserShow from '@/Components/User/UserShow.vue';

const props = defineProps({
    user: {
        type: Object,
        default: null,
    }
});
</script>

<template>
    <AppLayout title="Profile" currentPage="Profile">
       <UserShow :user="user" />
    </AppLayout>
</template>
