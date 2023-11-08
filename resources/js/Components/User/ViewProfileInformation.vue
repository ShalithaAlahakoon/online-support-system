<script setup>
import { usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import ProfileLayout from "./ProfileLayout.vue";

const props = defineProps({
    user: Object,
});

const profilePicturePath = (
    socialitePicture,
    profilePicturePath,
    profilePictureURL
) => {
    let picturePath;
    if (socialitePicture !== null){
        picturePath = socialitePicture;
    }else if (profilePicturePath !== null){
        picturePath = usePage().props.baseURL + '/storage/' + profilePicturePath;
    }else{
        picturePath = profilePictureURL;
    }
    return picturePath;
}
</script>

<template>
    <ProfileLayout :user="user">
        <template #title>
            <img :src="$page.props.assetURL ? user.profile_photo_url:profilePicturePath(user.socialite_picture, user.profile_photo_path, user.profile_photo_url)" :alt="user.name" class="rounded-full h-30 w-30 object-cover"><br>
            Profile Information
        </template>

        <template #information>
            <p class="div-margin"><b>Username</b> : {{ user.name }}</p>
            <p><b>Email</b> : {{ user.email }}</p>
            <p><b>About user</b> : {{ user.about_me }}</p>
        </template>
    </ProfileLayout>
</template>
<style scoped>
.div-margin{
    margin-top: 40px;
}
</style>
