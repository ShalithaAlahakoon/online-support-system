<script setup>
import Login from '@/Components/Web/Login.vue';
import WebLayout from '@/Layouts/WebLayout.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});
</script>

<template>
    <WebLayout title="Log in">
        <Login :canResetPassword="canResetPassword" :status="status"/>
    </WebLayout>
</template>
