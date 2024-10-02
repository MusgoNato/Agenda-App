<template>
    <div class="flex flex-col gap-2 p-4 text-center border border-black rounded-xl px-6 py-12">
        <h1 class="font-jetbrains font-bold text-4xl mb-4">Login</h1>
        <div class="flex flex-col gap-6">
            <TextInput v-model="email" placeholder="Digite seu Email" :invalid="invalid" />
            <div class="text-right">
                <PasswordInput v-model="password" placeholder="Digite sua senha" />
                <p class="text-[11px] mt-1 cursor-pointer">Esqueci a Senha</p>
            </div>
        </div>
        <Button label="Acessar" severity="contrast" icon="pi pi-user" :loading="loading" @click="submit" />
        <p class="text-[11px] cursor-pointer">Criar Conta</p>
    </div>
</template>

<script>
import TextInput from '../Inputs/TextInput.vue';
import PasswordInput from '../Inputs/PasswordInput.vue';
import Button from 'primevue/button';
import createAxiosInstance from "../../assets/services/http";
import { inject } from 'vue';

const http = createAxiosInstance();

export default {
    components: { TextInput, PasswordInput, Button  },
    setup(){
        const toast = inject('toast');
        return{
            toast
        };
    },
    data() {
        return {
            password: "",
            email: "",
            loading: false,
            invalid: false,
        }
    },
    methods: {
        async submit() {
            if (this.isValidEmail(this.email)) {
                this.loading = true;
                try {
                    const data = await http.post('/auth/login', this.formatarDados());
                    console.log(data);
                    this.toast.showToast('Login bem-sucedido!', 'success')
                } catch (error) {
                    console.error(error);
                    this.toast.showToast('Erro ao realizar login. Tente novamente.', 'error');
                } finally {
                    this.loading = false;
                }
            } else {
                this.invalid = true;
                this.toast.showToast('Email inválido. Por favor, insira um email válido.', 'eror');
            }
        },
        formatarDados() {
            return {
                email: this.email,
                password: this.password
            }
        },
        isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    },
}
</script>
