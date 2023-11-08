<script setup>
import ViewProfileInformation from "@/Components/User/ViewProfileInformation.vue";

defineProps({
    user: {
        type: Object,
        default: null,
    }
});
</script>

<template>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <ViewProfileInformation :user="user" />
        </div>
    </div>
</template>
