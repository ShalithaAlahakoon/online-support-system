<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import UserCreate from '@/Components/User/UserCreate.vue';

const props = defineProps({
    roles: {
        type: Object,
        default: null,
    },
    countries: {
        type: [],
        default: null,
    }
});
</script>

<template>
    <AppLayout title="User Create" currentPage="User Create">
        <UserCreate :roles="roles" :countries="countries"/>
    </AppLayout>
</template>
