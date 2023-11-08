<script setup>
import {inject, onMounted, ref, watch} from 'vue'
import dayjs from "dayjs";
import Filters from "@/Components/Filters.vue";
import {Link, router, useForm, usePage} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import {notify} from "notiwind"
import Status from "@/Components/Status.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "../Modal.vue";
import FormSectionCustom from "@/Components/FormSectionCustom.vue";
import AdminChangePasswordModal from "./AdminChangePasswordModal.vue";

const swal = inject('$swal');
const hasPagination = ref(true);

const props = defineProps({
    users: {
        type: Object,
        default: null,
    },
    allUsers: {
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

const deleteUser = (user) => {
    router.delete(route('user.page.destroy', {'id': user.id}), {
        onSuccess: () => {
            router.visit(route('user.page.index'), {
                onSuccess: () => {
                    notify({
                        group: "success",
                        title: "Success",
                        text: "User successfully deleted!"
                    }, 4000)
                }
            })
        }
    });
};

const deleteConfirmation = (user) => {
    swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancel",
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "inline-block mr-3  px-6 py-3 m-0 ml-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-primary shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85",
            cancelButton: "inline-block px-6 py-3 m-0 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 text-slate-800",
        },
        buttonsStyling: false,
    }).then((result) => {
        if (result.isConfirmed) {
            deleteUser(user);
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal.dismiss;
        }
    });
}

