<template>
    <ToastVue 
        :key="toastKey"
        :message="toastMessage" 
        :position="toastPosition" 
        :severity="toastSeverity" 
        :activate="toastActive" 
    />

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
        <p class="text-[11px] cursor-pointer">Fazer Cadastro</p>
    </div>
</template>

<script>
import TextInput from '../Inputs/TextInput.vue';
import PasswordInput from '../Inputs/PasswordInput.vue';
import ToastVue from '../Toast/ToastVue.vue';
import Button from 'primevue/button';
import createAxiosInstance from "../../assets/services/http";

const http = createAxiosInstance();

export default {
    components: { TextInput, PasswordInput, Button, ToastVue },
    data() {
        return {
            password: "",
            email: "",
            loading: false,
            invalid: false,
            toastMessage: '',
            toastPosition: 'top-right',
            toastSeverity: 'error',
            toastActive: false,
            toastKey: 0, // Adicione um contador para o key
        }
    },
    methods: {
        showToast(message, severity) {
            this.toastMessage = message;
            this.toastSeverity = severity;
            this.toastActive = true;
            this.toastKey += 1; 
        },
        async submit() {
            if (this.isValidEmail(this.email)) {
                this.loading = true;
                try {
                    const data = await http.post('/auth/login', this.formatarDados());
                    console.log(data);
                    this.showToast('Login bem-sucedido!', 'success'); // Toast de sucesso
                } catch (error) {
                    console.error(error);
                    this.showToast('Erro ao realizar login. Tente novamente.', 'error'); // Toast de erro
                } finally {
                    this.loading = false;
                }
            } else {
                this.invalid = true;
                this.showToast('Email inválido. Por favor, insira um email válido.', 'eror'); // Toast de aviso
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
