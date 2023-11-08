<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    modelValue: String,
    placeholder: String,
    options: {
        type: Array,
        required: true,
    },
    value: {
        type: String,
        required: true,
    },
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
        <select
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input"
            class="dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:outline-none"
        >
            <option selected :value="null" disabled>{{ placeholder }}</option>
            <option v-for="option in options" :value="option.id" :key="option.id">
                {{ option.name }}
            </option>
        </select>
</template>
