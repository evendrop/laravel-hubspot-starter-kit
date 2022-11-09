<template>
    <div class="super-bg w-full h-full absolute overflow-hidden" v-if="authRoutes.includes(routeName)"><img src="/images/abstract-1.svg" class="w-full" /></div>
    <nav class="fixed z-30 w-full" v-if="authRoutes.includes(routeName)">
        <div class="container flex columns-2 justify-around items-center mx-auto max-w-[850px] py-6">
            <div class="text-white font-bold text-lg">LATCHKEY KIT</div>
            <div>
                <a href="https://github.com/evendrop/laravel-hubspot-starter-kit" class="btn btn-with-icon" target="_blank">
                    <font-awesome-icon icon="fa-brands fa-github" class="pr-4 text-[#ffffff]" />
                    View on GitHub
                </a>
            </div>
        </div>
    </nav>
    <nav class="fixed z-30 w-full" v-if="!authRoutes.includes(routeName)">
        <div class="py-6 lg:px-5 lg:pl-3">
            <div class="flex justify-between items-center">
                <div class="flex justify-start items-center relative">
                    
                </div>
                <div class="flex items-center" v-if="isLoggedIn">
                    <Popper>
                        <button v-if="team" class="naked muted px-5 py-3">
                            <div class="flex justify-center flex-nowrap items-center">
                                <font-awesome-icon icon="fa-solid fa-users" class="pr-4" />
                                <div>{{team?.name}}</div>
                            </div>
                        </button>
                        <template #content>
                            <div class="z-50 my-4 text-base list-none bg-[#22222C] rounded divide-y divide-[#707A9C] block">
                                <div>
                                    <ul>
                                        <li v-for="(t, key) in teams" :key="key">
                                            <button 
                                            class="block text-sm text-left naked px-6 py-4 w-full hover:text-[#A9DED8] transition duration-500 ease-in-out" 
                                            :class="t.id == team.id ? 'text-[#A9DED8]' : 'text-[#707A9C]'" 
                                            @click="changeActiveTeam(t.id)">{{t.name}} ({{t.portals_count}} portals)</button>
                                        </li>
                                    </ul>
                                    <div>
                                        <ul>
                                            <li>
                                                <button class="block text-sm px-5 py-4 w-full text-left" style="margin-bottom:0" @click="showCreateNewTeam()">Create new team</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </Popper>
                    <div class="flex mr-8" v-if="!team">
                        <router-link :to="{name: 'me'}" class="no-underline border-b border-blue text-blue-800">Pick your team</router-link>
                    </div>
                    <Popper>
                        <button class="ml-5 naked muted px-5 py-3">
                            <div class="flex justify-center flex-nowrap items-center">
                                <font-awesome-icon icon="fa-brands fa-hubspot" class="pr-4 text-lg" />
                                <div v-if="hub">{{hub?.hub__domain}}</div>
                                <div v-else>
                                    Pick your HubSpot hub
                                </div>
                            </div>
                        </button>
                        <template #content>
                            <div class="z-50 my-4 text-base list-none bg-[#22222C] rounded divide-y divide-[#707A9C] block">
                                <div>
                                    <ul>
                                        <li v-for="(h, key) in hubs" :key="key">
                                            <button 
                                            class="block text-sm text-left naked px-6 py-4 w-full hover:text-[#A9DED8] transition duration-500 ease-in-out" 
                                            :class="h.id == hub?.id ? 'text-[#A9DED8]' : 'text-[#707A9C]'" 
                                            @click="changeActiveHub(h)">{{h.hub__domain}}</button>
                                        </li>
                                    </ul>
                                    <div>
                                        <ul>
                                            <li>
                                                <a class="btn block text-sm px-5 py-4 w-full text-left" style="margin-bottom:0" href="/hs-auth">Attach new HubSpot hub</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </Popper>
                </div>
            </div>
        </div>
    </nav>
    <div class="flex overflow-hidden pt-16" v-if="!authRoutes.includes(routeName)">
        <aside class="fixed inset-y-0 left-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto transition-all duration-200 ease-in-out -translate-x-full border-0 shadow-none xl:ml-6 z-990 max-w-[16rem] rounded-2xl xl:translate-x-0">
            <div class="flex relative flex-col flex-1 pt-0 min-h-0">
                <div class="flex overflow-y-auto flex-col flex-1 pt-8 pb-4">
                    <div class="text-center border-b-2 border-[#707A9C] pb-8 mb-5">
                        <img src="/images/logo-light-teal.svg" width="210" class="m-auto" />
                    </div>
                    <div class="flex-1 px-3">
                        <ul class="pb-2 pt-1">
                            <li>
                                <router-link :to="{name: 'me'}" class="sidebar-link">
                                    <div class="w-10 flex items-center">
                                        <font-awesome-icon icon="fa-solid fa-users" class="pr-4" />
                                    </div>
                                    <div>My Teams</div>
                                </router-link>
                            </li>

                            <li>
                                <router-link :to="{name: 'portals'}" class="sidebar-link">
                                    <div class="w-10 flex items-center">
                                        <font-awesome-icon icon="fa-brands fa-hubspot" class="pr-4" />
                                    </div>
                                    <div>My Hubs</div>
                                </router-link>
                            </li>

                            <li>
                                <router-link :to="{name: 'lists'}" class="sidebar-link">
                                    <div class="w-10 flex items-center">
                                        <font-awesome-icon icon="fa-solid fa-list" class="pr-4" />
                                    </div>
                                    <div>Contact Lists</div>
                                </router-link>
                            </li>

                            <li>
                                <router-link :to="{name: 'logout'}" class="sidebar-link">
                                    <div class="w-10 flex items-center">
                                        <font-awesome-icon icon="fa-solid fa-right-to-bracket" class="pr-5" />
                                    </div>
                                    <div>Logout</div>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <div class="h-full w-full relative overflow-y-auto pt-24" :class="!authRoutes.includes(routeName) ? 'lg:ml-72' : null">
        <main>
            <router-view />
        </main>
    </div>

    <div
    id="new-team-modal"
    tabindex="-1"
    :class="showCreateTeam ? '' : 'hidden'"
    class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full flex justify-center bg-gray-500 bg-opacity-60"
