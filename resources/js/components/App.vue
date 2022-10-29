<template>
    <div id="sidebar" class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 bg-slate-800 p-4">
        
        <div class="mt-3">
            <svg width="192px" height="39px" viewBox="0 0 192 39" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Group</title>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Group" fill="#FFFFFF" fill-rule="nonzero">
                        <text id="Laravel\HubSpot" font-family="LibreFranklin-ExtraBold, Libre Franklin" font-size="19" font-weight="700" letter-spacing="1.117694">
                            <tspan x="8.833795" y="18">Laravel\HubSpot</tspan>
                        </text>
                        <text id="STARTER-KIT" font-family="LibreFranklin-Light, Libre Franklin" font-size="11" font-weight="300" letter-spacing="0.647086">
                            <tspan x="58.126027" y="34">STARTER KIT</tspan>
                        </text>
                    </g>
                </g>
            </svg>
        </div>

        <ul class="mt-10">
            <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" v-if="!isLoggedIn">
                <router-link :to="{name: 'login'}" class="block text-slate-200 hover:text-white truncate transition duration-150">Log in</router-link>
            </li>
            <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" v-if="!isLoggedIn">
                <router-link :to="{name: 'register'}" class="block text-slate-200 hover:text-white truncate transition duration-150">Register</router-link>
            </li>


            <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" v-if="isLoggedIn">
                <router-link :to="{name: 'me'}" class="block text-slate-200 hover:text-white truncate transition duration-150">My Teams</router-link>
            </li>

            <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" v-if="isLoggedIn">
                <router-link :to="{name: 'portals'}" class="block text-slate-200 hover:text-white truncate transition duration-150">My Hubs</router-link>
            </li>

            <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" v-if="isLoggedIn && hub">
                <router-link :to="{name: 'lists'}" class="block text-slate-200 hover:text-white truncate transition duration-150">HS Lists</router-link>
            </li>

            <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" v-if="isLoggedIn">
                <router-link :to="{name: 'logout'}" class="block text-slate-200 hover:text-white truncate transition duration-150">Logout</router-link>
            </li>
        </ul>


    </div>

    <main class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
        <header class="sticky top-0 bg-white border-b border-slate-200 z-30">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 -mb-px">
                    <div class="flex"></div>
                    <div class="flex items-center">
                        <div class="flex mr-8" v-if="team">Team: {{team?.name}}</div>
                        <div class="flex mr-8" v-if="!team">
                            <router-link :to="{name: 'me'}" class="no-underline border-b border-blue text-blue-800">Pick your team</router-link>
                        </div>
                        <div class="" v-if="hub">Hub: {{hub?.hub__domain}}</div>
                        <div class="flex mr-8" v-if="!hub">
                            <router-link :to="{name: 'portals'}" class="no-underline border-b border-blue text-blue-800">Pick your HubSpot Portal</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <router-view />
    </main>

</template>

<script>

    import { useAuthStore } from '@/store/auth'
    import { mapState } from './../../../node_modules/pinia'



    export default {
        name: 'App',
        el: '#app',
        computed: {
            ...mapState(useAuthStore, ['isLoggedIn', 'team', 'hub'])
        },
        data: () => ({
            auth: useAuthStore()
        }),
        mounted() {
            this.auth.update()
        },  
        methods: {
            
        }
    }
</script>