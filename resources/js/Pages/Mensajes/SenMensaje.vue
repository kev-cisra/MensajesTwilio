<script setup>
import { ref } from "vue";
import Label from "@/Components/InputLabel.vue";
import Input from "@/Components/TextInput.vue";
import Textarea from "@/Components/Textarea.vue";
import InputError from '@/Components/InputError.vue';
import PrimaButton from "@/Components/PrimaryButton.vue";

const form = ref({
    claPais: "+52",
    telefono: "",
    mensaje: "",
    errors: []
})

const SendMesa = (datos) => {
    axios.post("../SendMesa", datos)
    .then(ele => {
        console.log(ele.data);
    })
}
</script>

<template>
    <section class="flex flex-wrap justify-around m-5">
        <div class="w-[90vw] md:w-[33vw]">
            <Label for="cla" value="Clave de país" />
            <Input type="text" id="cla" v-model="form.claPais" />
            <InputError class="mt-2" :message="form.errors.claPais" />
        </div>
        <div class="w-[90vw] md:w-[33vw]">
            <Label for="tele" value="Telefonó" />
            <Input type="tel" id="tele" v-model="form.telefono" />
            <InputError class="mt-2" :message="form.errors.telefono" />
        </div>
        <div class="w-[90vw] md:w-[33vw]">
            <prima-button @click="SendMesa(form)">Mandar</prima-button>
        </div>
        <div class="w-[90vw]">
            <Label for="mensaje" value="Mensaje" />
            <Textarea id="mensaje" cols="30" rows="10" v-model="form.mensaje" />
            <InputError class="mt-2" :message="form.errors.mensaje" />
        </div>
    </section>
</template>