<script>
export default {
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
    }
};
</script>

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
