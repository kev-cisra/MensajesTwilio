<script setup>
    import { ref, defineProps, defineEmits, onMounted } from "vue";
    import Label from "@/Components/InputLabel.vue";
    import Input from "@/Components/TextInput.vue";
    import Textarea from "@/Components/Textarea.vue";
    import Select from "@/Components/Select.vue";
    import Switch from "@/Components/Switch.vue";
    import InputError from '@/Components/InputError.vue';
    import BtnRed from "@/Components/BtnRed.vue";
    import BtnGreen from "@/Components/BtnGreen.vue";
    import moment from 'moment';
  
    import useGlobales from "@/mixins/useGlobal";
    const { alertSuccess } = useGlobales();

    const props = defineProps({
        idPer: {
            type: [Number, String]
        },
        formMensa: {
            type: Object,
            default: null
        }
    })

    const emits = defineEmits(["actu", "limp"])

    const form = ref({
        id: null,
        estatus: false,
        fecha: moment().format("YYYY-MM-DD HH:mm"),
        mensaje: "",
        temporizador: 0,
        personal: props.idPer,
        errors: []
    })

    const opc = ref([
        { id: 0, text: "Sin Tiempo" },
        { id: 10, text: "10 minutos" },
        { id: 20, text: "20 minutos" },
        { id: 30, text: "30 minutos" },
        { id: 40, text: "40 minutos" },
        { id: 50, text: "50 minutos" },
        { id: 60, text: "60 Minutos" },
        { id: 1440, text: "1 dia" }
    ])

    // Consultas
    const saveMensa = (datos) => {
        axios.post("../Mensajes/SaveMensa", datos)
        .then(resp => {
            alertSuccess()
            limpForm(),
            console.log(resp.data);
        })
        .catch(err => {
            // console.log(err.response.data.errors);
            form.value.errors = err.response.data.errors
        })
    }

    // Funciones
    const limpForm = () => {
        form.value.id = null;
        form.value.estatus = false;
        form.value.fecha = moment().format("YYYY-MM-DD HH:mm");
        form.value.temporizador = 0;
        form.value.mensaje = "";
        form.value.errors = [];
        emits("actu")
    }

    onMounted(() => {
        
        console.log(form.value);
    })
</script>

<template>
    <div class="m-5"><h3>Guardar Mensaje</h3></div>

    <div class="flex flex-wrap justify-center items-center gap-5 my-5">
        <div class="w-[90%] lg:w-[45%]">
            <Label>Fecha de Envio</Label>
            <Input type="datetime-local" v-model="form.fecha"></Input>
            <InputError class="mt-2" :message="form.errors.fecha" />
        </div>
        
        <div class="w-[90%] lg:w-[45%] ">
            <Label>Envio Continuo</Label>
            <div class="flex items-center">
                <Switch v-model="form.estatus"></Switch>
                <Select v-model="form.temporizador" :Options="opc" :disabled="!form.estatus"></Select>
            </div>
            <InputError class="mt-2" :message="form.errors.temporizador" />
        </div>

        <div class="w-[90%]">
            <Label>Texto del Mensaje</Label>
            <Textarea v-model="form.mensaje"></Textarea>
            <InputError class="mt-2" :message="form.errors.mensaje" />
        </div>

        <div class="w-[100%] text-center flex justify-around">
            <BtnGreen @click="saveMensa(form)">Guardar</BtnGreen>
            <BtnRed @click="limpForm()" >Cerrar</BtnRed>
        </div>
    </div>
</template>