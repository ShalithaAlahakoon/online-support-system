<template>
  <li class="w-full">
      <NavLink
        :href="requestParam ? route(to, requestParam):route(to)"
        :class="itemClass"
        :id="itemId"
        >
          <span class="w-0 text-center transition-all duration-200 opacity-0 pointer-events-none ease-soft-in-out"> {{ miniIcon }} </span>
          <span class="transition-all duration-100 pointer-events-none ease-soft"> {{ text }} </span>
      </NavLink>
  </li>
</template>
<script setup>
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    to: {
        type: String,
        required: true,
    },
    requestParam: {
        type: Object,
        default:null
    },
    miniIcon: {
        type: String,
        required: true,
    },
    text: {
        type: String,
        required: true,
    },
    itemClass: {
        type: String,
    },
    itemId:{
        type: String,

    },
});
</script>
