<template>
  <div>
    <slot :inputData="clonedInputData" :addInputField="addInputField" :removeInputField="removeInputField"
      :isRemoveButtonDisabled="isRemoveButtonDisabled">
    </slot>
  </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from 'vue';

const props = defineProps({
  itemArray: {
    type: Object,
    default: null,
  }
});

const emit = defineEmits(['clone-input-data']);

const clonedInputData = ref([]);

const addInputField = () => {
  clonedInputData.value.push({});
};

const isRemoveButtonDisabled = computed(() => {
  return clonedInputData.value.length === 1;
});

const removeInputField = (index) => {
  // Return early if there is only one item
  if (clonedInputData.value.length === 1) {
    return;
  }
  clonedInputData.value.splice(index, 1);
  emit('clone-input-data', clonedInputData.value)
};

onMounted(() => {
  if (clonedInputData.value.length === 0) {
    addInputField();
  }
  if (props.itemArray.length > 0) {
    // Copy itemArray to clonedInputData
    clonedInputData.value = [...props.itemArray];
  }
});

</script>
