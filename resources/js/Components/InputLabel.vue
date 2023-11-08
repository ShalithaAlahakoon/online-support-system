<script setup>
defineProps({
    value: String,
    customClass: String
});
</script>

<template>
    <label :class="customClass ? customClass: 'inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80'" style="margin-top: 15px">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
