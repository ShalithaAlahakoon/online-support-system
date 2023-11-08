<script setup>
defineProps({
    message: String,
    errorClass: String,
    color: {
        type: String,
        default: 'red'
    }
});
</script>

<template>
    <div v-show="message">
        <p :class="'text-sm text-red-600 ' + errorClass" :style="{'color': color}">
            {{ message }}
        </p>
    </div>
</template>
