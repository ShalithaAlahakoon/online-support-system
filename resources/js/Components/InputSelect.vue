<template>
    <div>
        <vue-select
            id="select-single"
            v-model="selectedOption"
            :options="options"
            :label="label"
            :track-by="trackBy"
            class="dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:outline-none"
            :placeholder="placeholder"
        ></vue-select>
    </div>
</template>

<script setup>
import {computed} from 'vue';
        const props = defineProps({
            modelValue: {
                type:String,
                default:null
            },
            options: {
                type:Object,
                default:null
            },
            placeholder: {
                type:String,
                default: 'Select option'
            },
            label: {
                type:String,
                default: 'name'
            },
            trackBy: {
                type:String,
                default: 'id'
            }
        });

        const emit = defineEmits(['update:modelValue']);

        const selectedOption = computed({
            get(){
                return props.options.filter((option) => {
                    return option.id === props.modelValue
                })
            },
            set(value){
                emit('update:modelValue', value.id)
            }
        });
</script>
<style>
.vs__dropdown-toggle {
    border: none;
}
.vs__clear{
    display: none;
}
.vs__search {
    color: #929292;
    font-size: 14px !important;
}
.vs_dropdown-option{
    padding-top: 3px;
    padding-bottom: 3px;
}
</style>
