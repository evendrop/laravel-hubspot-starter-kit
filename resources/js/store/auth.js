import { defineStore } from 'pinia'

export const useAuthStore = defineStore({
    id: 'Auth',
    state: () => ({ 
        loggedIn: false, 
        team: null,
        hub: null,
        teams: null ,
        hubs: null
    }),
    getters: {
        isLoggedIn: (state) => state.loggedIn
    },
    actions: {
      setIsLoggedIn(val) {
        this.loggedIn = val
      },
      setTeam(team){
        this.team = team
      },
      setHub(hub){
        this.hub = hub
      },
      setTeams(teams){
        this.teams = teams
      },
      setHubs(hubs){
        this.hubs = hubs
      },
      async update(callback){
        if(this.isLoggedIn){
          const res = await axios.post(route("post.me"));
          this.setTeam(res.data.team)
          this.setHub(res.data.portal)
          this.setTeams(res.data.teams)
          this.setHubs(this.team.portals)
        }
        void 0 !== callback ? callback() : null
      },

      async logout() {
        this.$reset();
      },
    },
})