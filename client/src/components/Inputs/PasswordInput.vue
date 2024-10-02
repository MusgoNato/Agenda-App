<template>
    <FloatLabel>
        <Password v-model="internalValue" promptLabel="Digite sua Senha" weakLabel="Senha Simples"
            mediumLabel="Senha Média" strongLabel="Senha Complexa" toggleMask v-if="feedback">
        </Password>
        <Password v-model="internalValue" :feedback="false" toggleMask v-else>
        </Password>
        <label for="password">{{ placeholder }}</label>
    </FloatLabel>
</template>
<script>
import FloatLabel from 'primevue/floatlabel';
import Password from 'primevue/password';
export default {
    props: {
        modelValue: {
            type: [String, null],
            required: true
        },
        placeholder: {
            required: true,
            type: String
        },
        feedback: {
            type: Boolean,
            default: false
        }
    },
    components: { FloatLabel, Password },
    computed: {
        internalValue: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            }
        }
    }
};
</script>