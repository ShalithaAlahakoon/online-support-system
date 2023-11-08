<script setup>
import {Link, router, useForm} from '@inertiajs/vue3';
import {onMounted, onUnmounted, ref, watchEffect} from "vue";
import exportFromJSON from "export-from-json";
import JsPDF from 'jspdf';
import {applyPlugin} from 'jspdf-autotable'
import 'jspdf-autotable';
import {notify} from "notiwind";
import Modal from "./Modal.vue";

applyPlugin(JsPDF)

const emit = defineEmits(['keyup-search-text', 'search-entries', 'showModal','importResponse']);

const props = defineProps({
    hasCreate: {
        type: Boolean,
        default:true
    },
    btnCreate: {
        type: String
    },
    itemClass: {
        type: String,
    },
    hasDeleteSelected: {
        type: Boolean,
        default: false
    },
    printTitle: {
        type: String,
        default: 'Global Edu Link'
    },
    printId: {
        type: String,
        default: 'printMe'
    },
    hasModal: {
        type: Boolean,
        default: false
    },
    searchQuery: {
        type: String,
        default: ''
    },
    searchEntries: {
        default: 10
    },
    exportData: {
        type: Object,
        default: null,
    },
    importRoute: {
        type: String,
        default: null,
    },
    filterData: {
        type: Function,
        default: null,
    },
})
const searchQuery = ref('');
const searchEntry = ref(null);

const handleKeyUp = () => {
    // Emit the keyup text to the parent component
    emit('keyup-search-text', searchQuery.value);
};
const handleSearchEntries = () => {
    // Emit the keyup text to the parent component
    emit('search-entries', searchEntry.value);
};

const showModal = () => {
    emit('showModal');
};

//export button dropdown
const isDropdownOpen = ref(false);

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

const closeDropdown = () => {
    isDropdownOpen.value = false;
};

const exportDataWithType = (data, newFileName, fileExportType) => {
    if (!data) return;
    try {
        const fileName = newFileName || "exported-data";
        const exportType = exportFromJSON.types[fileExportType || "xls"];
        exportFromJSON({data, fileName, exportType});
    } catch (e) {
        throw new Error("Parsing failed!");
    }
}

const exportPDF = (data, newFileName) => {
    // const options = {
    //     filename:  newFileName || "exported-data"
    // };
    //
    // const doc = new JsPDF();
    //
    // const tableHeaders = Object.keys(data[0]);
    // const tableData = data.map(item => Object.values(item));
    //
    // doc.text('Exported Data', 14, 16);
    //
    // doc.autoTable({
    //     head: [tableHeaders],
    //     body: tableData,
    //     startY: 20
    // });
    //
    // doc.save(options.filename.pdf);

    try {
        const fileName = newFileName || 'exported-data';
        const doc = new JsPDF();

        // Get the table element
        const tableElement = document.getElementById(props.printId);

        // Get the table columns
        const columns = Array.from(tableElement.querySelectorAll('thead th')).map((column) => column.innerText);

        // Get the table rows
        const rows = Array.from(tableElement.querySelectorAll('tbody tr')).map((row) =>
            Array.from(row.querySelectorAll('td')).map((cell) => cell.innerText)
        );

        // Remove the last column
        columns.pop();
        rows.forEach((row) => row.pop());

        // Generate the table in the PDF document
        doc.autoTable({
            head: [columns], // Use the modified columns array
            body: rows // Use the modified rows array
        });

        // Save the PDF file
        doc.save(fileName + '.pdf');
    } catch (e) {
        throw new Error('Parsing failed!');
    }
}

const printObj = ref({
    id: props.printId,
    popTitle: props.printTitle,
})

// Set the default value of searchEntry to the value of the first option
onMounted(() => {
    searchEntry.value = props.searchEntries;
    searchQuery.value = props.searchQuery;
});


const form = useForm({

    _method: "POST",

    file: null,

});

const fileInput = ref(null);

const selectFile = () => {
    fileInput.value.click();
};

const importFile = () => {

    form.file = fileInput.value.files[0];

    try {
        form.post(route(props.importRoute), {
            preserveState: true,
            errorBag: 'importFile',
            onSuccess: (res) => {
                isImportPopupOpen.value = false;
                emit('importResponse', res);
                form.reset();
            },
            onError: (res) => {
                emit('importResponse', res);
                form.reset();
            }
        });
    } catch (e) {
        console.log(e);
    }
};

