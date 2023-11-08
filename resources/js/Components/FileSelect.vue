<script setup>
import InputLabel from "./InputLabel.vue";
import SecondaryButton from "./SecondaryButton.vue";
import {ref} from "vue";

defineProps({
    label: {
        type: String,
        default: 'File'
    },
    fileName: {
        type: String,
        default: 'New'
    }
})

const  emit = defineEmits(['update:model-value'])


const fileInput = ref(null)

const selectFile = () => {
    fileInput.value.click();
}

const selectedFileName = ref('')
const updateFilePreview = () => {
    const file = fileInput.value.files[0];
    if (!file) return;

    selectedFileName.value = file.name;
    emit('update:model-value', file)
};
</script>

<template>
    <InputLabel :value="label" />

    <div>
        <input
            ref="fileInput"
            type="file"
            class="hidden"
            @change="updateFilePreview"
        >
        <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectFile">
            {{ 'Select A ' + fileName + ' file' }}
        </SecondaryButton>
    </div>
    <p class="div-margin-file">{{ selectedFileName !== '' ? 'Selected File: ' + selectedFileName:'' }}</p>
</template>
<style scoped>
.div-margin-file{
    margin-top: 10px;
}
</style>