>
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow  bg-gray-700">
                <button
                type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-100 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center  hover:bg-gray-800  hover:text-white"
                @click="showCreateTeam = false"
                >
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="py-6 px-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900  text-white">
                        Create new team
                    </h3>
                    <form class="space-y-6" @submit.prevent="createNewTeam()">
                        <div>
                            <label
                                for="email"
                                class="block mb-2 text-sm font-medium text-gray-200  text-gray-300"
                                >Team name</label
                            >
                            <input
                                type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  bg-gray-600  border-gray-500  placeholder-gray-400  text-white"
                                placeholder="my new team"
                                v-model="newTeamName"
                            />
                        </div>

                        <button
                        type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  bg-blue-600  hover:bg-blue-700  focus:ring-blue-800"
                        >
                        Create team
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>	  
</template>

<script>

    import { useAuthStore, useHubSpotPortalsStore, useHubSpotListsStore } from '@/store'
    import { mapState, mapActions } from 'pinia'
    import router from "@/router";


    export default {
        name: 'App',
        el: '#app',
        computed: {
            ...mapState(useAuthStore, ['isLoggedIn', 'team', 'hub', 'teams', 'hubs'])
        },
        data: () => ({
            auth: null,
            portals: null,
            lists: null,
            showCreateTeam: false,
            newTeamName: "",
            routeName: '',
            authRoutes: ['login', 'register']
        }),
        mounted() { },  
        watch: {
            '$route': {
                handler(newValue, oldValue) {
                    this.routeName = newValue.name
                },
                deep: true
            }
        },
        methods: {
            ...mapActions(useAuthStore, ['update']),
            ...mapActions(useHubSpotPortalsStore, ['fetchPortals']),
            ...mapActions(useHubSpotListsStore, ['fetchLists']),
            showCreateNewTeam() {
                this.newTeamName = "";
                this.showCreateTeam = true;
            },

            async changeActiveTeam(id) {
                const res = await axios.post(route("teams.alias-as"), { team_id: id });
                this.update(() => {
                    this.fetchPortals()
                    router.push("/portals")
                    
                });
            },

            async changeActiveHub(hub) {
                const res = await axios.post(route("portals.alias-as"), hub);
                this.update(() => {
                    this.fetchLists()
                    router.push("/hs/lists")                   
                });
            },

            async createNewTeam() {
                const res = await axios.post(route("teams.store"), { name: this.newTeamName });
                this.showCreateTeam = false;
                this.update(() => {
                    this.fetchPortals()
                    router.push("/portals")
                });
            },
        }
    }
</script>