const changeStatus = (statusCode) => {
    switch (statusCode) {
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
    router.get(route('user.page.index'), {
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
    router.get(route('user.page.index'), {
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

const profilePicturePath = (
    socialitePicture,
    profilePicturePath,
    profilePictureURL
) => {
    let picturePath;
    if (socialitePicture !== null) {
        picturePath = socialitePicture;
    } else if (profilePicturePath !== null) {
        picturePath = usePage().props.baseURL + '/storage/' + profilePicturePath;
    } else {
        picturePath = profilePictureURL;
    }
    return picturePath;
}

const showModal = ref(false)
const selectedChangePasswordUser = ref(null);
const changeUserPassword = (user) => {
    selectedChangePasswordUser.value = user;
    showModal.value = true;
}

onMounted(() => {
    searchText.value = props.requestParam === null ? '' : props.requestParam.search;
    searchEntries.value = props.requestParam === null ? 10 : props.requestParam.entries
    filterText();
    filterEntries();
});
</script>

<template>
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 flex-0">
            <div class="lg:flex">
                <div>
                    <h1 class="mb-0 dark:text-white index-heading">Users</h1>
                </div>
            </div>
            <div class="my-auto mt-6 pb-10">
                <Filters
                    @keyup-search-text="handleKeyUpText"
                    @search-entries="handleSearchEntries"
                    print-title="Print User Table"
                    print-id="printUserTable"
                    :btnCreate="route('user.page.create')"
                    :export-data="users.data"
                    :search-query="requestParam === null ? '':requestParam.search"
                    :search-entries="requestParam === null ? 10:requestParam.entries"
                />
            </div>
            <Modal :show="showModal" @close="showModal = false" max-width="sm">
                <AdminChangePasswordModal :selected-user="selectedChangePasswordUser" @close-modal="showModal = false"/>
            </Modal>
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto pt-2 pb-6 px-0 pb-0 pl-2 pr-2">
                    <div class="overflow-x-auto table-responsive">
                        <table class="table" id="printUserTable">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Contact</th>
                                <th>Created At</th>
                                <th width="1%">Status</th>
                                <th width="1%" class="hide-on-print">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="users.data.length === 0">
                                <td colspan="5" class="text-center">No records found</td>
                            </tr>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>
                                    <div class="flex">
                                        <img
                                            :src="$page.props.assetURL ? user.profile_photo_url:profilePicturePath(user.socialite_picture, user.profile_photo_path, user.profile_photo_url)"
                                            :alt="user.name"
                                            class="rounded-full h-10 w-10 object-cover">
                                        <h6 class="my-auto ml-4 dark:text-white">{{ user.name }}</h6>
                                    </div>
                                </td>
                                <td class="leading-normal text-sm">{{ user.role ? user.role.name : null }}</td>
                                <td class="leading-normal text-sm">{{ user.email }}</td>
                                <td class="leading-normal text-sm">{{ user.country ? user.country.name : null }}</td>
                                <td class="leading-normal text-sm">{{ user.phone_number }}</td>
                                <td class="leading-normal text-sm">{{
                                        dayjs(user.created_at).format('DD/MM/YYYY HH:mm')
                                    }}
                                </td>
                                <td>
                                    <Status :status="changeStatus(user.status)"/>
                                </td>
                                <td class="leading-normal text-sm hide-on-print">
                                    <div class="flex items-center space-x-2">
                                        <Link :href="route('user.page.show', {'id': user.id})">
                                            <i class="fas fa-eye text-slate-400 dark:text-white/70"></i>
                                        </Link>
                                        <Link v-if="user.id !== $page.props.auth.user.id"
                                              :href="route('user.page.edit', {'id': user.id})" class="mx-2">
                                            <i class="fas fa-user-edit text-slate-400 dark:text-white/70"></i>
                                        </Link>
                                        <Link v-if="user.id !== $page.props.auth.user.id" href="#" class="w-full">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 3C3.89543 3 3 3.89543 3 5V7C3 8.10457 3.89543 9 5 9H7C8.10457 9 9 8.10457 9 7V5C9 3.89543 8.10457 3 7 3H5Z"
                                                    fill="#8392ab"/>
                                                <path
                                                    d="M5 11C3.89543 11 3 11.8954 3 13V15C3 16.1046 3.89543 17 5 17H7C8.10457 17 9 16.1046 9 15V13C9 11.8954 8.10457 11 7 11H5Z"
                                                    fill="#8392ab"/>
                                                <path
                                                    d="M11 5C11 3.89543 11.8954 3 13 3H15C16.1046 3 17 3.89543 17 5V7C17 8.10457 16.1046 9 15 9H13C11.8954 9 11 8.10457 11 7V5Z"
                                                    fill="#8392ab"/>
                                                <path
                                                    d="M14 11C14.5523 11 15 11.4477 15 12V13H16C16.5523 13 17 13.4477 17 14C17 14.5523 16.5523 15 16 15H15V16C15 16.5523 14.5523 17 14 17C13.4477 17 13 16.5523 13 16V15H12C11.4477 15 11 14.5523 11 14C11 13.4477 11.4477 13 12 13H13V12C13 11.4477 13.4477 11 14 11Z"
                                                    fill="#8392ab"/>
                                            </svg>
                                        </Link>
                                        <Link v-if="user.id !== $page.props.auth.user.id" :href="route('user.page.log', {'id': user.id})" class="w-full">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9 2C8.44772 2 8 2.44772 8 3C8 3.55228 8.44772 4 9 4H11C11.5523 4 12 3.55228 12 3C12 2.44772 11.5523 2 11 2H9Z"
                                                    fill="#8392ab"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M4 5C4 3.89543 4.89543 3 6 3C6 4.65685 7.34315 6 9 6H11C12.6569 6 14 4.65685 14 3C15.1046 3 16 3.89543 16 5V16C16 17.1046 15.1046 18 14 18H6C4.89543 18 4 17.1046 4 16V5ZM7 9C6.44772 9 6 9.44772 6 10C6 10.5523 6.44772 11 7 11H7.01C7.56228 11 8.01 10.5523 8.01 10C8.01 9.44772 7.56228 9 7.01 9H7ZM10 9C9.44772 9 9 9.44772 9 10C9 10.5523 9.44772 11 10 11H13C13.5523 11 14 10.5523 14 10C14 9.44772 13.5523 9 13 9H10ZM7 13C6.44772 13 6 13.4477 6 14C6 14.5523 6.44772 15 7 15H7.01C7.56228 15 8.01 14.5523 8.01 14C8.01 13.4477 7.56228 13 7.01 13H7ZM10 13C9.44772 13 9 13.4477 9 14C9 14.5523 9.44772 15 10 15H13C13.5523 15 14 14.5523 14 14C14 13.4477 13.5523 13 13 13H10Z"
                                                      fill="#8392ab"/>
                                            </svg>
                                        </Link>
                                        <button v-if="user.id !== $page.props.auth.user.id" @click="changeUserPassword(user)" class="w-full">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M18 8C18 11.3137 15.3137 14 12 14C11.3938 14 10.8087 13.9101 10.2571 13.7429L8 16H6V18H2V14L6.25707 9.74293C6.08989 9.19135 6 8.60617 6 8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8ZM12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C13.1046 6 14 6.89543 14 8C14 8.55228 14.4477 9 15 9C15.5523 9 16 8.55228 16 8C16 5.79086 14.2091 4 12 4Z"
                                                      fill="#8392ab"/>
                                            </svg>
                                        </button>
                                        <Link v-if="user.id !== $page.props.auth.user.id" :href="route('user.page.login-as-user', {'id': user.id})" class="w-full">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.3949 2.01788C9.78678 1.36132 8.93741 0.999756 7.99991 0.999756C7.05741 0.999756 6.20522 1.35913 5.59991 2.01163C4.98803 2.67132 4.68991 3.56788 4.75991 4.53601C4.89866 6.446 6.3521 7.99975 7.99991 7.99975C9.64772 7.99975 11.0987 6.44632 11.2396 4.53663C11.3105 3.57725 11.0105 2.68257 10.3949 2.01788Z"
                                                    fill="#8392ab"/>
                                                <path
                                                    d="M13.4999 14.9991H2.49993C2.35595 15.0009 2.21337 14.9707 2.08255 14.9105C1.95173 14.8503 1.83597 14.7618 1.74368 14.6512C1.54056 14.4084 1.45868 14.0769 1.51931 13.7416C1.78306 12.2784 2.60618 11.0494 3.89993 10.1866C5.04931 9.42062 6.50524 8.99905 7.99993 8.99905C9.49462 8.99905 10.9506 9.42093 12.0999 10.1866C13.3937 11.0491 14.2168 12.2781 14.4806 13.7412C14.5412 14.0766 14.4593 14.4081 14.2562 14.6509C14.1639 14.7615 14.0482 14.8501 13.9174 14.9104C13.7865 14.9706 13.6439 15.0009 13.4999 14.9991Z"
                                                    fill="#8392ab"/>
                                            </svg>

                                        </Link>
                                        <button v-if="user.id !== $page.props.auth.user.id" type="button"
                                                @click="deleteConfirmation(user)">
                                            <i class="fas fa-trash text-slate-400 dark:text-white/70"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <Pagination v-if="hasPagination" :data-object="users" />
            </div>
        </div>
    </div>
</template>
<style scoped>
.div-margin{
    margin-top: 10px;
}
</style>
