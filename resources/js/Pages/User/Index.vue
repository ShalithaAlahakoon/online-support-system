<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import UserIndex from '@/Components/User/UserIndex.vue';

defineProps({
    users: {
        type: Object,
        default: null,
    },
    allUsers: {
        type: Object,
        default: null,
    },
    requestParam: {
        type: Object,
        default: {
            'search': '',
            'entries': 10,
            'page': 1
        }
    }
});
</script>

<template>
    <AppLayout title="User List" currentPage="User List">
         <UserIndex :users="users" :allUsers="allUsers" :requestParam="requestParam"/>
    </AppLayout>
</template>

