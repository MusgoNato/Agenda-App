<template>
    <NavBar/>
    <RouterView class="bg-gray-100"/>
    <ToastVue 
        :key="toastKey"
        :message="toastMessage" 
        :position="toastPosition" 
        :severity="toastSeverity" 
        :activate="toastActive" 
    />
</template>

<script>

import NavBar from './components/Navbar/NavBar.vue';
import ToastVue from './components/Toast/ToastVue.vue';
import { ref, provide } from 'vue';

export default {
    components: {
        ToastVue,NavBar
    },
    setup() {
        const toastKey = ref(0);
        const toastMessage = ref('');
        const toastPosition = ref('top-right');
        const toastSeverity = ref('info');
        const toastActive = ref(false);
        const showToast = (message, severity = 'info', position = 'top-right') => {
            toastKey.value += 1;
            toastMessage.value = message;
            toastSeverity.value = severity;
            toastPosition.value = position;
            toastActive.value = true;
        };
        provide('toast', {
            showToast,
        });
        return {
            toastKey,
            toastMessage,
            toastPosition,
            toastSeverity,
            toastActive,
        };
    },
};
</script>
