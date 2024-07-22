<script setup>
    import { ref, onMounted } from "vue";
    import AppLayout from '@/Layouts/AppLayout.vue';
    import TableColor from '@/Components/TableColor.vue';
    import moment from 'moment';
    import axios from 'axios';

    const Mensajes = ref([]);

    const ConMensa = async () => {
        await axios.get("../Mensajes/ConMensa")
        .then(resp => {
            Mensajes.value = resp.data;
        })
    }

    const fechaFormat = (fecha) => {
        return moment(fecha).format("DD/MM/YYYY HH:mm")
    }

    onMounted(() => {
        ConMensa()
    })
</script>

<template>
    <AppLayout title="Inicio">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inicio
            </h2>
        </template>

        <TableColor class="m-5">
                <template #TableEncabezado>
                    <th>Nombre</th>
                    <th>Fecha y Hora</th>
                    <th>Clave de Pais</th>
                    <th>Telefono</th>
                    <th>Mensaje</th>
                    <th>Recurrencia</th>
                    <th>Temporizador</th>
                </template>
                <template #TableBody>
                    <tr class="text-center" v-for="send in Mensajes" :key="send">
                        <td>{{ send.personal.nombre }} {{ send.personal.ApPat }} {{ send.personal.ApMat }}</td>
                        <td>{{ fechaFormat(send.FecEnvio) }}</td>
                        <td>{{ send.personal.clavePais }}</td>
                        <td>{{ send.personal.Telefono }}</td>
                        <td> {{ send.Mensaje }} </td>
                        <td> {{ send.Estatus ? "Mensaje Recurrente" : "Mensaje Unico" }} </td>
                        <td> {{ send.temporizador == 1440 ? "Diario" : send.temporizador+" minutos" }} </td>
                    </tr>
                </template>
            </TableColor>
    </AppLayout>
</template>
