<template>




    <section class="flex justify-center items-center w-full h-screen ">
        <Dialog v-model:visible="created" modal header="Verifique Sua Conta" :style="{ width: '25rem' }">
            <div class="p-6 text-center">
                <p class="mb-4 font-bold">
                    Para ter acesso ao sistema, por favor, verifique seu e-mail.
                </p>
                <div class="flex justify-center">
                    <Button 
                        label="Verifique aqui" 
                        icon="pi pi-check" 
                        severity="contrast" 
                        raised 
                        @click="()=>this.$router.push({ path: '/verification' })" 
                    ></Button>
                </div>
            </div>
        </Dialog>
        <div class="flex flex-col text-center shadow-md  rounded-xl px-6 py-12 bg-white">
            <RegisterForm ref="form" />
            <Button label="Acessar" severity="contrast" icon="pi pi-user" :loading="loading" @click="submit" />
        </div>

    </section>

</template>
<script>
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import createAxiosInstance from "../services/http";
import RegisterForm from '../components/Forms/RegisterForm.vue';
import { inject } from 'vue';

const http = createAxiosInstance();

export default {
    name: "RegisterView",
    components: { RegisterForm, Button,Dialog },

    setup() {
        const toast = inject('toast');
        return {
            toast
        };
    },

    data() {
        return {
            loading: false,
            created: false
        }
    },

    methods: {
        async submit() {
            const register = this.$refs.form.getValues();
            if (this.isValidEmail(register.email) && this.isValidName(register.name)) {
                try {
                    this.loading = true;
                    const data = await http.post('/user', register);
                    this.toast.showToast(data.data.message, 'success')
                    this.created = true
                } catch (error) {
                    this.toast.showToast(error.response.data.message, 'error');
                } finally {
                    this.loading = false;
                }
            }
            else {
                this.toast.showToast('Verifique seus Dados.', 'error');

            }


        },

        isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        },
        isValidName(name) {
            if (typeof name !== 'string') {
                return false;
            }
            name = name.trim();

            if (name.length < 2) {
                return false;
            }

            const nameRegex = /^[A-Za-zÀ-ÿ\s]+$/;
            return nameRegex.test(name);
        }



    },



}

</script>