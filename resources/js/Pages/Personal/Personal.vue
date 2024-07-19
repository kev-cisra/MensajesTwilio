<script setup>
    import { ref, onMounted } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue';
    import FormPerso from "./FormPersonal.vue";
    import SendMesa from "../Mensajes/SenMensaje.vue";
    import SaveMensa from "../Mensajes/guarMensaPerso.vue";
    import TableColor from '@/Components/TableColor.vue';
    import Modal from '@/Components/Modal.vue';
    import BtnGreen from "@/Components/BtnGreen.vue";
    import BtnRed from "@/Components/BtnRed.vue";
    import BtnPrm from "@/Components/PrimaryButton.vue";
    import axios from 'axios';

    //****************** Mostrar datos de personal ***********************/
    // variables
    const Personales = ref([]);

    const actuPer = ref(null);

    const vMod = ref(false);

    // Consultas
    const ConPerso = async () => {
        await axios.get("Personal/ConsPersonal")
        .then(resp => {
            Personales.value = resp.data
        })
    }

    // Elimina personal
    const DeletPer = (id) => {
        axios.delete('Personal/DeletPer/'+id)
        .then(resp => {
            ConPerso();
        })
    }

    // funciones 
    // Acciones de modal
    const ShowModal = () => {
        vMod.value = !vMod.value
    }

    // Edita la informacion de personal
    const editPer = (datos) => {
        actuPer.value = datos;
        ShowModal();
    }

    // Actualiza la informacion de personal
    const actualizar = () => {
        ShowModal();
        ConPerso();
        actuPer.value = null
    }

    /******************************** Mandar mensaje al Personal */
    // variables
    const vModMensa = ref(false)

    // Funciones
    const ShowModalMensa = () => {
        vModMensa.value = !vModMensa.value;
    }

    const MandaMesa = (datos) => {
        actuPer.value = datos;
        ShowModalMensa()
    }

    /********** Guarda los mensajes para mandar  ********************/
    // variables
    const vSaveMensa = ref(false)

    // funciones
    const showSaveMensa = () => {
        vSaveMensa.value = !vSaveMensa.value
    }

    onMounted(() => {
        ConPerso()
    })

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
                <BtnPrm @click="ShowModal()">Cargar Personal</BtnPrm>
            </div>

            <TableColor>
                <template #TableEncabezado>
                    <th>Nombre</th>
                    <th>Clave de País</th>
                    <th>Telefono</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </template>
                <template #TableBody>
                    <tr class="text-center" v-for="per in Personales" :key="per">
                        <td>{{ per.nombre }} {{ per.ApPat }} {{ per.ApMat }}</td>
                        <td>{{ per.clavePais }}</td>
                        <td>{{ per.Telefono }}</td>
                        <td> <BtnGreen @click="MandaMesa(per)"><i class="far fa-paper-plane"></i></BtnGreen> </td>
                        <td> <BtnGreen @click="showSaveMensa()"><i class="far fa-address-card"></i></BtnGreen> </td>
                        <td> <BtnPrm @click="editPer(per)"><i class="fas fa-user-edit"></i></BtnPrm> </td>
                        <td> <BtnRed @click="DeletPer(per.id)"><i class="fas fa-user-slash"></i></BtnRed> </td>
                    </tr>
                </template>
            </TableColor>
        </section>

        <!-- Modal carga de datos de personal -->
        <Modal :show="vMod" @close="ShowModal()">
            <form-perso :formProp="actuPer" @actuali="actualizar"></form-perso>
        </Modal>

        <!-- Modal carga de datos de personal -->
        <Modal :show="vModMensa" @close="ShowModalMensa()">
            <SendMesa :formMensa="actuPer" @actuali="MandaMesa(null)"></SendMesa>
        </Modal>

        <!-- Modal Guarda el mensaje -->
        <Modal :show="vSaveMensa" @close="showSaveMensa()">
            <SaveMensa ></SaveMensa>
        </Modal>
    </AppLayout>
</template>