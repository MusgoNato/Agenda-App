<template>
    <div>
        <div v-for="msg in messages" :key="msg.id">
            <p>{{ msg.content }}</p>
        </div>
        <input v-model="newMessage" placeholder="Type a message..." />
        <input v-model="recipientId" placeholder="Recipient ID" /> <!-- Campo para o ID do destinatário -->
        <button @click="sendMessage">Send</button>
    </div>
</template>

<script>
import Pusher from 'pusher-js';

export default {
    data() {
        return {
            messages: [],
            newMessage: '',
            recipientId: '',
        };
    },
    mounted() {
        // Inicializa o Pusher
        const pusher = new Pusher('b86b5b693f8ff439aae1', {
            cluster: 'sa1',
        });

        // Assina o canal privado do usuário específico
        const channel = pusher.subscribe('private-chat.' + this.userId);
        channel.bind('App\\Events\\MessageSent', (data) => {
            this.messages.push({ id: data.user_id, content: data.message });
        });
    },
    methods: {
        sendMessage() {
            if (this.newMessage.trim() === '' || !this.recipientId) {
                return; // Não envia mensagens vazias ou se não houver destinatário
            }

            fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message: this.newMessage, recipient_id: this.recipientId }) // Inclui o ID do destinatário
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Mensagem enviada:', data);
                this.newMessage = ''; // Limpa o campo de entrada após enviar
                this.recipientId = ''; // Limpa o campo de destinatário após enviar
            })
            .catch(error => {
                console.error('Erro ao enviar a mensagem:', error);
            });
        }
    }
};
</script>
