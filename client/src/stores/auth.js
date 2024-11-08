import { computed, ref } from 'vue';
import { defineStore } from 'pinia';
import createAxiosInstance from '../services/http';
<<<<<<< HEAD

export const useAuth = defineStore('auth', () => {

    // Ref para armazenar token e user (começando como null)
    const token = ref(false);
    const user = ref(false);
    const isAuth = ref(false);
    const http = createAxiosInstance();

    // Função para obter o token do localStorage
    function getToken() {
        const storedToken = localStorage.getItem("token");
        return storedToken ? storedToken : null;
    }

    // Função para obter o user do localStorage
    function getUser() {
        const storedUser = localStorage.getItem("user");
        return storedUser ? JSON.parse(storedUser) : null;
    }

    // Função para definir o token no localStorage
=======
import router from '../router/router';

export const useAuth = defineStore('auth', () => {

    const token = ref(localStorage.getItem("token"));
    const user = ref(JSON.parse(localStorage.getItem("user")));
    const isAuth = ref(false);
    const http = createAxiosInstance();



>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977
    function setToken(tokenValue) {
        localStorage.setItem('token', tokenValue);
        token.value = tokenValue;
    }

<<<<<<< HEAD
    // Função para definir o user no localStorage
=======
>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977
    function setUser(userValue) {
        localStorage.setItem('user', JSON.stringify(userValue));
        user.value = userValue;
    }

<<<<<<< HEAD
    // Função para definir o status de autenticação
=======
>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977
    function setIsAuth(auth) {
        isAuth.value = auth;
    }

<<<<<<< HEAD
    function isAuthenticated() {
        user.value = getUser()
        token.value = getToken()
        return token.value !== null && user.value !== null;
    }

    // Computed para obter o nome completo do usuário
=======
    const isAuthenticated = computed(() => {
        return token.value && user.value;
    })

>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977
    const fullName = computed(() => {
        if (user.value) {
            return user.value.firstName + ' ' + user.value.lastName;
        }
        return '';
<<<<<<< HEAD
    });

    // Função para verificar o token
    async function checkToken() {
        try {
            const storedToken = getToken();
            if (!storedToken) {
                throw new Error('Token não encontrado');
            }

            const { data } = await http.post('/auth/me', { 'token': storedToken });
            return data;
        } catch (error) {
            clear();
            console.error('Erro ao verificar o token:', error);
        }
    }

    // Função para limpar os dados do usuário e token
    async function clear() {
        try {
            await http.post('/auth/logout', { "token": token.value });
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            isAuth.value = false;
            token.value = null;
            user.value = null;
        }
        catch (error) {
            console.log(error)
        }

=======
    })

    async function checkToken() {
        try {

            const link = import.meta.env.VITE_API_BASE_URL + `/auth/verify?token=${token.value}`;
            const { data } = await http.get(link);
            return data;
        } catch (error) {
            clear();
            router.push('/login');
            console.log('error', error.response.data);
        }
    }

    function clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        isAuth.value = false;
        token.value = '';
        user.value = '';
>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977
    }

    return {
        token,
        user,
        setToken,
        setUser,
        checkToken,
        isAuthenticated,
        fullName,
        clear,
        setIsAuth,
<<<<<<< HEAD
        isAuth,
        getToken,
        getUser
    }

});
=======
        isAuth
    }

})
>>>>>>> 96bdb12c2a00dcc554aecf5aad75680851709977
