<script setup>

import {Link, router, useForm} from "@inertiajs/vue3";
import FormSectionCustom from "../FormSectionCustom.vue";
import InputLabel from "../InputLabel.vue";
import TextInput from "../TextInput.vue";
import InputError from "../InputError.vue";
import {notify} from "notiwind";
import PrimaryButton from "../PrimaryButton.vue";
import {defineProps} from "vue";
import { useVuelidate } from '@vuelidate/core'
import { required, helpers, minLength, maxLength, sameAs } from '@vuelidate/validators'

const emit = defineEmits(['close-modal']);

const props = defineProps({
    selectedUser: {
        type: Object,
        default: null,
    }
});

const form = useForm({
    _method:'PUT',
    password: '',
    password_confirmation:'',
    user:null,
    processing: false
});

const rules = {
    password: {
        required: helpers.withMessage("Password is required", required),
        minLength: minLength(8),
        maxLength: maxLength(8)
    },
    password_confirmation: {
        required: helpers.withMessage("Password confirmation is required", required),
        minLength: minLength(8),
        maxLength: maxLength(8)
    }
}

const v$ = useVuelidate(rules, form)

const updatePassword = async () => {
    let result = await v$.value.$validate();
    if (result){
        form.processing = true;
        form.user = props.selectedUser;
        try {
            form.post(route('user.page.adminChangePassword', {'id': props.selectedUser.id}), {
                preserveState: true,
                errorBag: 'updatePassword',
                onSuccess: () => {
                    form.reset();
                    form.processing = false;
                    // close modal
                    emit("close-modal");
                    router.visit(route('user.page.index', {'page': 1, 'entries': 10}), {
                        preserveState: true,
                        preserveScroll: true,
                        onSuccess: () => {
                            notify({
                                group: "success",
                                title: "Success",
                                text: "User password successfully changed!"
                            }, 4000);
                        }
                    })
                },
                onError: (e) => {
                    notify({
                        group: "error",
                        title: "Error",
                        text: e
                    }, 4000)
                }
            });
        } catch (e) {
            if (e.response.status === 422) {
                notify({
                    group: "error",
                    title: "Error",
                    text: e.response.data.errors
                }, 4000)
            }
        }
    }
}
</script>

<template>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <p class="text-gray-700 text-base font-bold mb-2">Reset password for {{ selectedUser.name }}</p>
        <FormSectionCustom @submitted="updatePassword">
            <template #form>
                <div class="grid grid-cols-1 gap-4 mt-3">
                    <div class="">
                        <div :class="{ error: v$.password.$errors.length }">
                        <InputLabel value="New password (Create a strong password: Combine a special character, a number, a lowercase letter, and an uppercase letter for maximum security!)"/>
                        <TextInput
                            type="password"
                            v-model="form.password"
                            class="mt-1 block w-full"
                            placeholder="New password"
                        />
                            <div class="input-errors" v-for="error of v$.password.$errors" :key="error.$uid">
                                <InputError class="mt-2" :message="error.$message"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 mt-3">
                    <div class="">
                        <div :class="{ error: v$.password_confirmation.$errors.length }">
                        <InputLabel value="Confirm new password"/>
                        <TextInput
                            type="password"
                            v-model="form.password_confirmation"
                            class="mt-1 block w-full"
                            placeholder="Confirm new password"
                        />
                            <div class="input-errors" v-for="error of v$.password_confirmation.$errors" :key="error.$uid">
                                <InputError class="mt-2" :message="error.$message"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <Link :href="route('user.page.index', {'page': 1, 'entries': 10})">
                        <button type="button"
                                class="inline-block px-6 py-3 m-0 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 text-slate-800">
                            Cancel
                        </button>
                    </Link>
                    <PrimaryButton
                        btnClass="inline-block px-6 py-3 m-0 ml-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-primary shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Change Password
                    </PrimaryButton>
                </div>
            </template>
        </FormSectionCustom>
    </div>
</template>
