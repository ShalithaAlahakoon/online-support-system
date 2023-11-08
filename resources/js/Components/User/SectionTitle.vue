<template>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">
                <slot name="title" />
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                <slot name="information" />
            </p>
        </div>

        <div class="px-4 sm:px-0">
            <slot name="leftcontent" />
        </div>
    </div>
</template>
