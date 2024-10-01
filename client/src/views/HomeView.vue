<template>
    <section class="flex justify-center items-center w-full h-screen">
        <div class="p-4 border border-white rounded-lg">
            <h1 class="text-white">Login</h1>
            <FloatLabel>
                <InputText id="username" v-model="username" />
                <label for="username">Username</label>
            </FloatLabel>
            <FloatLabel>
                <Password v-model="password" promptLabel="Digite sua Senha" weakLabel="Senha Muito Simples"
                    mediumLabel="Complexidade Média" strongLabel="Senha Complexa" toggleMask>
                    <template #header>
                        <div class="font-semibold text-xm mb-4">Escolha uma senha</div>
                    </template>
                    <template #footer>
                        <Divider />
                        <ul class="pl-2 ml-2 my-0 leading-normal">
                            <li>Ao menos uma letra minúscula</li>
                            <li>Ao menos uma letra maiúscula</li>
                            <li>Ao menos um número</li>
                            <li>Mínimo de 8 caracteres</li>
                        </ul>
                    </template>
                </Password>
                <label for="password">Senha</label>
            </FloatLabel>

            <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Entrar</button>
        </div>
    </section>
</template>
<script>

import InputText from 'primevue/inputtext';
import FloatLabel from 'primevue/floatlabel';
import Password from 'primevue/password';


export default {
    components: { InputText, FloatLabel, Password },
    data() {
        return {
            password: null,
            username: null
        }
    }
}

</script>