//export button dropdown
const isImportPopupOpen = ref(false);

const toggleImportPopup = () => {
    isImportPopupOpen.value = !isImportPopupOpen.value;
};


const dropdown = ref(null);

const clickOutsideEvent = (event) => {
    if (!(dropdown.value === event.target || dropdown.value.contains(event.target))) {
        closeDropdown();
    }
};

watchEffect(() => {
    if (isDropdownOpen.value) {
        document.body.addEventListener('click', clickOutsideEvent);
    } else {
        document.body.removeEventListener('click', clickOutsideEvent);
    }
});

// Cleanup the event listener when the component is unmounted
onUnmounted(() => {
    document.body.removeEventListener('click', clickOutsideEvent);
});

</script>

<template>

    <Modal :show="isImportPopupOpen" @close="toggleImportPopup" :modalClose="toggleImportPopup">
        <input
            ref="fileInput"
            type="file"
            class="hidden"
            @change="importFile"
        />
        <div class="flex flex-row items-center justify-center" style="min-height: 250px">
            <button
                class="w-48 text-center text-sm font-semibold text-base transition ease-in-out duration-150 text-white bg-primary border border-primary rounded-lg px-7 py-2 cursor-pointer mr-2"
                @click.prevent="importFile"
            >
                Download Template
            </button>
            <button
                class="w-48 text-center text-sm font-semibold text-base transition ease-in-out duration-150 text-white bg-primary border border-primary rounded-lg px-7 py-2 cursor-pointer mr-2"
                @click.prevent="selectFile"
            >
                Import
            </button>
        </div>
    </Modal>
    <div class="flex justify-between py-6">
        <!-- Search bar -->
        <div class="flex items-center">
            <input v-model="searchQuery"
                class="w-96 focus:outline-none text-sm font-semibold text-base text-primary bg-white border border-primary rounded-lg px-4 py-2 leading-pro pr-10"
                type="text" placeholder="Type here....." @keyup="handleKeyUp" />
        </div>
        <div class="flex items-center" v-if="hasCreate">
            <!-- Create button -->
            <Link :href="btnCreate" :class="itemClass" v-if="!hasModal">
            <button
                class="w-48 text-center text-sm font-semibold text-base transition ease-in-out duration-150 text-white bg-primary border border-primary rounded-lg px-7 py-2 cursor-pointer mr-4 leading-pro hover:scale-105">
                <i class="fa fa-plus mr-2"></i>
                Create
            </button>
            </Link>
            <!-- Create button -->
            <button v-if="hasModal" @click="showModal"
                class="w-48 text-center text-sm font-semibold text-base transition ease-in-out duration-150 text-white bg-primary border border-primary rounded-lg px-7 py-2 cursor-pointer mr-4 leading-pro hover:scale-105">
                <i class="fa fa-plus mr-2"></i>
                Create
            </button>
        </div>
    </div>
    <div class="flex justify-between">
        <!-- Number field -->
        <div class="flex items-center">
            <label class="mr-2 text-sm text-black font-semibold">Show</label>
            <select
                class="w-6/12 text-sm focus:outline-none font-semibold text-base font-light text-primary bg-white border border-primary rounded-lg px-4 py-2 leading-pro"
                v-model="searchEntry"
                @change="handleSearchEntries"
            >
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <label class="ml-2 text-sm text-black font-semibold">entries</label>
        </div>
        <div class="flex items-center">

            <!-- Print button -->
            <button
                class="text-center font-light text-sm text-base  font-semibold text-primary bg-transparent border border-primary rounded-lg px-7 py-2 cursor-pointer mr-4 leading-pro hover:bg-purple-100"
                v-print=" printObj ">
                <i class="fas fa-print mr-2"></i>
                Print
            </button>

            <!-- Delete button -->
            <button v-if=" hasDeleteSelected "
                class="w-48 text-center font-light text-sm font-semibold text-base text-red-500 bg-transparent border border-red-500 rounded-lg px-7 py-2 cursor-pointer mr-4 leading-pro hover:bg-red-500 hover:border-none hover:text-white"
                @click=" deleteItem ">
                <i class="far fa-trash-alt mr-2"></i>
                Delete Selected
            </button>
        </div>
    </div>
</template>
