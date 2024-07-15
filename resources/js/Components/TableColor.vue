<script setup>
    import { defineProps } from "vue";

    const props = defineProps({
        color: {
            type: String,
            default: "bg-blue-600"
        },

        font: {
            type: String,
            default: "text-md"
        },

        tamaño: {
            type: String,
            default: "h-[30vh]"
        }
    })


</script>

<template>
    <table class="tw-w-[100%] tw-overflow-hidden tw-border-collapse tw-border-spacing-0">
        <thead :class="[color, font]">
            <tr class="uppercase tw-font-black tw-text-center tw-text-white ">
                <slot name="TableEncabezado">

                </slot>
            </tr>
            <tr class="uppercase tw-font-black tw-text-left tw-text-white ">
                <slot name="TableHeader">

                </slot>
            </tr>
        </thead>
        <tbody :class="[tamaño]" class="table-body">
            <slot name="TableBody">

            </slot>
        </tbody>
        <tfoot class="tableFoot uppercase tw-text-white"  :class="[color, font]">
            <slot name="TableFoother">

            </slot>
        </tfoot>
    </table>
</template>

<style>
    .table-body {
        display: block;
        overflow-y: auto;
    }

    .tableFoot {
        position: sticky;
        bottom: 0;
        z-index: 10;
    }

    thead, tfoot {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    thead, tfoot, tbody tr {
        border-bottom: 1px solid #a2d6f7;
    }
</style>