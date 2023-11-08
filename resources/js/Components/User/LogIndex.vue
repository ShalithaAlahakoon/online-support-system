<script setup>
const props = defineProps({
    logs: {
        type: Object,
        default: null,
    }
});
</script>

<template>
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 flex-0">
            <div class="lg:flex div-margin">
                <div>
                    <h1 class="mb-0 dark:text-white">Logs</h1>
                </div>
            </div>
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto pt-2 pb-6 px-0 pb-0 pl-2 pr-2">
                    <div class="overflow-x-auto table-responsive">
                        <table class="table" id="printUserTable">
                            <thead class="thead-light">
                            <tr>
                                <th>Log name</th>
                                <th>Description</th>
                                <th>Causer</th>
                                <th>Attributes</th>
                                <th width="1%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="log in logs" :key="log.id">
                                <td class="leading-normal text-sm">{{ log ? log.log_name:null }}</td>
                                <td class="leading-normal text-sm">{{ log ? log.description:null }}</td>
                                <td class="leading-normal text-sm">{{ log.causer ? log.causer.name:null }}</td>
                                <td class="leading-normal text-sm">{{ log.properties ? log.properties:null }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.div-margin{
    margin-bottom: 30px;
}
</style>
