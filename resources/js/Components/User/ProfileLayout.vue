<script setup>
import SectionTitle from '@/Components/User/SectionTitle.vue';
</script>

<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #information>
                <slot name="information" />
            </template>
        </SectionTitle>

    </div>
</template>
