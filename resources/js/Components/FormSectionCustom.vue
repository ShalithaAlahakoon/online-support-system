<script setup>
defineEmits(['submitted']);
</script>

<template>
    <form @submit.prevent="$emit('submitted')">
        <slot name="form"/>
    </form>
</template>
