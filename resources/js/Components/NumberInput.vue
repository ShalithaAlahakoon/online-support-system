<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    customClass: String
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input type="range" min="0" max="5" step="0.1"
           ref="input"
           :class="customClass ? customClass: 'focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none'"
           :value="modelValue"
           @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
