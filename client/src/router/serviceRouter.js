import { useAuth } from "../stores/auth";

export default async function serviceRoutes(to, from, next) {
  const auth = useAuth();

/*
    meta.auth verifica se a rota precisa de autenticacao
*/

  if (to.meta.auth && (!auth.getToken() || !auth.getUser())) {
    return next({ path: "/login/0" });
  }

  if (to.meta.auth) {
    const isAuthenticated = await auth.checkToken();
    return isAuthenticated ? next() : next({ path: "/login/0" });
  }
 
  if (!to.meta.auth && auth.getToken() && auth.getUser()){
    return next({ name: "home" });
  }

  next();
}
