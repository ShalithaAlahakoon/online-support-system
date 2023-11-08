<script setup>
import Modal from '@/Components/Modal.vue';

const emit = defineEmits(['close']);


const props =  defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    ticket: {
        type: Object,
        default: null,
    }
});

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium text-gray-900">
                        <slot name="title" />
                    </h3>

                    <div class="mt-4 text-sm bg-gray-100 text-gray-600">
                        <slot name="ticket-details" />
                    </div>
                    <div class="mt-4 text-sm bg-gray-100 text-gray-600 mb-4">
                        <slot name="ticket-message" />
                    </div>
                    <div class="mt-4 text-sm bg-gray-100 text-gray-600 mb-4">
                        <slot name="ticket-reply" />
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>
