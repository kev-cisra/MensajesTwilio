<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <section class="flex justify-center items-center min-h-screen Fondo">
        <div class="border-4 rounded-xl border-gray-400 bg-gradient-to-r from-cyan-500 to-blue-500 opacity-90 w-[70vw] h-[80vh] lg:w-[30vw] lg:h-[35vh] flex justify-center items-center">
            <form @submit.prevent="submit" class="w-[90%]">
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
    
                <div class="my-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                
                <div class="flex justify-center">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Entrar
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </section>
</template>


<style>
    .Fondo {
        background-image: url('/images/FonMensa1.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>