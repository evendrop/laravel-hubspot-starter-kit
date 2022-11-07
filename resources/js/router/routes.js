
export default [
    {
        path: '/',
        name: 'home',
        redirect: { name: 'login' }
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('@/pages/auth/Login.vue')
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/pages/auth/Register.vue')
    },
    {
        path: '/logout',
        name: 'logout',
        component: () => import('@/pages/auth/Logout.vue')
    },
    {
        path: '/me',
        name: 'me',
        component: () => import('@/pages/auth/Meself.vue'),
        meta: {requiresAuth: true}
    },
    {
        path: '/portals',
        name: 'portals',
        component: () => import('@/pages/auth/Portals.vue'),
        meta: {requiresAuth: true}
    },
    {
        path: '/hs/lists',
        name: 'lists',
        component: () => import('@/pages/hubspot/Lists.vue'),
        meta: {requiresAuth: true}
    }
]