<script setup>
import SidenavList from "@/Components/SidenavList.vue";
import NavLink from "@/Components/NavLink.vue";

defineProps({
    customClass: {
        type: String,
        default: "",
    }
})
</script>
<template>
    <aside
        id="sidenav-main"
        :class="customClass"
        class="fixed inset-y-0 left-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto transition-all duration-200 -translate-x-full bg-white border-0 shadow-none xl:ml-4 dark:bg-gray-950 ease-soft-in-out max-w-64 rounded-2xl xl:translate-x-0 xl:bg-transparent z-0"
    >
        <div>
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 dark:text-white xl:hidden" aria-hidden="true" id="iconSidenav" sidenav-close-btn></i>
            <NavLink :href="route('dashboard')" class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700 dark:text-white">
            </NavLink>
        </div>
        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
        <SidenavList :card-bg="customClass" :permissions="$page.props.permissions"/>
    </aside>
</template>
<style scoped>
#sidenav-main::-webkit-scrollbar-track
{
    border-radius: 10px;
    background-color: #ffffff;
}

#sidenav-main::-webkit-scrollbar
{
    width: 2px;
    background-color: #ffffff;
}

#sidenav-main::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    background-color: #929292;
}

#sidenav-main::-webkit-scrollbar-track:hover{
    background-color: #AEB6FF;
}
</style>
