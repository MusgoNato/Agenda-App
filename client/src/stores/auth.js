import { computed, ref } from 'vue';
import { defineStore } from 'pinia';
import createAxiosInstance from '../services/http';
import router from '../router/router';

export const useAuth = defineStore('auth', () => {

    const token = ref(localStorage.getItem("token"));
    const user = ref(JSON.parse(localStorage.getItem("user")));
    const isAuth = ref(false);
    const http = createAxiosInstance();



    function setToken(tokenValue) {
        localStorage.setItem('token', tokenValue);
        token.value = tokenValue;
    }

    function setUser(userValue) {
        localStorage.setItem('user', JSON.stringify(userValue));
        user.value = userValue;
    }

    function setIsAuth(auth) {
        isAuth.value = auth;
    }

    const isAuthenticated = computed(() => {
        return token.value && user.value;
    })

    const fullName = computed(() => {
        if (user.value) {
            return user.value.firstName + ' ' + user.value.lastName;
        }
        return '';
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
        isAuth
    }

})