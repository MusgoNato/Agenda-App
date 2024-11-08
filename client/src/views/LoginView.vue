<<<<<<< HEAD
<template>
    <section class="flex justify-center items-center w-full h-screen">
        <div class="flex flex-col text-center shadow-md  rounded-xl px-6 py-12 bg-white">
            <LoginForm ref="form" />
            <Button label="Acessar" severity="contrast" icon="pi pi-user" :loading="loading" @click="submit" />
            <p class="text-[11px] cursor-pointer mt-1" 
            @click="()=>this.$router.push({ path: '/register' })" 
            >Criar Conta</p>
        </div>

    </section>
</template>
<script>
import Button from 'primevue/button';
import LoginForm from '../components/Forms/LoginForm.vue';
import createAxiosInstance from "../services/http";
import { inject } from 'vue';
import { useAuth } from '../stores/auth';

const http = createAxiosInstance();


export default {
    components: { LoginForm, Button },

    setup() {
        const toast = inject('toast');
        return {
            toast
        };
    },

    beforeCreate() {
        this.$router.replace('/login');
        if (this.$route.params.toast === '0') this.toast.showToast('Faça o login novamente', 'error');
    },

    data() {
        return {
            loading: false
        }
    },

    methods: {
        async submit() {
            const auth = useAuth();
            const login = this.$refs.form.getValues();
            
            if (this.isValidEmail(login.email)) {
                try {
                    this.loading = true;
                    const data = await http.post('/auth/login', login);     
                    auth.setToken(data.data.token);
                    auth.setUser(data.data.user);
                    auth.setIsAuth(true)
                    this.toast.showToast(data.data.message, 'success')
                    this.$router.push({ path: '/home' })
                } catch (error) {
                    this.toast.showToast(error.response.data.message, 'error');
                } finally {
                    this.loading = false;
                }
            }


        },

        isValidEmail(value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(value);
        }
    },



}

</script>
=======
<script>
export default {
<<<<<<<< HEAD:client/src/views/HomeView.vue
========
    components: { LoginForm },
    
>>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977:client/src/views/LoginView.vue
    data() {
        return {
            date: new Date(),
            selectedActivities: [], // Armazena as atividades do dia selecionado
            attributes: [
                {
                    key: 'event1',
                    content: {
                        style: {
                            color: 'brown',
                        }
                    },
                    highlight: {
                        start: { 
                            fillMode: 'outline', 
                            color: 'red' // Cor do contorno no início
                        },
                        base: { 
                            fillMode: 'light', 
                            color: 'red' // Cor de fundo ao passar o mouse
                        },
                        end: { 
                            fillMode: 'outline', 
                            color: 'red' // Cor do contorno no fim
                        },
                    },
                    dot: {
                        style: {
                            backgroundColor: 'brown',
                        }
                    },
                    popover: {
                        label: 'Hoje é um dia importante!',
                        visibility: 'click'
                    },
                    customData: { event: "Feriado", description: "Dia Nacional de algo" },
                    dates: { start: new Date('2024-10-24'), end: new Date('2024-10-27') },
                    order: 0
                },
                // {
                //     key: 'event2',
                //     content: {
                //         style: {
                //             color: 'blue',
                //         }
                //     },
                //     highlight: {
                //         color: 'blue',
                //         fillMode: 'light',
                //     },
                //     dot: {
                //         style: {
                //             backgroundColor: 'blue',
                //         }
                //     },
                //     popover: {
                //         label: 'Hoje é um dia importante!',
                //         visibility: 'click'
                //     },
                //     customData: { event: "Feriado", description: "Dia Nacional de algo" },
                //     dates: { start: new Date('2024-10-24'), end: new Date('2024-10-26') },
                //     order: -1
                // },
            ]
        };
    },
    methods: {
        handleDayClick(day) {
            const selectedDate = day.date;
            // Filtra as atividades para a data selecionada
            this.selectedActivities = this.attributes.filter(attribute => {
                const startDate = new Date(attribute.dates.start).setHours(0, 0, 0, 0);
                const endDate = new Date(attribute.dates.end).setHours(0, 0, 0, 0);
                return selectedDate.setHours(0, 0, 0, 0) >= startDate && selectedDate.setHours(0, 0, 0, 0) <= endDate;
            });
        }
<<<<<<<< HEAD:client/src/views/HomeView.vue
    }
};
</script>
========
    },

    beforeCreate() {
        this.$router.replace('/login');
        if (this.$route.params.toast === '0')this.toast.showToast('Faça o login novamente', 'error');
    },
}
>>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977:client/src/views/LoginView.vue

<template>
    <section class="flex flex-col justify-center items-center h-screen">
        <VCalendar locale="pt-br" :attributes="attributes" v-model="date" @dayclick="handleDayClick" />
        <div v-if="selectedActivities.length">
            <h2>Atividades do dia {{ date.toLocaleDateString() }}:</h2>
            <ul>
                <li v-for="activity in selectedActivities" :key="activity.key">
                    {{ activity.customData.event }}: {{ activity.customData.description }}
                </li>
            </ul>
        </div>
        <div v-else>
            <p>Nenhuma atividade para este dia.</p>
        </div>
    </section>
</template>

<style>
/* Customizações de estilo */
.vc-container .vc-weekday-1,
.vc-container .vc-weekday-7 {
    color: black;
}
</style>
>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977
