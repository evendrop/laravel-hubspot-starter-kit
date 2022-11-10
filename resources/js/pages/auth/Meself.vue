<template>
	<div class="block justify-center items-center" >
        <div class="px-12">
			<div class="pt-5 flex justify-between">
				<div> <h1>My teams</h1> <div class="subtext">Having many teams is perfect for agencies that want to lockdown access.</div> </div>
				<div>
					<button @click="showCreateNewTeam()">
						Create new team
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="block justify-center items-center p-4 mx-4 mt-4 mb-6" >
		<div class="min-h-[50vh]" :class="!me.teams?.length ? 'flex justify-center items-center' : ''">
			<div class="flex flex-wrap -mx-1 lg:-mx-4" v-if="me.teams?.length">
				<div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4" v-for="(t, key) in me.teams" :key="key">
					<div class="p-6 card relative">
						<div class="card-gradient-teal"></div>
						<div class="flex mb-8">
							<font-awesome-icon icon="fa-solid fa-users" class="pr-0 text-3xl text-[#ffffff]" />
							<div class="px-4 flex whitespace-nowrap text-ellipsis overflow-hidden"><h3 class="text-white text-xl">Team</h3></div>
						</div>
						<div class="border-b-2 border-[#707A9C] mb-8"></div>
						<h5 class="mb-2 text-lg font-semibold tracking-tight text-white">
							<span class="muted pr-2">Name:</span> {{ t.name }}
						</h5>
						<h5 class="mb-2 text-lg font-semibold tracking-tight text-white">
							<span class="muted pr-2">Connected hubs:</span> {{t.portals_count}}
						</h5>

					</div>
				</div>
			</div>
		</div>
  </div>
  <div
    id="authentication-modal"
    tabindex="-1"
    :class="showCreateTeam ? '' : 'hidden'"
    class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full flex justify-center bg-black bg-opacity-60"
  >
		<div class="relative p-4 w-full max-w-md h-full md:h-auto">
			<div class="relative rounded-lg shadow  bg-gray-800">
				<button
				type="button"
				class="absolute top-3 right-2.5 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
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
					<form class="mt-8" @submit.prevent="createNewTeam()">
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

						<button	type="submit" class="w-full mt-0"> Create team </button>
					</form>
				</div>
			</div>
		</div>
  	</div>	
</template>

<script>
import router from "@/router";
import { useAuthStore } from "@/store/auth";

export default {
  name: "Me",
  props: {},
  data: () => ({
    auth: useAuthStore(),
    me: {},
    activeTeam: null,
    showCreateTeam: false,
    newTeamName: "",
  }),
  async created() {
    this.fetchMe();
	setTimeout(() => {
}, 1000)
  },
  methods: {
    showCreateNewTeam() {
      this.newTeamName = "";
      this.showCreateTeam = true;
    },

    async changeActiveTeam() {
      const res = await axios.post(route("teams.alias-as"), { team_id: this.activeTeam });
      this.auth.update();
      router.push("/portals");
    },

    async fetchMe() {
      const res = await axios.post(route("post.me"));
      this.me = res.data;
      this.activeTeam = this.me.team.id;
    },

    async createNewTeam() {
      const res = await axios.post(route("teams.store"), { name: this.newTeamName });
      this.showCreateTeam = false;
      this.fetchMe();
    },
  },
};
</script>
