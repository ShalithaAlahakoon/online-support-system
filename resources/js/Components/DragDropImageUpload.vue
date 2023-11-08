<script setup>

import { usePage } from '@inertiajs/vue3';
import { notify } from 'notiwind';
import { ref, defineProps, defineEmits } from 'vue';

// Define reactive variables using ref

const isDragging = ref(false);

const fileInput = ref(null);

const deletedImage = ref(null);

const deleteUploadedImage = (id) => {
  //add to deleted images
  deletedImage.value = id;

  emit('delete-image', deletedImage);
};

// Function to handle file selection

const selectFiles = () => {

  // Trigger click event on file input element

  fileInput.value.click();

};

// Function to handle file selection event

const onFileSelect = (e) => {

  const files = e.target.files;

  if (files.length === 0) {

    return;

  }

  for (let i = 0; i < files.length; i++) {

    // Skip non-image files

    if (files[i].type.split('/')[0] !== 'image') continue;

    // Add new image to the images array if it doesn't already exist

    if (!props.images.some((image) => image.name === files[i].name)) {

      props.images.push({

        name: files[i].name,

        url: URL.createObjectURL(files[i]),

        file: files[i],

      });

    }

    // Add file to parent component

    emit('update-images', props.images);


  }

};

// Function to delete an image from the images array

const deleteImage = (index) => {

  props.images.splice(index, 1);
  notify({
    group: 'success',
    title: 'Success',
    text: 'Image successfully deleted!',
  }, 4000);

};

// Function to handle drag over event

const onDragover = (event) => {

  event.preventDefault();

  isDragging.value = true;

  event.dataTransfer.dropEffect = 'copy';

};

// Function to handle drag leave event

const onDragleave = (event) => {

  event.preventDefault();

  isDragging.value = false;

};

// Function to handle drop event

const onDrop = (event) => {

  event.preventDefault();

  isDragging.value = false;

  const files = event.dataTransfer.files;

  if (files.length === 0) {

    return;

  }

  for (let i = 0; i < files.length; i++) {

    // Skip non-image files

    if (files[i].type.split('/')[0] !== 'image') continue;

    // Add new image to the images array if it doesn't already exist

    if (!props.images.some((image) => image.name === files[i].name)) {

      props.images.push({

        name: files[i].name,

        url: URL.createObjectURL(files[i]),

        file: files[i],

      });

    }


    emit('update-images', props.images);

  }

};

// Props data to be passed to the component

const props = defineProps({

  images: {

    type: Object,

    default: null,

  },
  value: {
    type: Object,
    default: null,
  },

});

// Emit custom events

const emit = defineEmits(['update-images', 'delete-image']);

// Generate the complete profile picture path
const profilePicturePath = (value) => {
  const baseURL = usePage().props.baseURL;
  return baseURL + value;
};
</script>

<template>
  <div class="card">

    <div
      class="drag-area border-2 border-dashed border-primary-600 bg-white text-primary-600 flex items-center justify-center h-40"
      @dragover.prevent="onDragover" @dragleave.prevent="onDragleave" @drop.prevent="onDrop">

      <span v-if="!isDragging">

        Drag &amp; drop images here

        <span class="select font-bold ml-2 cursor-pointer" @click="selectFiles">Choose</span>

      </span>

      <div v-else class="select">Drop images here</div>

      <input name="file" type="file" multiple @change="onFileSelect" ref="fileInput" class="hidden" accept="image/*" maxlength="6" />

    </div>

    <div class="container flex flex-wrap mb-4 px-2 py-2">

      <div v-for="(image, index) in props.images" :key="image.name" class="image relative px-1 mt-2"
        @mouseover="image.hovered = true" @mouseleave="image.hovered = false">

        <button
          class="delete-button absolute bottom-3 right-3 text-red-600 text-lg cursor-pointer rounded-full bg-white p-1 hover:bg-red-600 hover:text-white"
          @click="deleteImage(index)">

          <i class="fas fa-trash"></i>

        </button>

        <div class="image-details">

          <img :src="image.url" class="w-25 h-25 rounded-lg object-cover" />

        </div>

      </div>
      <div v-for="(image, index) in props.value" :key="image.file_name" class="image relative px-1 mt-2"
        @mouseover="image.hovered = true" @mouseleave="image.hovered = false">
        <div
          class="delete-button absolute bottom-3 right-3 text-red-600 text-lg cursor-pointer rounded-full bg-white p-1 hover:bg-red-600 hover:text-white"
          @click="deleteUploadedImage(image.id)">

          <i class="fas fa-trash"></i>

        </div>

        <div class="image-details">

          <img :src="image.file_path" class="w-25 h-25 rounded-lg object-cover" />

        </div>
      </div>

    </div>

  </div>
</template>

