<template>
    <nav class="fixed z-30 w-full bg-slate-100">
        <div class="py-3 px-3 lg:px-5 lg:pl-3">
            <div class="flex justify-between items-center">
                <div class="flex justify-start items-center">
                    <svg width="192px" height="39px" viewBox="0 0 192 39" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>Laravel HubSpot Starter Kit</title>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Group" fill="rgb(30,41,59)" fill-rule="nonzero">
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
                <div class="flex items-center" v-if="isLoggedIn">
                    <Popper>
                        <button v-if="team" class="mr-5">
                            <div class="flex justify-center flex-nowrap items-center">
                                <font-awesome-icon icon="fa-solid fa-users" class="pr-4" />
                                <div class="text-dark-700 hover:text-gray-400 transition-all duration-200">{{team?.name}}</div>
                            </div>
                        </button>
                        <template #content>
                            <div class="z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg shadow-gray-300 block">
                                <div>
                                    <ul>
                                        <li v-for="(t, key) in teams" :key="key">
                                            <button class="block text-sm text-gray-700 hover:bg-gray-100 px-5 py-4 w-full text-left" :class="t.id == auth.team.id ? 'bg-gray-100 text-green-500' : ''" @click="changeActiveTeam(t.id)">{{t.name}} ({{t.portals_count}} portals)</button>
                                        </li>
                                    </ul>
                                    <div class="border-b h-0"></div>
                                    <div>
                                        <ul>
                                            <li>
                                                <button class="block text-sm text-gray-700 hover:bg-gray-100 px-5 py-4 w-full text-left text-blue-400" @click="showCreateNewTeam()">Create new team</button>
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
                        <button class="mr-5">
                            <div class="flex justify-center flex-nowrap items-center">
                                <font-awesome-icon icon="fa-brands fa-hubspot" class="pr-4 text-[#ff5c35]" />
                                <div v-if="hub">{{hub?.hub__domain}}</div>
                                <button v-else class="flex items-center shadow-gray-300 text-dark-700 hover:text-gray-400 transition-all duration-200">
                                    Pick your HubSpot Portal
                                </button>
                            </div>
                        </button>
                        <template #content>
                            <div class="z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg shadow-gray-300 block">
                                <div>
                                    <ul>
                                        <li v-for="(h, key) in hubs" :key="key">
                                            <button class="block text-sm text-gray-700 hover:bg-gray-100 px-5 py-4 w-full text-left" :class="h.id == auth.hub?.id ? 'bg-gray-100 text-green-500' : ''" @click="changeActiveHub(h)">{{h.hub__domain}}</button>
                                        </li>
                                    </ul>
                                    <div class="border-b h-0"></div>
                                    <div>
                                        <ul>
                                            <li>
                                                <a class="block text-sm text-gray-700 hover:bg-gray-100 px-5 py-4 w-full text-left text-blue-400" href="/hs-auth">Attach new HubSpot hub</a>
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
    <div class="flex overflow-hidden pt-16">
        <aside class="flex hidden fixed top-0 left-0 z-20 flex-col flex-shrink-0 pt-16 w-64 h-full duration-200 lg:flex transition-width lg:w-64">
            <div class="flex relative flex-col flex-1 pt-0 min-h-0">
                <div class="flex overflow-y-auto flex-col flex-1 pt-8 pb-4">
                    <div class="flex-1 px-3">
                        <ul class="pb-2 pt-1">
                            <li class="" v-if="!isLoggedIn">
                                <router-link :to="{name: 'login'}" class="flex items-center hover:shadow-lg shadow-gray-300 text-dark-700 p-4 pl-4 mr-1 rounded-lg transition-all duration-200">
                                    <div class="w-10 flex justify-center"><font-awesome-icon icon="fa-solid fa-lock" class="pr-4" /></div>Sign in
                                </router-link>
                            </li>
                            <li class="" v-if="!isLoggedIn">
                                <router-link :to="{name: 'register'}" class="flex items-center hover:shadow-lg shadow-gray-300 text-dark-700 p-4 pl-4 mr-1 rounded-lg transition-all duration-200">
                                    <div class="w-10 flex justify-center"><font-awesome-icon icon="fa-solid fa-user-plus" class="pr-4" /></div>Register
                                </router-link>
                            </li>


                            <li class="" v-if="isLoggedIn">
                                <router-link :to="{name: 'me'}" class="flex items-center hover:shadow-lg shadow-gray-600 text-dark-700 p-4 pl-4 mr-1 rounded-lg transition-all duration-200">
                                    <div class="w-10 flex justify-center"><font-awesome-icon icon="fa-solid fa-users" class="pr-4" /></div>My Teams
                                </router-link>
                            </li>

                            <li class="" v-if="isLoggedIn">
                                <router-link :to="{name: 'portals'}" class="flex items-center hover:shadow-lg shadow-gray-300 text-dark-700 p-4 pl-4 mr-1 rounded-lg transition-all duration-200">
                                    <div class="w-10 flex justify-center"><font-awesome-icon icon="fa-brands fa-hubspot" class="pr-4" /></div>My Hubs
                                </router-link>
                            </li>

                            <li class="" v-if="isLoggedIn && hub">
                                <router-link :to="{name: 'lists'}" class="flex items-center hover:shadow-lg shadow-gray-300 text-dark-700 p-4 pl-4 mr-1 rounded-lg transition-all duration-200">
                                    <div class="w-10 flex justify-center"><font-awesome-icon icon="fa-solid fa-list" class="pr-4" /></div>Contact Lists
                                </router-link>
                            </li>

                            <li class="" v-if="isLoggedIn">
                                <router-link :to="{name: 'logout'}" class="flex items-center hover:shadow-lg shadow-gray-300 text-dark-700 p-4 pl-4 mr-1 rounded-lg transition-all duration-200">
                                    <div class="w-10 flex justify-center"><font-awesome-icon icon="fa-solid fa-right-to-bracket" class="pr-4" /></div>Logout
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <div class="h-full w-full relative overflow-y-auto lg:ml-64 pt-16">
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
    import { mapState } from './../../../node_modules/pinia'
    import router from "@/router";


    export default {
        name: 'App',
        el: '#app',
        computed: {
            ...mapState(useAuthStore, ['isLoggedIn', 'team', 'hub', 'teams', 'hubs'])
        },
        data: () => ({
            auth: useAuthStore(),
            portals: useHubSpotPortalsStore(),
            lists: useHubSpotListsStore(),
            showCreateTeam: false,
            newTeamName: "",
        }),
        mounted() {
            this.auth.update()
        },  
        methods: {
            showCreateNewTeam() {
                this.newTeamName = "";
                this.showCreateTeam = true;
            },

            async changeActiveTeam(id) {
                const res = await axios.post(route("teams.alias-as"), { team_id: id });
                this.auth.update(() => {
                    this.portals.reset()
                    router.push("/portals")
                    
                });
            },

            async changeActiveHub(hub) {
                const res = await axios.post(route("portals.alias-as"), hub);
                this.auth.update(() => {
                    this.lists.reset() 
                    router.push("/hs/lists")                   
                });
            },

            async createNewTeam() {
                const res = await axios.post(route("teams.store"), { name: this.newTeamName });
                this.showCreateTeam = false;
                this.auth.update(() => {
                    this.portals.reset()
                    router.push("/portals")
                });
            },
        }
    }
</script>