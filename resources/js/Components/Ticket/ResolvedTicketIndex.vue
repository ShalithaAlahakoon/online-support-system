<script setup>
import {onMounted, ref, watch,inject} from "vue";
import Filters from "@/Components/Filters.vue";
import dayjs from "dayjs";
import { useForm,router } from '@inertiajs/vue3';
import { notify } from "notiwind";
import Pagination from "@/Components/Pagination.vue";


const props = defineProps({
    resolvedTickets: {
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
    },
});

const hasPagination = ref(true);

const restoreForm = useForm({
    _method: 'patch',
});

const restoreTicket = async (resolvedTicket) => {
    try {
        restoreForm.patch(route('ticket.page.restore', resolvedTicket.id), {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                router.visit(route('ticket.page.resolvedTicketIndex', { 'entries': 10, 'page': 1 }), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        notify(
                            {
                                group: 'success',
                                title: 'Success',
                                text: 'Ticket successfully restored!',
                            },
                            4000
                        );
                    },
                });
            },
            onError: () => {
                notify(
                    {
                        group: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    },
                    4000
                );
            },
        });

    } catch (error) {
        if (error.response.status === 422) {
            notify(
                {
                    group: 'error',
                    title: 'Error',
                    text: 'Something went wrong!',
                },
                4000
            );
        }
    }
};

const truncateWords = (content, wordCount) => {
const words = content.split(' ');
const truncatedWords = words.slice(0, wordCount);
const truncatedContent = truncatedWords.join(' ');
return truncatedContent + (words.length > wordCount ? '...' : '');
}

const swal = inject('$swal');

const restoreConfirmation = (resolvedTicket) => {
    swal({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Yes, resopen it!',
        customClass: {
            confirmButton: "inline-block mr-3  px-6 py-3 m-0 ml-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-primary shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85",
            cancelButton: "inline-block px-6 py-3 m-0 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 text-slate-800",
        },
        buttonsStyling: false,
    }).then((result) => {
        if (result.isConfirmed) {
            restoreTicket(resolvedTicket);
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal.dismiss;
        }
    });
};

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
    router.get(route('ticket.page.resolvedTicketIndex'), {
        'search': searchText.value,
        'entries': searchEntries.value,
        'page': (props.requestParam && props.requestParam.page) ? props.requestParam.page:null
    }, {
        preserveState: true,
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
    router.get(route('ticket.page.resolvedTicketIndex'), {
        'search': searchText.value,
        'entries': searchEntries.value,
        'page': (props.requestParam && props.requestParam.page) ? props.requestParam.page:null
    }, {
        preserveState: true,
        onError: (error) => {
            notify({
                group: "error",
                title: "Error",
                text: error
            }, 4000)
        }
    })
}

onMounted(() => {
    searchText.value = props.requestParam === null ? '':props.requestParam.search;
    searchEntries.value = props.requestParam === null ? 10:props.requestParam.entries;
});

</script>

<template>
  <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 flex-0">
            <div class="lg:flex">
                <div>
                    <h3 class="mb-5 dark:text-white index-heading">Resolved Support Tickets</h3>
                </div>
            </div>
            <div class="my-auto mt-6 pb-10">
                <Filters
                    @keyup-search-text="handleKeyUpText"
                    @search-entries="handleSearchEntries"
                    :has-modal="false"
                    :hasCreate="false"
                    print-title="Print Resolved ticket Table"
                    print-id="printresolvedTicketTable"
                    :export-data="resolvedTickets.data"
                    :search-query="requestParam === null ? '':requestParam.search"
                    :search-entries="requestParam === null ? 10:requestParam.entries"
                />
            </div>
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-6 pb-0">
                    <div class="overflow-x-auto table-responsive">
                        <table class="table w-full" id="printresolvedTicketTable">
                            <thead class="thead-light">
                            <tr>
                                <th>Reference Number</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Description</th>
                                <th width="1%" class="hide-on-print">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="resolvedTickets.data.length === 0">
                                <td colspan="5" class="text-center">No records found</td>
                            </tr>
                            <tr v-for="resolvedTicket in resolvedTickets.data" :key="resolvedTicket.id">
                                <td class="leading-normal text-sm">{{ resolvedTicket.reference_number }}</td>
                                <td class="leading-normal text-sm">{{ resolvedTicket.customer_name }}</td>
                                <td class="leading-normal text-sm">{{ resolvedTicket.email }}</td>
                                <td class="leading-normal text-sm">{{ resolvedTicket.phone_number }}</td>
                                <td class="leading-normal text-sm truncate">{{truncateWords (resolvedTicket.problem_description,15) }}</td>
                                <td>
                                    <button type="button" class="mx-4" @click="restoreConfirmation(resolvedTicket)">
                                        <i class="hide-on-print fa-solid fa-arrow-rotate-left text-slate-400 dark:text-white/70"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <Pagination :data-object="resolvedTickets" v-if="hasPagination"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

