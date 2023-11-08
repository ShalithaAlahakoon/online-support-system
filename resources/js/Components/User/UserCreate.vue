<script setup>
import {ref} from 'vue';
import {Link, useForm, router} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Textarea from "@/Components/Textarea.vue";
import FormSectionCustom from "@/Components/FormSectionCustom.vue";
import {notify} from "notiwind";
import InputSelect from "@/Components/InputSelect.vue";

const props = defineProps({
    roles: {
        type: Object,
        default: null,
    },
    countries: {
        type: [],
        default: null,
    }
});

const form = useForm({
    _method: 'POST',
    fname: '',
    lname: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role_id: null,
    phone_number: '',
    photo: null,
    postal_address: '',
    status: null,
    country_id: null,
    about_me: '',
});

const photoPreview = ref(null);
const photoInput = ref(null);
const statusList = ref([
    {id: '1', name: 'Active'},
    {id: '2', name: 'Inactive'},
    {id: '3', name: 'Blocked'},
]);

const createNewUser = async () => {
    try {
        if (photoInput.value) {
            form.photo = photoInput.value.files[0];
        }

        form.post(route('user.page.store'), {
            preserveState: true,
            preserveScroll: true,
            errorBag: 'createNewUser',
            onSuccess: () => {
                form.reset('password', 'password_confirmation');
                router.visit(route('user.page.index'), {
                    onSuccess: () => {
                        notify({
                            group: "success",
                            title: "Success",
                            text: "User successfully created!"
                        }, 4000)
                    }
                })
            },
            onError: (e) => {
                console.log(e)
                form.reset('password', 'password_confirmation');
                notify({
                    group: "error",
                    title: "Error",
                    text: "Something went wrong!"
                }, 4000)
            }
        });
    } catch (e) {
        if (e.response.status === 422) {
            form.reset('password', 'password_confirmation')
            notify({
                group: "error",
                title: "Error",
                text: e.response.data.errors
            }, 4000)
        }
    }
}

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const selectedCountry = () => {
    form.phone_number = '+' + props.countries.filter((country) => {
        return country.id === form.country_id
    })[0]['phonecode'];
}
</script>

<template>
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mx-auto flex-0">
            <div
                class="relative flex flex-col flex-auto min-w-0 p-4 mt-6 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="mb-0 dark:text-white header-style">ADD NEW USER</div>
                <hr class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"/>
                <FormSectionCustom @submitted="createNewUser">
                    <template #form>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                <InputLabel value="First Name*"/>
                                <TextInput
                                    id="fname"
                                    v-model="form.fname"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="fname"
                                    placeholder="eg. Michael"
                                />
                                <InputError class="mt-2" :errorClass="'error_fname'" :message="form.errors.fname"/>
                            </div>
                            <div class="">
                                <InputLabel value="Last Name*"/>
                                <TextInput
                                    id="lname"
                                    v-model="form.lname"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="lname"
                                    placeholder="eg. Jackson"
                                />
                                <InputError class="mt-2" :message="form.errors.lname"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                <InputLabel value="Username*"/>
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="name"
                                    placeholder="eg. Michael Jackson"
                                />
                                <InputError class="mt-2" :message="form.errors.name"/>
                            </div>
                            <div class="">
                                <InputLabel value="Email Address*"/>
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    autocomplete="email"
                                    placeholder="eg. example@address.com"
                                />
                                <InputError class="mt-2" :message="form.errors.email"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                <InputLabel value="Password*"/>
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="password"
                                    placeholder="Password"
                                />
                                <InputError class="mt-2" :message="form.errors.password"/>
                            </div>
                            <div class="">
                                <InputLabel value="Confirmation Password*"/>
                                <TextInput
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    placeholder="Confirm Password"
                                />
                                <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                <InputLabel value="Role*"/>
                                <InputSelect
                                    :options="roles"
                                    placeholder="Choose a Role"
                                    v-model="form.role_id"
                                    class="mt-1 block w-full"
                                />
                                <InputError class="mt-2" :message="form.errors.role_id"/>
                            </div>
                            <div class="">
                                <InputLabel value="Country*"/>
                                <InputSelect
                                    :options="countries"
                                    placeholder="Choose a Country"
                                    v-model="form.country_id"
                                    @update:model-value="selectedCountry"
                                    class="mt-1 block w-full"
                                />
                                <InputError class="mt-2" :message="form.errors.country_id"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                <!-- User Photo File Input -->
                                <input
                                    ref="photoInput"
                                    type="file"
                                    class="hidden"
                                    @change="updatePhotoPreview"
                                >

                                <InputLabel value="User Image (Only jpg, jpeg and png files are allowed)"/>

                                <!-- Current Profile Photo -->
                                <div v-show="!photoPreview" class="mt-2">
                                    <img
                                        :src="$page.props.assetURL ? $page.props.assetURL + '/img/default_user.png':'../../img/default_user.png'"
                                        alt=""
                                        class="rounded-full h-20 w-20 object-cover">
                                </div>

                                <!-- New Profile Photo Preview -->
                                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                                </div>

                                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                                    Select A New Photo
                                </SecondaryButton>
                                <InputError class="mt-2" :message="form.errors.photo"/>
                            </div>
                            <div class="">
                                <InputLabel value="Phone Number"/>
                                <TextInput
                                    id="phone_number"
                                    v-model="form.phone_number"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="+44 234 345 345"
                                    autocomplete="phone_number"
                                />
                                <InputError class="mt-2" :message="form.errors.phone_number"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                <InputLabel value="Status*"/>
                                <InputSelect
                                    :options="statusList"
                                    placeholder="Choose a Status"
                                    v-model="form.status"
                                    class="mt-1 block w-full"
                                />
                                <InputError class="mt-2" :message="form.errors.status"/>
                            </div>
                            <div class="">
                                <InputLabel value="Billing Address*"/>
                                <TextInput
                                    id="postal_address"
                                    v-model="form.postal_address"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Please enter user address"
                                    autocomplete="postal_address"
                                />
                                <InputError class="mt-2" :message="form.errors.postal_address"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                <InputLabel value="About User"/>
                                <Textarea
                                    id="about_me"
                                    v-model="form.about_me"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Please enter about user"
                                />
                                <InputError class="mt-2" :message="form.errors.about_me"/>
                            </div>
                            <div class=""></div>
                        </div>
                        <div class="flex justify-end mt-6">
                            <Link :href="route('user.page.index')">
                                <button type="button"
                                        class="inline-block px-6 py-3 m-0 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 text-slate-800">
                                    Cancel
                                </button>
                            </Link>
                            <PrimaryButton
                                btnClass="inline-block px-6 py-3 m-0 ml-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-primary shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create User
                            </PrimaryButton>
                        </div>
                    </template>
                </FormSectionCustom>
            </div>
        </div>
    </div>
</template>
