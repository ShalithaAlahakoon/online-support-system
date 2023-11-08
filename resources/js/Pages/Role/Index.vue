
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import RoleIndex from '@/Components/Role/RoleIndex.vue';

defineProps({
    roles: {
        type: Object,
        default: null,
    },
    allRoles:{
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
    <AppLayout title="Role List" currentPage="Role List">
         <RoleIndex :roles="roles" :allRoles="allRoles" :requestParam="requestParam"/>
    </AppLayout>
</template>

