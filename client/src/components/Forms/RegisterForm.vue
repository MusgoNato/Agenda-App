<template>
    <div class="flex flex-col gap-2 p-4 text-center ">
        <h1 class="font-jetbrains font-bold text-4xl mb-4">Registro</h1>
        <div class="flex flex-col gap-1">
            <TextInput v-model="name" placeholder="Digite seu Nome" />
            <TextInput v-model="email" placeholder="Digite seu Email" />
            <PasswordInput v-model="password" placeholder="Digite sua senha" />
            <PasswordInput v-model="otherPassword" placeholder="Digite sua senha novamente" />
        </div>
    </div>
</template>

<script>
import TextInput from '../Inputs/TextInput.vue';
import PasswordInput from '../Inputs/PasswordInput.vue';

export default {
    components: { TextInput, PasswordInput },
    data() {
        return {
            name:"",
            password: "",
            otherPassword: "",
            email: "",
        }
    },
    methods: {
        getValues() {
            return {
                name:this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password
            }
        },
    },


}
</script>
