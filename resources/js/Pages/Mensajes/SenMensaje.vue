<script setup>
    import { ref, defineProps, defineEmits, onMounted } from "vue";
    import Label from "@/Components/InputLabel.vue";
    import Input from "@/Components/TextInput.vue";
    import Textarea from "@/Components/Textarea.vue";
    import InputError from '@/Components/InputError.vue';
    import PrimaButton from "@/Components/PrimaryButton.vue";

    const props = defineProps({
        formMensa: {
            type: Object,
            default: null
        }
    })

    const emits = defineEmits(["actuali"])

    const form = ref({
        claPais: "+52",
        telefono: "",
        mensaje: "",
        errors: []
    })

    const SendMesa = (datos) => {
        axios.post("../SendMesa", datos)
        .then(ele => {
            emits("actuali")
        })
        .catch(err => {
            form.value.errors = err.response.data.errors
        })
    }

    onMounted(() => {
        if (props.formMensa) {
            form.value.claPais = props.formMensa.clavePais;
            form.value.telefono = props.formMensa.Telefono;
        }
    })
</script>

<template>
    <section class="flex flex-wrap justify-around m-5">
        <div class="w-[90%] md:w-[33%]">
            <Label for="cla" value="Clave de país" />
            <Input type="text" id="cla" v-model="form.claPais" :disabled="formMensa" />
            <InputError class="mt-2" :message="form.errors.claPais" />
        </div>
        <div class="w-[90%] md:w-[33%]">
            <Label for="tele" value="Telefonó" />
            <Input type="tel" id="tele" v-model="form.telefono" :disabled="formMensa" />
            <InputError class="mt-2" :message="form.errors.telefono" />
        </div>
        <div class="w-[90%] md:w-[33%] text-center">
            <prima-button @click="SendMesa(form)">Mandar</prima-button>
        </div>
        <div class="w-[90vw]">
            <Label for="mensaje" value="Mensaje" />
            <Textarea id="mensaje" cols="30" rows="10" v-model="form.mensaje" />
            <InputError class="mt-2" :message="form.errors.mensaje" />
        </div>
    </section>
</template>