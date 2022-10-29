import { defineStore } from './../../../node_modules/pinia'

export const useAuthStore = defineStore({
    id: 'Auth',
    state: () => ({ 
        loggedIn: false, 
        team: null,
        hub: null 
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
      async update(callback){
        if(this.isLoggedIn){
          const res = await axios.post(route("post.me"));
          this.setTeam(res.data.team)
          this.setHub(res.data.portal)
        }
        console.log(callback)
        void 0 !== callback ? callback() : null
      }
    },
})