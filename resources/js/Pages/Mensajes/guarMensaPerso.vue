<script setup>
    import { ref, defineProps, defineEmits, onMounted } from "vue";
    import Label from "@/Components/InputLabel.vue";
    import Input from "@/Components/TextInput.vue";
    import Textarea from "@/Components/Textarea.vue";
    import InputError from '@/Components/InputError.vue';
    import BtnRed from "@/Components/BtnRed.vue";
    import BtnGreen from "@/Components/BtnGreen.vue";

    const props = defineProps({
        idPer: {
            type: String
        },
        formMensa: {
            type: Object,
            default: null
        }
    })

    const form = {
        id: null,
        estatus: false,
        fecha: "",
        mensaje: "",
        personal: props.idPer,
        errors: []
    }

</script>

<template>
    <div class="m-5"><h3>Guardar Mensaje</h3></div>

    <div class="flex flex-wrap justify-center items-center gap-5 my-5">
        <div class="w-[90%] w-[45%]">
            <Label>Fecha de Envio</Label>
            <Input type="datetime-local" v-model="form.fecha"></Input>
            <InputError class="mt-2" :message="form.errors.Nombre" />
        </div>
        
        <div class="w-[90%] w-[45%]">
            <Label>Envio Continuo</Label>
        </div>

        <div class="w-[90%]">
            <Label>Texto del Mensaje</Label>
            <Textarea v-model="form.mensaje"></Textarea>
            <InputError class="mt-2" :message="form.errors.Nombre" />
        </div>

        <div class="w-[100%] text-center flex justify-around">
            <BtnGreen @click="SavePerso(form)">Agregar</BtnGreen>
            <BtnRed @click="limpForm()" >Cerrar</BtnRed>
        </div>
    </div>
</template>