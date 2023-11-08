<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import UserEdit from '@/Components/User/UserEdit.vue';

defineProps({
    user: {
        type: Object,
        default: null,
    },
    roles: {
        type: Object,
        default: null,
    },
    countries: {
        type: Object,
        default: null,
    }
})
</script>
<template>
    <AppLayout title="User Edit" currentPage="User Edit">
        <UserEdit :user="user" :roles="roles" :countries="countries" />
    </AppLayout>
</template>
