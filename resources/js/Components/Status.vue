<script setup>
defineProps({
    status: {
        type: String,
        default: 'Active'
    }
})

const style = (status) => {
    switch (status) {
        case 'Active':
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-green-700 bg-green-200"
        case 'Published':
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-green-700 bg-green-200"
        case 'Posted':
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-green-700 bg-green-200"
        case 'New':
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-green-700 bg-green-200"
        case 'Renewal':
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-yellow-700 bg-yellow-200"
        case 'Inactive':
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-yellow-700 bg-yellow-200"
        case 'Unpublished':
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-yellow-700 bg-yellow-200"
        case 'Pending':
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-yellow-700 bg-yellow-200"
        case 'Blocked':
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-red-700 bg-red-200"
        case 'Old Record':
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-red-700 bg-red-200"
        default:
            return "py-1.8 px-3 text-xxs rounded-1 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-green-700 bg-green-200"
    }
}

</script>
<template>
    <span :class="style(status)">{{ status }}</span>
</template>
