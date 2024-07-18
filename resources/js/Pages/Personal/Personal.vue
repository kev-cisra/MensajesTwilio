<script setup>
    import { ref } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue';
    import TableColor from '@/Components/TableColor.vue';
    import Modal from '@/Components/Modal.vue';
    import Label from "@/Components/InputLabel.vue";
    import Input from "@/Components/TextInput.vue";
    import InputError from '@/Components/InputError.vue';
    import Textarea from "@/Components/Textarea.vue";
    import BtnRed from "@/Components/BtnRed.vue";
    import BtnPrm from "@/Components/PrimaryButton.vue";
import axios from 'axios';

    /*********************** Carga de personal ********************/
    // variables
    const form = ref({
        vMod: false,
        Nombre: "",
        ApPat: "",
        ApMat: "",
        ClaPais: "+52",
        Telefono: "",
        errors: []
    })

    // Consultas
    const SavePerso = (datos) => {
        axios.post("Personal/SavePerso", datos)
        .then(resp => {
            ShowModal(),
            console.log(resp.data);
        })
        .catch(err => {
            form.value.errors = err.response.data.errors
        })
    }

    // Funciones
    const ShowModal = () => {
        form.value.vMod = !form.value.vMod
    }

</script>

<template>
    <AppLayout title="Personal">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Personal
            </h2>
        </template>

        <section class="flex flex-wrap justify-around gap-5 m-5">
            <div>
                <BtnPrm @click="ShowModal">Cargar Personal</BtnPrm>
            </div>

            <TableColor>
                <template #TableEncabezado>
                    <th>Nombre</th>
                    <th>Clave de País</th>
                    <th>Telefono</th>
                </template>
                <template #TableBody>
                    <tr class="text-center">
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                </template>
            </TableColor>
        </section>

        <Modal :show="form.vMod" @close="ShowModal()">
            <div class="m-5"><h3>Carga de Personal</h3></div>
            
            <div class="flex flex-wrap justify-center items-center gap-5 my-5">
                <div class="w-[90%] md:w-[43%]">
                    <Label for="tele" value="Nombre" />
                    <Input type="tel" id="tele" v-model="form.Nombre" />
                    <InputError class="mt-2" :message="form.errors.Nombre" />
                </div>
                <div class="w-[90%] md:w-[43%]">
                    <Label for="tele" value="Apellido Paterno" />
                    <Input type="tel" id="tele" v-model="form.ApPat" />
                    <InputError class="mt-2" :message="form.errors.ApPat" />
                </div>
                <div class="w-[90%] md:w-[43%]">
                    <Label for="tele" value="Apellido Materno" />
                    <Input type="tel" id="tele" v-model="form.ApMat" />
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
                    <BtnRed @click="ShowModal()" :color="'orange'" >Cerrar</BtnRed>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>