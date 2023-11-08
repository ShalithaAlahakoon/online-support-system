<script setup>
import Globe from "@/Components/Globe.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import { Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      remember: form.remember ? "on" : "",
    }))
    .post(route("login"), {
      onFinish: () => form.reset("password"),
    });
};
</script>
<template>
  <div class="relative login">
    <div class="container">
      <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 xl:grid-cols-2">
        <!--Left section-->
        <div class="bg-primary text-center xl:text-left Left-section mt-10 lg:mt-20">
          <div class="text-4xl sm:text-5xl text-white font-bold mt-5">Welcome!</div>
          <div class="text-xl sm:text-2xl text-white font-bold mt-5">
            Together, Shaping your future
          </div>
          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
          </div>
          <form @submit.prevent="submit">
            <div class="w-full xl:w-4/5 my-10">
              <div class="relative float-label-input text-center lg:text-left">
                <TextInput
                  id="email"
                  type="email"
                  v-model="form.email"
                  custom-class="block w-full xl:w-full bg-ash-100 text-base focus:outline-none focus:shadow-outline rounded-md py-4 px-3 block appearance-none leading-normal border-none"
                  required
                  autofocus
                  autocomplete="username"
                  placeholder="Email*"
                />
                <InputError
                  class="mt-2"
                  :message="form.errors.email"
                  :color="'#ddb667'"
                />
              </div>
              <div class="relative float-label-input text-center lg:text-left mt-10">
                <TextInput
                  id="password"
                  type="password"
                  v-model="form.password"
                  custom-class="block w-full xl:w-full bg-ash-100 text-base focus:outline-none focus:shadow-outline rounded-md py-4 px-3 block appearance-none leading-normal border-none"
                  required
                  autofocus
                  autocomplete="current-password"
                  placeholder="Password*"
                />
                <InputError
                  class="mt-2"
                  :message="form.errors.password"
                  :color="'#ddb667'"
                />
              </div>
            </div>
            <div class="flex justify-between w-full xl:w-4/5">
              <div class="flex items-center">
                <Checkbox
                  v-model:checked="form.remember"
                  name="remember"
                  class="w-4 h-4 form-checkbox text-primary"
                />
                <div
                  for="link-checkbox"
                  class="ml-2 text-sm ms:text-base font-normal text-white"
                >
                  Remember me
                </div>
              </div>
              <div
                for="link-checkbox"
                class="ml-2 text-sm sm:text-base font-normal text-white"
              >
                <Link v-if="canResetPassword" :href="route('password.request')"
                  >Forget password?</Link
                >
              </div>
            </div>
            <div
              class="w-full xl:w-4/5 mt-5 xl:mt-10 flex justify-center xl:justify-start"
            >
              <PrimaryButton
                btnClass="login-btn text-center text-base sm:text-xl text-white font-normal bg-gold-900 rounded-full w-full py-3 my-8"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Login
              </PrimaryButton>
            </div>
          </form>
          
        </div>
        <!--Right section-->
        <div class="hidden xl:block">
          <div
            id="globe"
            class="flex justify-center mt-24 lg-max:overflow-hidden top-1/10"
          >
            <Globe
              customClass="w-3/4 h-3/4 lg-max:w-full lg:mt-16 lg:mr-0"
              width="600"
              height="500"
            />
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
  background-color: #14532d;
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
    background-color: #14532d;
  }
}
</style>
