<script setup>
import { ref } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import Label from "@/Components/InputLabel.vue";
import Input from "@/Components/TextInput.vue";
import Textarea from "@/Components/Textarea.vue";
import PrimaButton from "@/Components/PrimaryButton.vue";

const form = ref({
    claPais: "+52",
    telefono: "",
    mensaje: ""
})

const SendMesa = (datos) => {
    axios.post("../SendMesa", datos)
    .then(ele => {
        console.log(ele.data);
    })
}
</script>

<template>
    <AppLayout title="Inicio">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inicio
            </h2>
        </template>

        <section class="flex flex-wrap justify-around m-5">
            <div class="w-[90vw] md:w-[33vw]">
                <Label for="cla" value="Clave de país" />
                <Input type="text" id="cla" v-model="form.claPais" />
            </div>
            <div class="w-[90vw] md:w-[33vw]">
                <Label for="tele" value="Telefonó" />
                <Input type="tel" id="tele" v-model="form.telefono" />
            </div>
            <div>
                <prima-button @click="SendMesa(form)">Mandar</prima-button>
            </div class="w-[90vw] md:w-[33vw]">
            <div class="w-[90vw]">
                <Label for="mensaje" value="Mensaje" />
                <Textarea id="mensaje" cols="30" rows="10" v-model="form.mensaje" />
            </div>
        </section>
    </AppLayout>
</template>
