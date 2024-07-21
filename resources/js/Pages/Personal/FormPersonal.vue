<script setup>
    import { ref, defineProps, defineEmits, onMounted } from "vue";
    import Label from "@/Components/InputLabel.vue";
    import Input from "@/Components/TextInput.vue";
    import InputError from '@/Components/InputError.vue';
    import BtnRed from "@/Components/BtnRed.vue";
    import BtnPrm from "@/Components/PrimaryButton.vue";
    import axios from 'axios';
  
    import useGlobales from "@/mixins/useGlobal";
    const { alertSuccess } = useGlobales();

    const props = defineProps({
        formProp: {
            type: Object,
            default: null
        }
    })

    const emits = defineEmits(["actuali"])

    /*********************** Carga de personal ********************/
    // variables
    const form = ref({
        id: null,
        Nombre: "",
        ApPat: "",
        ApMat: "",
        ClaPais: "+52",
        Telefono: "",
        errors: []
    })

    // Consultas
    const SavePerso = (datos) => {
        form.value.errors = [];

        axios.post("Personal/SavePerso", datos)
        .then(resp => {
            limpForm(),
            alertSuccess()
        })
        .catch(err => {
            form.value.errors = err.response.data.errors
        })
    }

    // Funciones
    const limpForm = () => {
        form.value.id = null;
        form.value.Nombre = "";
        form.value.ApPat = "";
        form.value.ApMat = "";
        form.value.ClaPais = "+52";
        form.value.Telefono = "";
        form.value.errors = [];
        emits("actuali")
    }

    onMounted(() => {
        if (props.formProp) {
            form.value.id = props.formProp.id;
            form.value.Nombre = props.formProp.nombre;
            form.value.ApPat = props.formProp.ApPat;
            form.value.ApMat = props.formProp.ApMat;
            form.value.ClaPais = props.formProp.clavePais;
            form.value.Telefono = props.formProp.Telefono;
        }
    })
</script>

<template>
    <div class="m-5"><h3>Carga de Personal</h3></div>
    
    <div class="flex flex-wrap justify-center items-center gap-5 my-5">
        <div class="w-[90%] md:w-[43%]">
            <Label for="tele" value="Nombre" />
            <Input type="tel" id="tele" v-model="form.Nombre" :disabled="formProp"/>
            <InputError class="mt-2" :message="form.errors.Nombre" />
        </div>
        <div class="w-[90%] md:w-[43%]">
            <Label for="tele" value="Apellido Paterno" />
            <Input type="tel" id="tele" v-model="form.ApPat" :disabled="formProp"/>
            <InputError class="mt-2" :message="form.errors.ApPat" />
        </div>
        <div class="w-[90%] md:w-[43%]">
            <Label for="tele" value="Apellido Materno" />
            <Input type="tel" id="tele" v-model="form.ApMat" :disabled="formProp"/>
            <InputError class="mt-2" :message="form.errors.ApMat" />
        </div>
        <div class="w-[90%] md:w-[43%]">
            <Label for="cla" value="Clave de país" />
            <Input type="text" id="cla" v-model="form.ClaPais" />
            <InputError class="mt-2" :message="form.errors.ClaPais" />
        </div>
        <div class="w-[90%] md:w-[43%]">
            <Label for="tele" value="Telefonó" />
            <Input type="tel" id="tele" v-model="form.Telefono" />
            <InputError class="mt-2" :message="form.errors.Telefono" />
        </div>

        <div class="w-[100%] text-center flex justify-around">
            <BtnPrm @click="SavePerso(form)">Agregar</BtnPrm>
            <BtnRed @click="limpForm()" >Cerrar</BtnRed>
        </div>
    </div>
</template>