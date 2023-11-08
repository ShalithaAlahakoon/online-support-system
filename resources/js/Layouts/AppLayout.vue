<script setup>
import { Head } from '@inertiajs/vue3';
import SidebarNav from "@/Components/SidebarNav.vue";
import Navbar from "@/Components/Navbar.vue";
import SettingNav from "@/Components/SettingNav.vue";
import Footer from "@/Components/Footer.vue";
import NotificationAlert from "@/Components/NotificationAlert.vue";

defineProps({
    title: String,
    currentPage: String,
    backUrl: String,
});
</script>
<template>
    <NotificationAlert />
    <Head :title="title"/>
    <!-- sidenav -->
    <SidebarNav/>
    <main class="relative h-full max-h-screen transition-all duration-200 ease-soft-in-out xl:ml-68 rounded-xl">
        <Navbar :current-page="currentPage" :backUrl="backUrl" />
        <div class="w-full p-6 mx-auto">
            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
            <Footer />
        </div>
    </main>
    <SettingNav />
</template>
<style>
.header-style{
    background-color: #5b51e1;
    color: #fff;
    padding: 1%;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    font-size: 16px;
    font-weight: 600;
}

.index-heading{
    font-size: 24px;
    font-weight: Bold;
}

.tbl-overflow-hidden{
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

/* Common scroll bar */
.common-scroll-bar{
    height: 150px;
    overflow: hidden;
}
.common-scroll-bar:hover{
    overflow-y: scroll;
}
.common-scroll-bar::-webkit-scrollbar-track
{
    border-radius: 10px;
    background-color: #ffffff;
}
.common-scroll-bar::-webkit-scrollbar
{
    width: 2px;
    background-color: #ffffff;
}
.common-scroll-bar::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    background-color: #929292;
}
.common-scroll-bar::-webkit-scrollbar-track:hover{
    background-color: #AEB6FF;
}

@media print {
    .hide-on-print {
        display: none;
    }

    .full-width {
        width: 1%;
    }

    .print-text-center{
        text-align: center;
    }

    table {
        margin: 0 auto;
        width: 100%;
    }

    th, td {
        text-align: left !important;
    }
}
</style>
