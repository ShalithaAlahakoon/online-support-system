<script setup>
import {  defineProps } from "vue";

import SidenavItem from "@/Components/SidenavItem.vue";
import SidenavCollapse from "@/Components/SidenavCollapse.vue";

const props = defineProps({
    permissions: {
        type: Array,
        default: [],
        required: true,
    },
    cardBg: {
        type: String,
        default: "",
    },
});


const expanded = (value, sectionId) => {
    const targetDiv = document.getElementById(sectionId);

    if (value) {
        if (targetDiv) {
            const icons = targetDiv.querySelectorAll(".icon-path");
            icons.forEach((icon) => {
                icon.setAttribute("fill", "#ffffff");
            });
            targetDiv.classList.remove("bg-white");
            targetDiv.classList.add("bg-primary");
        }
    } else {
        if (targetDiv) {
            const icons = targetDiv.querySelectorAll(".icon-path");
            icons.forEach((icon) => {
                icon.setAttribute("fill", "#444444");
            });
            targetDiv.classList.add("bg-white");
            targetDiv.classList.remove("bg-primary");
        }
    }
};

</script>

<template>
    <div
        id="sidenav-collapse-main"
        class="items-center block w-full h-auto grow basis-full mt-4"
    >
        <ul class="flex flex-col pl-0 mb-0 list-none">

            <li class="mt-3 w-full">
                <SidenavCollapse
                    nav-text="User"
                    @expanded="value => expanded(value, 'user-id')"
                    collapseClass="text-sm py-2.7 my-0 mx-3 font-semibold flex items-center whitespace-nowrap rounded-lg text-slate-700 dark:text-white dark:opacity-80"
                >
                    <template #icon>
                        <div id="user-id"
                             class="stroke-none shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center p-2.5 text-center text-white">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="icon-path" d="M7.5 6.75C8.74268 6.75 9.75 5.74264 9.75 4.5C9.75 3.25736 8.74268 2.25 7.5 2.25C6.25736 2.25 5.25 3.25736 5.25 4.5C5.25 5.74264 6.25736 6.75 7.5 6.75Z" fill="#444444"/>
                                <path class="icon-path" d="M2.25 13.5C2.25 10.6005 4.60051 8.25 7.5 8.25C10.3995 8.25 12.75 10.6005 12.75 13.5H2.25Z" fill="#444444"/>
                            </svg>
                        </div>
                    </template>
                    <template #list>
                        <ul class="flex flex-wrap pl-4 mb-0 ml-6 list-none transition-all duration-200 ease-soft-in-out">
                            <SidenavItem
                                itemId="user-link"
                                :to="'user.page.index'"
                                :request-param="{'entries': 10, 'page': 1}"
                                mini-icon="A"
                                text="Users"
                                itemClass="ease-soft-in-out py-1.6 ml-5.4 pl-4 text-sm before:-left-5 relative my-0 mr-4 flex items-center whitespace-nowrap rounded-lg bg-transparent pr-4 active:font-semibold text-slate-800/50 active:text-slate-800 shadow-none transition-colors before:absolute before:top-1/2 before:h-1.25 active:before:h-2 before:w-1.25 active:before:w-2 before:rounded-3xl before:bg-slate-800/50 active:before:bg-slate-800 before:content-[''] dark:text-white dark:opacity-100 dark:before:bg-white dark:before:opacity-80"
                            />
                            <SidenavItem
                                :to="'role.page.index'"
                                :request-param="{'entries': 10, 'page': 1}"
                                mini-icon="A"
                                text="Roles"
                                itemClass="ease-soft-in-out py-1.6 ml-5.4 pl-4 text-sm before:-left-5 relative my-0 mr-4 flex items-center whitespace-nowrap rounded-lg bg-transparent pr-4 active:font-semibold text-slate-800/50 active:text-slate-800 shadow-none transition-colors before:absolute before:top-1/2 before:h-1.25 active:before:h-2 before:w-1.25 active:before:w-2 before:rounded-3xl before:bg-slate-800/50 active:before:bg-slate-800 before:content-[''] dark:text-white dark:opacity-100 dark:before:bg-white dark:before:opacity-80"
                            />
                        </ul>
                    </template>
                </SidenavCollapse>
            </li>
            <li class="mt-3 w-full">
                <SidenavCollapse
                    nav-text="Support Tickets"
                    @expanded="value => expanded(value, 'tickets-id')"
                    collapseClass="text-sm py-2.7 my-0 mx-3 font-semibold flex items-center whitespace-nowrap rounded-lg text-slate-700 dark:text-white dark:opacity-80"
                >
                <template #icon>
                    <div id="tickets-id"
                        class="stroke-none shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current p-2.5 text-center text-black">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="icon-path" fill-rule="evenodd" clip-rule="evenodd" d="M12.5 6.5C12.5 9.81373 9.81373 12.5 6.5 12.5C3.18629 12.5 0.5 9.81373 0.5 6.5C0.5 3.18629 3.18629 0.5 6.5 0.5C9.81373 0.5 12.5 3.18629 12.5 6.5ZM6.5 4.25C6.22335 4.25 5.9807 4.39942 5.84988 4.62555C5.64248 4.98409 5.18368 5.10661 4.82514 4.89921C4.46659 4.69179 4.34407 4.233 4.55148 3.87445C4.93938 3.20389 5.66625 2.75 6.5 2.75C7.74267 2.75 8.75 3.75736 8.75 5C8.75 5.97966 8.1239 6.81313 7.25 7.12197V7.25C7.25 7.66423 6.91423 8 6.5 8C6.0858 8 5.75001 7.66423 5.75001 7.25V6.5C5.75001 6.08579 6.0858 5.75 6.5 5.75C6.91423 5.75 7.25 5.41421 7.25 5C7.25 4.58579 6.91423 4.25 6.5 4.25ZM6.5 10.25C6.91423 10.25 7.25 9.91422 7.25 9.5C7.25 9.08578 6.91423 8.75 6.5 8.75C6.08579 8.75 5.75 9.08578 5.75 9.5C5.75 9.91422 6.08579 10.25 6.5 10.25Z" fill="#444444"/>
                        </svg>
                    </div>
                </template>
                    <template #list>
                        <ul class="flex flex-wrap pl-4 mb-0 ml-6 list-none transition-all duration-200 ease-soft-in-out">
                            <SidenavItem
                                :to="'ticket'"
                                :request-param="{'entries': 10, 'page': 1}"
                                mini-icon="A"
                                text="Pending Support Tickets"
                                itemClass="ease-soft-in-out py-1.6 ml-5.4 pl-4 text-sm before:-left-5 relative my-0 mr-4 flex items-center whitespace-nowrap rounded-lg bg-transparent pr-4 active:font-semibold text-slate-800/50 active:text-slate-800 shadow-none transition-colors before:absolute before:top-1/2 before:h-1.25 active:before:h-2 before:w-1.25 active:before:w-2 before:rounded-3xl before:bg-slate-800/50 active:before:bg-slate-800 before:content-[''] dark:text-white dark:opacity-100 dark:before:bg-white dark:before:opacity-80"
                            />
                            <SidenavItem
                                :to="'ticket.page.resolvedTicketIndex'"
                                :request-param="{'entries': 10, 'page': 1,}"
                                mini-icon="A"
                                text="Resolved Support Tickets"
                                itemClass="ease-soft-in-out py-1.6 ml-5.4 pl-4 text-sm before:-left-5 relative my-0 mr-4 flex items-center whitespace-nowrap rounded-lg bg-transparent pr-4 active:font-semibold text-slate-800/50 active:text-slate-800 shadow-none transition-colors before:absolute before:top-1/2 before:h-1.25 active:before:h-2 before:w-1.25 active:before:w-2 before:rounded-3xl before:bg-slate-800/50 active:before:bg-slate-800 before:content-[''] dark:text-white dark:opacity-100 dark:before:bg-white dark:before:opacity-80"
                            />
                        </ul>
                    </template>
                </SidenavCollapse>
            </li>

        </ul>
    </div>
</template>

<style>
.active{
    color: red !important;
}
</style>

