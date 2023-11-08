<script setup>
import {inject, onMounted, ref, watch} from 'vue'
import dayjs from "dayjs";
import {Link, router} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import { notify } from "notiwind"
import Status from "@/Components/Status.vue";
import Filters from "@/Components/Filters.vue";
import RoleViewModal from "./RoleViewModal.vue";

const swal = inject('$swal')

const props = defineProps({
    roles: {
        type: Object,
        default: null,
    },
    requestParam: {
        type: Object,
        default: {
            'search': '',
            'entries': 10,
            'page': 1
        }
    }
});

const deleteRole = (role) => {
    router.delete(route('role.page.destroy', {'id': role.id}), {
        onSuccess: () => {
            router.visit(route('role.page.index'), {
                preserveScroll:true,
                preserveState:true,
                onSuccess: () => {
                    notify({
                        group: "success",
                        title: "Success",
                        text: "Role successfully deleted!"
                    }, 4000)
                }
            })
        }
    });
};

const deleteConfirmation = (role) => {
    swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancel",
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "inline-block mr-3 px-6 py-3 m-0 ml-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-primary shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85",
            cancelButton: "inline-block px-6 py-3 m-0 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 text-slate-800",
        },
        buttonsStyling: false,
    }).then((result) => {
        if (result.isConfirmed) {
            deleteRole(role);
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal.dismiss;
        }
    });
}

const changeStatus = (statusCode) => {
    switch (statusCode){
        case 1:

            return "Active"
        case 2:
            return "Inactive"
        case 3:
            return "Blocked"
        default:
            return "Active"
    }
}


const searchText = ref('');
const searchEntries = ref(10);

const handleKeyUpText = (text) => {
    searchText.value = text;
};
const handleSearchEntries = (entries) => {
    searchEntries.value = entries;
};

watch(searchText, async () => {
    await filterText();
});

watch(searchEntries, async () => {
    await filterEntries();
});

const filterText = async () => {
    router.get(route('role.page.index'), {
        'search': searchText.value,
        'entries': searchEntries.value,
        'page': (props.requestParam && props.requestParam.page) ? props.requestParam.page:null
    }, {
        preserveState: true,
        preserveScroll: true,
        onError: (error) => {
            notify({
                group: "error",
                title: "Error",
                text: error
            }, 4000)
        }
    })
}
const filterEntries = async () => {
    router.get(route('role.page.index'), {
        'search': searchText.value,
        'entries': searchEntries.value,
        'page': (props.requestParam && props.requestParam.page) ? props.requestParam.page:null
    }, {
        preserveState: true,
        preserveScroll: true,
        onError: (error) => {
            notify({
                group: "error",
                title: "Error",
                text: error
            }, 4000)
        }
    })
}

const selectedViewRole = ref(null);
const showRoleView = (role) => {
    selectedViewRole.value = role;
}

onMounted(() => {
    searchText.value = props.requestParam === null ? '':props.requestParam.search;
    searchEntries.value = props.requestParam === null ? 10:props.requestParam.entries
    filterText();
    filterEntries();
});
</script>

<template>
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 flex-0">
            <div class="lg:flex">
                <div>
                    <h3 class="mb-0 dark:text-white index-heading">Roles</h3>
                </div>
            </div>
            <div class="my-auto mt-6 pb-10">
                <Filters
                    @keyup-search-text="handleKeyUpText"
                    @search-entries="handleSearchEntries"
                    print-title="Print Role Table"
                    print-id="printRoleTable"
                    :btnCreate="route('role.page.create')"
                    :export-data="roles.data"
                    :search-query="requestParam === null ? '':requestParam.search"
                    :search-entries="requestParam === null ? 10:requestParam.entries"
                />
            </div>
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto pt-2 pb-6 px-0 pb-0 pl-2 pr-2">
                    <div class="overflow-x-auto table-responsive">
                        <table class="table" id="printRoleTable">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th width="1%">Status</th>
                                <th width="1%" class="hide-on-print">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="roles.data.length === 0">
                                <td colspan="5" class="text-center">No records found</td>
                            </tr>
                            <tr v-for="role in roles.data" :key="role.id">
                                <td class="leading-normal text-sm">{{ role.name }}</td>
                                <td class="leading-normal text-sm max-w-sm overflow-hidden tbl-overflow-hidden">{{ role.description }}</td>
                                <td class="leading-normal text-sm">
                                    {{ dayjs(role.created_at).format('DD/MM/YYYY HH:mm') }}
                                </td>
                                <td>
                                    <Status :status="changeStatus(role.status)" />
                                </td>
                                <td class="leading-normal text-sm hide-on-print">
                                    <button type="button" class="mx-2" @click="showRoleView(role)">
                                        <i class="fas fa-eye text-slate-400 dark:text-white/70"></i>
                                    </button>
                                    <button
                                        type="button"
                                        @click="deleteConfirmation(role)"
                                    >
                                        <i class="fas fa-trash text-slate-400 dark:text-white/70"></i>
                                    </button>
                                </td>

                                <RoleViewModal :show="selectedViewRole != null" @close="selectedViewRole = null">
                                    <template #title>
                                        View role & permissions ({{selectedViewRole.name}})
                                    </template>

                                    <template #content>
                                        <div class="w-full grid grid-cols-2 gap-4">
                                            <div>
                                                <p><b>Name</b> : {{selectedViewRole.name}}</p>
                                            </div>
                                            <div>
                                                <p><b>status</b> : <Status :status="changeStatus(selectedViewRole.status)" /></p>
                                            </div>
                                        </div>
                                        <div class="div-margin">
                                            <p><b>Description</b></p>
                                        </div>
                                        <p>{{selectedViewRole.description}}</p>
                                        <p class="div-margin"><b>Permissions</b></p>

                                        <table v-if="selectedViewRole.permissions.length > 0" border="1" class="grid grid-cols-5 gap-4 div-margin permission-list-view">
                                            <tr v-for="permission in selectedViewRole.permissions" :key="permission.id" >
                                                <td>{{ permission.name }}</td>
                                            </tr>
                                        </table>
                                        <p v-else>No permissions found</p>
                                    </template>
                                </RoleViewModal>
                            </tr>
                            </tbody>
                        </table>
                        <Pagination :data-object="roles" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.div-margin{
    margin-top: 10px;
}

.permission-list-view{
height: 150px;
overflow: hidden;
}

.permission-list-view:hover{
overflow-y: scroll;
}


</style>
