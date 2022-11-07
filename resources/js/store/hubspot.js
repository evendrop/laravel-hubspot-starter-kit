import { defineStore } from './../../../node_modules/pinia'

export const useHubSpotPortalsStore = defineStore({
    id: 'HubSpotPortals',
    state: () => ({ 
        portals: []
    }),
    actions: {
      async fetchPortals() {
        const res = await axios.get(route("portals.index"));
        this.portals = res.data.portals;
      },
      reset() {
        this.fetchPortals()
      }
    },
})

export const useHubSpotListsStore = defineStore({
  id: 'HubSpotLists',
  state: () => ({ 
      loading: true,
      lists: []
  }),
  actions: {
    async fetchLists(){
      this.loading = true
      const res = await axios.get(route('hs-lists.get'))
      this.lists = res.data.lists
      this.loading = false
    },
    reset() {
      this.fetchLists()
    }
  },
})