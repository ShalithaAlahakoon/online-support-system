<script setup>
import Filters from "@/Components/Filters.vue";
import {onMounted, ref, watch,inject} from "vue";
import { router, useForm } from "@inertiajs/vue3";
import TicketReplyModal from "./TicketReplyModal.vue";
import Modal from "../Modal.vue";
import TicketViewModal from "./TicketViewModal.vue";
import Pagination from "@/Components/Pagination.vue";
import { notify } from "notiwind"
import Status from "@/Components/Status.vue";


const props = defineProps({
    tickets: {
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
    maxWidth: {
        type: String,
        default: 'xl',
    },
    allTickets:{
        type:Object,
        default:null,
    },
});

const resolveForm = useForm({
    _method: 'DELETE',
});

const resolveTicket = (ticket) => {
try {
    resolveForm.delete(route('ticket.page.destroy', { id: ticket.id }), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            router.visit(route('ticket', {'entries':10, 'page':1}), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    notify(
                        {
                            group: 'success',
                            title: 'Success',
                            text: 'Ticket successfully resolved!',
                        },
                        4000
                    );
                },
            });
        },
        onError: (error) => {
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

const swal = inject('$swal');
const hasPagination = ref(true);

const Resolved = (ticket) => {
    swal({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancel",
        confirmButtonText: "Yes, resolve it!",
        customClass: {
        confirmButton: "inline-block px-5 py-3 m-0 mr-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-primary shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85",
        cancelButton: "inline-block px-8 py-3 m-0 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 text-slate-800",
        },
        buttonsStyling: false,
    }).then((result) => {
        if (result.isConfirmed) {
            resolveTicket(ticket);
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal.dismiss;
        }
    });
}

const selectedTicket = ref(null);
const showTicketView = (ticket) => {
    selectedTicket.value = ticket;
};

const showModal = ref(false);

const selectedReplyTicket = ref(null);
const showReplyModal = (ticket) => {
    selectedReplyTicket.value = ticket;
    showModal.value = true;
};

const hideReplyModal = () => {
    showModal.value = false;
};


const status = (statusCode) => {
    switch (statusCode){
        default:
            return "Pending"
    }
}

const truncateWords = (content, wordCount) => {
const words = content.split(' ');
const truncatedWords = words.slice(0, wordCount);
const truncatedContent = truncatedWords.join(' ');
return truncatedContent + (words.length > wordCount ? '...' : '');
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
    router.get(route('ticket'), {
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
    router.get(route('ticket'), {
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
    searchEntries.value = props.requestParam === null ? 10:props.requestParam.entries
    filterText();
    filterEntries();
});

</script>

<template>
    <Modal
        :show="showModal"
        :max-width="maxWidth"
        @close="hideReplyModal"
        class="w-full"
    >
        <TicketReplyModal
            @close-modal="hideReplyModal"
            :ticket="selectedReplyTicket"
        />
    </Modal>
  <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 flex-0">
            <div class="lg:flex">
                <div>
                    <h3 class="mb-0 dark:text-white index-heading">Pending Support Tickets</h3>
                </div>
            </div>
            <div class="my-auto mt-6 pb-10">
                <Filters
                    @keyup-search-text="handleKeyUpText"
                    @search-entries="handleSearchEntries"
                    :hasCreate="false"
                    print-title="Print Ticket Table"
                    print-id="printTicketTable"
                    :export-data="false"
                    :search-query="requestParam === null ? '':requestParam.search"
                    :search-entries="requestParam === null ? 10:requestParam.entries"
                />
            </div>
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-6 pb-0">
                    <div class="overflow-x-auto table-responsive">
                        <table class="table w-full" id="printTicketTable">
                            <thead class="thead-light">
                            <tr>
                                <th>Reference Number</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th width="1%" class="hide-on-print">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="tickets.data.length === 0">
                                <td colspan="5" class="text-center">No records found</td>
                            </tr>
                            <tr v-for="ticket in tickets.data" :key="ticket.id">
                                <td class="leading-normal text-sm">{{ ticket.reference_number }}</td>
                                <td class="leading-normal text-sm">{{ ticket.customer_name }}</td>
                                <td class="leading-normal text-sm">{{ ticket.email }}</td>
                                <td class="leading-normal text-sm">{{ ticket.phone_number }}</td>
                                <td class="leading-normal text-sm truncate">{{truncateWords (ticket.problem_description,15) }}</td>
                                <td>
                                    <Status :status="status(ticket.status)" />
                                </td>
                                <td class="leading-normal text-sm hide-on-print">
                                    <button
                                            type="button"
                                            @click="showTicketView(ticket)"
                                        >
                                            <i class="fas fa-eye text-slate-400 dark:text-white/70"></i>
                                    </button>
                                    <button
                                            class="mx-2"
                                            type="button"
                                            @click="showReplyModal(ticket)"
                                        >
                                            <i class="fa-solid fa-reply"></i>
                                        </button>
                                    <button
                                        type="button"
                                        @click="Resolved(ticket)"
                                    >
                                        <i class="fa-solid fa-circle-check text-slate-400 dark:text-white/70"></i>
                                    </button>
                                    <TicketViewModal
                                        :show="selectedTicket != null"
                                        @close="selectedTicket = null"
                                    >
                                        <template #title> Ticket </template>
                                        <template #ticket-details>
                                            <div
                                                class="w-full grid grid-cols-2 gap-4 p-4 rounded-lg shadow-md"
                                            >
                                                <div>
                                                    <p>
                                                        <b>Reference Number</b> :{{selectedTicket.reference_number}}
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <b>Name</b> :{{selectedTicket.customer_name}}
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <b>Email</b> :{{selectedTicket.email}}
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <b>Phone Number</b> :{{selectedTicket.phone_number}}
                                                    </p>
                                                </div>
                                            </div>
                                        </template>
                                        <template #ticket-message>
                                            <div
                                                class="w-full p-4 rounded-lg shadow-md"
                                            >
                                                <div class="col-span-2">
                                                    <p><b>Problem Description</b></p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <b></b>{{selectedTicket.problem_description}}
                                                    </p>
                                                </div>
                                            </div>
                                        </template>
                                        <template #ticket-reply>
                                        <div class="w-full p-4 rounded-lg shadow-md">
                                            <div class="col-span-2">
                                                <p><b>Agent Reply Message</b></p>
                                            </div>
                                            <div v-if="selectedTicket.reply_ticket && selectedTicket.reply_ticket.length > 0">
                                                <div v-for="reply_ticket in selectedTicket.reply_ticket" :key="reply_ticket.id">
                                                    <p>
                                                        <b></b>{{ reply_ticket.message }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <p>No reply messages available.</p>
                                            </div>
                                        </div>
                                    </template>
                                    </TicketViewModal>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <Pagination :data-object="tickets" v-if="hasPagination"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@media print {
    .hide-on-print {
        display: none;
    }
}
</style>
