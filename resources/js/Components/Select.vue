<script setup>
import { onMounted, ref, watch } from 'vue';

// Define props and emits
const props = defineProps({
    modelValue: {
        type: [Number, String],
        default: ""
    },
    Options: {
        type: Array,
        default: []
    }
});

const emit = defineEmits(['update:modelValue']);

// Reference to the select element
const input = ref(null);

// Focus the input if it has the autofocus attribute
onMounted(() => {
    if (input.value && input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

// Expose the focus method to parent components
defineExpose({ focus: () => input.value.focus() });

// Watch for changes in modelValue to update the select element
watch(() => props.modelValue, (newValue) => {
    if (input.value && input.value.value !== newValue) {
        input.value.value = newValue;
    }
});
</script>

<template>
    <select 
        ref="input"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
    >
        <option v-for="opc in Options" :key="opc.id" :value="opc.id">{{ opc.text }}</option>
    </select>
</template>