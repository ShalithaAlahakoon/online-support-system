<script setup>
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
//import image from "../../assets/images/hero.png";

const form = useForm({
  _method: "POST",
  name: "",
  email: "",
  phone_number: "",
  problem_description: "",
  status: false,
});

const supportTicket = async () => {
  try {
    form.post(route("ticket.page.store"), {
      preserveState: true,
      preserveScroll: true,
      errorBag: "newTicket",
      onSuccess: () => {
        form.reset();
      },
    });
  } catch (e) {
    if (e.response.status === 422) {
      notify(
        {
          group: "error",
          title: "Error",
          text: e.response.data.errors,
        },
        4000
      );
    }
  }
};
</script>

<template>
  <form @submit.prevent="supportTicket" class="w-full h-full bg-white">
    <div class="w-full h-full bg-white">
      <div class="container">
        <div class="text-center py-10">
          <div class="text-2xl sm:text-5xl text-black font-bold my-5">
            Welcome to our virtual customer support hub
          </div>
          <div class="text-sm sm:text-lg text-black font-medium max-w-[80ch] mx-auto">
            Our Online Support Center serves as your entrance to effective help and
            advice. We are here to attend to your questions and offer resolutions,
            guaranteeing a smooth and hassle-free experience.
          </div>
        </div>
        <div class="grid xl:grid-cols-2 sm:grid-cols-1 gap-4 pb-10">
          <div>
            <div class="mt-10 rounded-3 flex justify-center  mx-auto bg-white shadow-xl ">
              <div class="w-4/5 mb-10">
                <div class="relative text-center lg:text-left mt-10">
                  <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    class="block w-full xl:w-full bg-gray-100 rounded-lg px-2.5 pb-2.5 pt-5 text-sm text-gray-900 border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                  />
                  <label
                    for="floating_filled"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4"
                    >Name</label
                  >
                  <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="relative text-center lg:text-left mt-10">
                  <input
                    v-model="form.email"
                    class="block w-full xl:w-full bg-gray-100 rounded-lg px-2.5 pb-2.5 pt-5 text-sm text-gray-900 border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                  />
                  <label
                    for="floating_filled"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4"
                    >Email</label
                  >
                  <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="relative text-center lg:text-left mt-10">
                  <input
                    type="text"
                    id="phone_number"
                    v-model="form.phone_number"
                    class="block w-full xl:w-full bg-gray-100 rounded-lg px-2.5 pb-2.5 pt-5 text-sm text-gray-900 border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                  />
                  <label
                    for="floating_filled"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4"
                    >Phone Number</label
                  >
                  <InputError class="mt-2" :message="form.errors.phone_number" />
                </div>
                <div class="relative text-center lg:text-left mt-10">
                  <input
                    type="text"
                    id="description"
                    v-model="form.problem_description"
                    class="block w-full xl:w-full bg-gray-100 rounded-lg px-2.5 pb-2.5 pt-5 text-sm text-gray-900 border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer h-25"
                    placeholder=" "
                  />
                  <label
                    for="floating_filled"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4"
                    >Problem Description</label
                  >
                  <InputError class="mt-2" :message="form.errors.problem_description" />
                </div>
              </div>
            </div>
            <div class="text-center">
              <a href="#"
                ><button
                  type="submit"
                  class="text-center text-base sm:text-xl text-white font-normal bg-green-900 rounded-full px-12 py-3 my-8"
                >
                  Inquire now
                </button></a
              >
            </div>
          </div>
          <div class=" xl:block sm:hidden">
            <img :src="$page.props.assetURL ? $page.props.assetURL + '/img/help.png':'../../img/help.png'" alt="">
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<style scoped>
.list-square {
  list-style: square;
  color: #ffff;
  font-size: 30px;
}
</style>
