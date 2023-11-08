<template>
    <li class="w-full">
        <a
            class="after:ease-soft-in-out after:font-awesome-5-free ease-soft-in-out py-1.6 ml-5.4 pl-4 text-sm before:-left-4.5 before:h-1.25 before:w-1.25 relative my-0 mr-4 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors before:absolute before:top-1/2 before:-translate-y-1/2 before:rounded-3xl before:bg-slate-800/50 before:content-[''] dark:text-white dark:opacity-60 dark:before:bg-white dark:before:opacity-80 dark:after:text-white/50 dark:after:text-white"
            data-bs-toggle="collapse"
            aria-expanded="false"
            @click="isExpandedChild = !isExpandedChild"
        >
            <span class="w-0 text-center transition-all duration-200 opacity-0 pointer-events-none ease-soft-in-out"> {{miniIcon}} </span>
            <span class="transition-all duration-100 pointer-events-none ease-soft"> {{ text }} <b class="caret"></b></span>
            <span class="after:font-awesome-5-free ml-auto inline-block after:font-bold after:text-slate-800/50 after:antialiased after:content-['\f107'] transition-all duration-700" :class="{'transform rotate-180 transition-all duration-700': isExpandedChild}"></span>
        </a>
        <div class="h-auto overflow-hidden" v-show="isExpandedChild">
            <ul class="flex flex-col flex-wrap pl-0 mb-0 list-none transition-all duration-700">
                <slot name="nav-child-item"/>
            </ul>
        </div>
    </li>
</template>

<script>
export default {
    name: "SidenavCollapseItem",
    data() {
        return {
            isExpandedChild: false,
        };
    },
    props: {
        miniIcon: {
            type: String,
            required: true
        },
        text: {
            type: String,
            required: true
        }
    }
};
</script>
