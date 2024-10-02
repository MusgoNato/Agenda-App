<template>
    <Toast v-if="activate" :position="position" :life="3000" :severity="severity">
        <template #default>
            <div>
                <h4>{{ severity.charAt(0).toUpperCase() + severity.slice(1) }}</h4>
                <p>{{ message }}</p>
            </div>
        </template>
    </Toast>
</template>

<script>
import { defineComponent, toRefs, watch, onMounted } from 'vue';
import { useToast } from 'primevue/usetoast';
import Toast from 'primevue/toast';

export default defineComponent({
    components: { Toast },
    props: {
        message: {
            type: String,
            required: true,
        },
        position: {
            type: String,
            default: 'top-right', // Posição padrão
        },
        severity: {
            type: String,
            default: 'info', // Severidade padrão
        },
        activate: {
            type: Boolean,
        },
    },
    setup(props) {
        // Desestrutura os props para usar
        const { message, position, severity, activate } = toRefs(props);
        const toast = useToast(); // Inicializa o toast aqui

        // Função para mostrar o toast
        const showToast = () => {
            toast.add({
                severity: severity.value,
                summary: severity.value.charAt(0).toUpperCase() + severity.value.slice(1),
                detail: message.value,
                life: 3000, // Duração do toast
                position: position.value // Define a posição
            });
        };

        // Exibir toast quando ativado
        onMounted(() => {
            if (activate.value) {
                showToast();
            }
        });

        // Também observar mudanças na prop activate
        watch(activate, (newValue) => {
            if (newValue) {
                showToast();
            }
        });

        return {
            message,
            position,
            severity,
            activate,
        };
    },
});
</script>
