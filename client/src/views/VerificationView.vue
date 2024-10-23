<template>
    <TokenForm ref="form" @submit="submit" />
</template>

<script>
import TokenForm from '../components/Forms/TokenForm.vue';
import createAxiosInstance from "../services/http";
import { inject } from 'vue';

const http = createAxiosInstance();
export default {
    components: { TokenForm },

    setup() {
        const toast = inject('toast');
        return {
            toast
        };
    },

    methods: {
        async submit() {
            const token = this.$refs.form.getValues();
            try {
                this.loading = true;
                const data = await http.post('/authenticated-user', token);
                this.toast.showToast(data.data.message, 'success')
            } catch (error) {
                console.error(error);
                this.toast.showToast('Usuário não encontrado.', 'error');
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
