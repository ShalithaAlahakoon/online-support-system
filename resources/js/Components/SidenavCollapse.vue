<template>
    <div class="mx-4">
        <div class="transition-all duration-700" :class="{'transition-all duration-700 xl:shadow-soft-xl bg-white rounded-lg transform scale-105': isExpanded}">
            <a
                :class="collapseClass"
                @click="toggleExpand"
            >
                <slot name="icon"></slot>

                <span class="ml-1 duration-300 opacity-100 pointer-events-none text-slate-700">{{ navText }}</span>
                <span
                    class="after:font-awesome-5-free ml-auto inline-block after:font-bold after:text-slate-800 after:antialiased after:content-['\f107'] transition-all duration-400"
                    :class="{'transform rotate-180 transition-all duration-400': isExpanded, 'invisible': !showDropdownArrow}"
                >
      </span>
            </a>
        </div>
    </div>
    <div v-show="isExpanded">
        <slot name="list"></slot>
    </div>
</template>
<script setup>
import {ref} from "vue";

const isExpanded = ref(false);
const emit = defineEmits(['expanded'])

const props = defineProps({
    navText: {
        type: String,
        required: true
    },
    collapseClass: {
        type: String,
    },
    showDropdownArrow: {
        type: Boolean,
        default: true,
    }
});

const toggleExpand = () => {
    isExpanded.value = !isExpanded.value;
    emit("expanded", isExpanded.value);
};
</script>
