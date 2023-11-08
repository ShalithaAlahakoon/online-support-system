<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    customClass: String
});

defineEmits(['update:modelValue']);

const textarea = ref(null);

onMounted(() => {
    if (textarea.value.hasAttribute('autofocus')) {
        textarea.value.focus();
    }
});

defineExpose({ focus: () => textarea.value.focus() });
</script>

<template>
    <textarea type="text"
           ref="textarea"
           :class="customClass ? customClass: 'dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-primary'"
           :value="modelValue"
           @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
