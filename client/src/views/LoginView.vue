<template>
    <section class="flex justify-center items-center w-full h-screen">
        <LoginForm/>
    </section>
</template>
<script>

import LoginForm from '../components/Forms/LoginForm.vue';
export default {
    components: { LoginForm },
    
    data() {
        return {
            password: null,
            username: null
        }
    },

    beforeCreate() {
        this.$router.replace('/login');
        if (this.$route.params.toast === '0')this.toast.showToast('Faça o login novamente', 'error');
    },
}

</script>