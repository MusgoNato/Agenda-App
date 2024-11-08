<template>
    <div class="flex flex-col gap-2 p-4 text-center ">
        <h1 class="font-jetbrains font-bold text-4xl mb-4">Login</h1>
        <div class="flex flex-col gap-6">
            <TextInput v-model="email" placeholder="Digite seu Email"/>
            <div class="text-right">
                <PasswordInput v-model="password" placeholder="Digite sua senha" />
                <p class="text-[11px] mt-1 cursor-pointer">Esqueci a Senha</p>
            </div>
        </div>
    </div>
</template>

<script>
import TextInput from '../Inputs/TextInput.vue';
import PasswordInput from '../Inputs/PasswordInput.vue';
<<<<<<< HEAD

export default {
    components: { TextInput, PasswordInput },
=======
import Button from 'primevue/button';
import createAxiosInstance from "../../services/http";
import { inject } from 'vue';

const http = createAxiosInstance();

export default {
    components: { TextInput, PasswordInput, Button },
    setup() {
        const toast = inject('toast');
        return {
            toast
        };
    },

>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977
    data() {
        return {
            password: "kelvin10",
            email: "kelvinromeiro10@gmail.com",
        }
    },
    methods: {
        getValues() {
            return {
                email: this.email,
                password: this.password
            }
        },
    },


}
</script>
