<script setup>
    const props = defineProps({
        modelValue: Boolean,
    });

    const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <div class="flex items-center">
        <input 
            type="checkbox" 
            id="switch" 
            class="switch-input hidden"
            :checked="modelValue"
            @change="$emit('update:modelValue', $event.target.checked)">
        <label for="switch" class="switch-label cursor-pointer block w-12 h-6 bg-gray-300 rounded-full relative"></label>
    </div>
</template>

<style>
    .switch-input:checked ~ .switch-label {
        background-color: #4CAF50;
    }
    .switch-input:checked ~ .switch-label::after {
        transform: translateX(1.5rem);
    }
    .switch-label {
        transition: background-color 0.3s ease;
    }
    .switch-label::after {
        content: '';
        position: absolute;
        width: 1.5rem;
        height: 1.5rem;
        background-color: #fff;
        border-radius: 9999px;
        transition: transform 0.3s ease;
    }
</style>