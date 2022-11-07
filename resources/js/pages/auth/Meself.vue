<template>
	<div class="block justify-center items-center p-4 mx-4 mt-4 mb-6 bg-white rounded-2xl shadow-xl shadow-gray-200" >
        <div class="bg-grey-lighter px-4">
			<div class="py-5 flex justify-between align-center">
				<div>
					<h1 class="text-3xl text-center font-bold text-gray-700">My Teams</h1>
				</div>
				<div>
					<button
						@click="showCreateNewTeam()"
						class="w-full text-center py-3 rounded bg-gray-500 text-white hover:bg-green-dark focus:outline-none px-4"
					>
						Create new team
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="block justify-center items-center p-4 mx-4 mt-4 mb-6 bg-white rounded-2xl shadow-xl shadow-gray-200" >
        <div class="bg-grey-lighter px-4">
			<h1>Authenticated user</h1>
			<div>Name: {{ me.name }}</div>
			<div>Email: {{ me.email }}</div>
			<div>Team: {{ me.team?.name }}</div>
			<div class="pt-5">
				<p class="pb-3"><i>Choose your active team</i></p>
				<select
				class="block border border-grey-light w-full p-3 rounded mb-4"
				v-model="activeTeam"
				name="teams"
				placeholder="Choose a team"
				@change="changeActiveTeam()"
				>
					<option value="null" disabled>Choose a team</option>
					<option v-for="(t, k) in me?.teams" :value="t.id" :key="k">
						{{ t.name }} ({{ t.portals_count }} portals)
					</option>
				</select>
			</div>
		</div>
  </div>
  <div
    id="authentication-modal"
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
