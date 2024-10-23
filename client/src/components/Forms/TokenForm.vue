<template>
    <div class="flex flex-col justify-center items-center h-screen">
        <div class="rounded-lg shadow-md bg-white p-8 w-96 flex flex-col items-center">
            <h1 class="text-2xl font-bold text-center mb-4">Verifique seu Email</h1>
            <p class="text-gray-600 text-center mb-6">
                Para autenticar sua conta, insira o código que foi enviado para o seu endereço de email.
                Verifique também sua pasta de spam, caso não o encontre na caixa de entrada.
            </p>
            <InputOtp v-model="value" integerOnly :length="5" class="mb-4" />
            <div class="flex justify-center mt-4">
                <button @click="$emit('submit')"
                    class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-600 transition duration-200">
                    Verificar Código
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import InputOtp from 'primevue/inputotp';

export default {

    components: { InputOtp },

    data() {
        return {
            value: null,
        };
    },

    methods: {
        getValues() {
            return {
                token: this.value
            }
        }
    }
}
</script>
