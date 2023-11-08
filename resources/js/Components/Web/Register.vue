<script setup>
import Globe from "@/Components/Globe.vue";
import {Link, useForm} from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    fname: '',
    lname: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
    terms_and_condition: false,
});

const submit = () => {
    form.name = form.fname + ' ' + form.lname
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
<template>
    <div class="relative login">
        <div class="container">
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 xl:grid-cols-2">
                <!--Left section-->
                <div class="bg-primary text-center xl:text-left Left-section mt-10 lg:mt-20">
                    <div class="text-4xl sm:text-5xl text-white font-bold mt-5">Get started</div>
                    <div class="text-xl sm:text-2xl text-white font-bold mt-5">Together, Shaping your future</div>
                    <form @submit.prevent="submit">
                        <div class="w-full xl:w-4/5 my-10">
                            <div class="md:flex gap-5 xl:w-full">

                                <div class="relative float-label-input text-center lg:text-left w-full">
                                    <TextInput
                                        id="fname"
                                        type="text"
                                        v-model="form.fname"
                                        custom-class="block w-full xl:w-full bg-ash-100 text-base focus:outline-none focus:shadow-outline rounded-md py-4 px-3 block appearance-none leading-normal border-none"
                                        required
                                        autofocus
                                        autocomplete="fname"
                                        placeholder="Firstname*"
                                    />
                                    <InputError class="mt-2" :message="form.errors.fname" :color="'#ddb667'"/>
                                </div>

                                <div class="relative float-label-input text-center lg:text-left mt-10 md:mt-0 w-full">
                                    <TextInput
                                        id="lname"
                                        type="text"
                                        v-model="form.lname"
                                        custom-class="block w-full xl:w-full bg-ash-100 text-base focus:outline-none focus:shadow-outline rounded-md py-4 px-3 block appearance-none leading-normal border-none"
                                        required
                                        autocomplete="lname"
                                        placeholder="Lastname*"
                                    />
                                    <InputError class="mt-2" :message="form.errors.lname" :color="'#ddb667'"/>
                                </div>
                            </div>
                            <div class="relative float-label-input text-center lg:text-left mt-10">
                                <TextInput
                                    id="email"
                                    type="email"
                                    v-model="form.email"
                                    custom-class="block w-full xl:w-4/5 xl:w-full bg-ash-100 text-base focus:outline-none focus:shadow-outline rounded-md py-4 px-3 block appearance-none leading-normal focus:border-blue-400"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Email*"
                                />
                                <InputError class="mt-2" :message="form.errors.email" :color="'#ddb667'"/>
                            </div>
                            <div class="relative float-label-input text-center lg:text-left mt-10">
                                <p style="color: #fff; margin-bottom: 20px" class="text-sm sm:text-base">Create a strong password: Combine a special character, a number, a lowercase letter, and an uppercase letter for maximum security!</p>
                                <TextInput
                                    id="password"
                                    type="password"
                                    v-model="form.password"
                                    custom-class="block w-full xl:w-4/5 xl:w-full bg-ash-100 text-base focus:outline-none focus:shadow-outline rounded-md py-4 px-3 block appearance-none leading-normal focus:border-blue-400"
                                    required
                                    autofocus
                                    autocomplete="new-password"
                                    placeholder="Password*"
                                />
                                <InputError class="mt-2" :message="form.errors.password" :color="'#ddb667'"/>
                            </div>
                            <div class="relative float-label-input text-center lg:text-left mt-10">
                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    v-model="form.password_confirmation"
                                    custom-class="block w-full xl:w-4/5 xl:w-full bg-ash-100 text-base focus:outline-none focus:shadow-outline rounded-md py-4 px-3 block appearance-none leading-normal focus:border-blue-400"
                                    required
                                    autofocus
                                    autocomplete="new-password"
                                    placeholder="Confirm password*"
                                />
                                <InputError class="mt-2" :message="form.errors.password_confirmation" :color="'#ddb667'"/>
                            </div>
                        </div>
                        <div class="grid gap-3 sm:gap-0 sm:flex justify-between w-full xl:w-4/5">
                            <div class="flex items-center">
                                <Checkbox v-model:checked="form.terms_and_condition" name="terms_and_condition"
                                          class="w-4 h-4 form-checkbox text-primary"/>
                                <div for="link-checkbox" class="ml-2 text-sm sm:text-base font-normal text-white text-left">I agree to Terms & Conditions</div>
                            </div>
                            <div for="link-checkbox" class="ml-6 sm:ml-2 text-sm sm:text-base font-normal text-white text-left">
                                <Link :href="route('login')">Already registered?</Link>
                            </div>
                        </div>
                        <InputError class="mt-2" :message="form.errors.terms_and_condition" :color="'#ddb667'"/>
                        <div class="w-full xl:w-4/5 mt-5 lg:mt-10">
                            <PrimaryButton
                                btnClass="login-btn text-center text-base sm:text-xl text-white font-normal bg-gold-900 rounded-full w-full py-3 my-8"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Register
                            </PrimaryButton>
                        </div>
                    </form>

                    <div class="text-sm sm:text-base font-normal text-white text-center xl:text-left mt-3">OR</div>
                    <div class="flex justify-center mt-10 my-20 gap-5 xl:justify-start">
                        <a :href="route('auth.google')"
                           class="social-button" id="google-connect" target="_blank">
                            <img src="https://gel.imperiallearning.co.uk/wp-content/uploads/2023/05/Social-Login-Google.png"
                                 alt="google">
                        </a>
                        <a :href="route('auth.facebook')"
                           class="social-button" id="facebook-connect" target="_blank">
                            <img src="https://gel.imperiallearning.co.uk/wp-content/uploads/2023/05/Social-Login-Facebook.png"
                                 alt="facebook">
                        </a>
                        <a :href="route('auth.linkedin')" class="social-button" id="facebook-connect" target="_blank">
                            <img src="https://gel.imperiallearning.co.uk/wp-content/uploads/2023/05/Social-Login-Linkedin.png"
                                 alt="linkedin">
                        </a>
                    </div>

                </div>
                <!--Right section-->
                <div class="hidden xl:block">
                    <div id="globe" class="flex justify-center mt-24 lg-max:overflow-hidden top-1/10">
                        <Globe customClass="w-3/4 h-3/4 lg-max:w-full lg:mt-16 lg:mr-0" width="600" height="500"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

.float-label-input:focus-within label,
.float-label-input input:not(:placeholder-shown) + label {
    transform: translateY(-1.5rem) scale(0.75);
    background-color: rgba(255, 255, 255, 0.8);
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 33px;
    color: #474747;
    border-radius: 10px;
}

.login::before,
.login::after {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    width: 50%;
    z-index: -1;
}

.login::before {
    left: 0;
    background-color: #5B51E1;
}


.login::after {
    right: 0;
    background-color: #ffffff;
}


@media only screen and (max-width: 1200px) {

    .login::before,
    .login::after {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
        z-index: -1;
    }

    .login::after {
        right: 0;
        background-color: #5B51E1;
    }
}

</style>
