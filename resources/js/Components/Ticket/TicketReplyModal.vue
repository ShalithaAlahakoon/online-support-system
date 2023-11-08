<script setup>
import TextInput from "@/Components/TextInput.vue";
import Textarea from "@/Components/Textarea.vue";
import InputError from "@/Components/InputError.vue";
import { useForm, router } from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { notify } from "notiwind"

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    ticket: {
        type: Object,
        default: null,
    }
});

const form = useForm({
    _method: 'POST',
    ticket_reply_message: '',
    ticket_id: props.ticket.id,
});

const replyTicket = async () => {
    try {
        form.post(route('ticket.page.reply'), {
            preserveState: true,
            preserveScroll: true,
            errorBag: 'replyTicket',
            onSuccess: () => {
                router.visit(route('ticket', { 'entries': 10, 'page': 1 })),
                    form.reset();
                notify({
                    group: "success",
                    title: "Success",
                    text: "Ticket successfully created!"
                }, 4000);
            },
            onError: () => {
                notify({
                    group: "error",
                    title: "Error",
                    text: "Something went wrong!"
                }, 4000);
            },
        });
    } catch (e) {
        if (e.response.status === 422) {
            notify({
                group: "error",
                title: "Error",
                text: e.response.data.errors
            }, 4000);
        }
    }

}

const emit = defineEmits(["close-modal"]);

</script>

<template>
    <form @submit.prevent="replyTicket">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 common-scroll-bar" style="height: 45vh; overflow: scroll">
            <div class="">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <div class="flex justify-between">
                        <p class="text-gray-700 text-base font-bold mb-2">Ticket Reply</p>
                    </div>
                    <div class="w-full mt-3">
                        <div class="">
                            <InputLabel value="Reply*" />
                            <Textarea id="Reply" v-model="form.ticket_reply_message" type="text"
                                class="mt-1 block w-full h-50" autocomplete="reply" placeholder="Message" />
                            <InputError class="mt-2" :message="form.errors.ticket_reply_message" />
                        </div>
                    </div>

                    <div class="flex justify-center mt-6">
                        <PrimaryButton
                            btnClass="inline-block px-6 py-3 m-0 ml-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-primary shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85"
                            :class="{ 'opacity-25': processing }" :disabled="processing">
                            Send
                        </PrimaryButton>
                    </div>

                </div>
            </div>
        </div>
    </form>
</template>
