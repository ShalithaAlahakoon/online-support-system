<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from '@/Components/Modal.vue';
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {notify} from "notiwind";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    modalClose: {
        type: Function,
        default: () => {},
    },

});

const form = useForm({
    _method: 'POST',
    language: '',
    code: '',
    isRtl: 'Yes',
});

const createNewLanguage = async () => {
    try {
        form.post(route('language.page.store'),{
            onSuccess: () => {
                props.modalClose();
                notify({
                    group: "success",
                    title: "Success",
                    text: "Language successfully created!"
                }, 4000)
            },
            onError: () => {
                notify({
                    group: "error",
                    title: "Error",
                    text: "Something went wrong!"
                }, 4000)
            }
        });
    }catch (e) {
        notify({
            group: "error",
            title: "Error",
            text: "Something went wrong!"
        }, 4000)
    }

};

</script>


<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        @close="$emit('close')"
        class="w-full"
    >
        <form @submit.prevent="createNewLanguage">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between">
                    <p class="text-gray-700 text-base font-bold mb-2">Create a Language</p>
                </div>

                <div class="grid grid-cols-2 w-full">
                    <div class="m-4">
                        <div class="w-full mb-5">
                            <div class="">
                                <InputLabel value="Language Name*"/>
                                <TextInput
                                    id="languageName"
                                    placeholder="Language Name"
                                    v-model="form.language"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.language"/>
                            </div>
                        </div>
                    </div>
                    <div class="m-4">
                        <div class="w-full mb-5">
                            <div class="">
                                <InputLabel value="Code*"/>
                                <TextInput
                                    id="code"
                                    placeholder="Language Code"
                                    v-model="form.code"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.code"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <PrimaryButton
                        btnClass="inline-block px-6 py-3 m-0 ml-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-primary shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Create
                    </PrimaryButton>
                </div>

            </div>
        </form>
    </Modal>
</template>


