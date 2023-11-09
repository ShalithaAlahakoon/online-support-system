<script setup>
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { ref, defineProps } from "vue";
import notify from "notiwind";
//import image from "../../assets/images/hero.png";
const props = defineProps({
    ticket: {
        type: Object,
        default: null,
    },
});
const form = useForm({
  _method: "POST",
  reference_number: "",
});

const response = ref(null);

const supportTicket = async () => {
  try {
    form.post(route("ticket.status"), {
      preserveState: true,
      preserveScroll: true,
      errorBag: "newTicket",
      onSuccess: () => {
        form.reset();
        console.log(props.ticket);
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
            Track your ticket
          </div>
        </div>
        <div class="grid xl:grid-cols-2 sm:grid-cols-1 gap-4 pb-10">
          <div>
            <div class="mt-10 rounded-3 flex justify-center mx-auto bg-white shadow-xl">
              <div class="w-4/5 mb-10">
                <div class="relative text-center lg:text-left mt-10">
                  <input
                    type="text"
                    id="name"
                    v-model="form.reference_number"
                    class="block w-full xl:w-full bg-gray-100 rounded-lg px-2.5 pb-2.5 pt-5 text-sm text-gray-900 border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                  />
                  <label
                    for="floating_filled"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4"
                    >Refference number</label
                  >
                  <InputError class="mt-2" :message="form.errors.reference_number" />
                </div>
              </div>
            </div>
            <div class="text-center">
              <a href="#"
                ><button
                  type="submit"
                  class="text-center text-base sm:text-xl text-white font-normal bg-green-900 rounded-full px-12 py-3 my-8"
                >
                  Get status
                </button></a
              >
            </div>
          </div>
          <div class="xl:block sm:hidden">
            <img
              :src="
                $page.props.assetURL
                  ? $page.props.assetURL + '/img/progress.png'
                  : '../../img/progress.png'
              "
              alt=""
            />
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

img {
  margin: auto;
  height: 50vh;
}
</style>
