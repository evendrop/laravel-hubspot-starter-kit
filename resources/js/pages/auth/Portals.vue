<template>
	<div class="block justify-center items-center" >
        <div class="px-12">
			<div class="pt-5 flex justify-between">
				<div> <h1>My HubSpot hubs</h1> <div class="subtext">HubSpot hubs currently connected to your team.</div> </div>
				<div> <a href="/hs-auth" class="btn hubspot flex items-center"><font-awesome-icon icon="fa-brands fa-hubspot" class="pr-0 text-xl text-white mr-2" /> Connect a HubSpot hub</a> </div>
			</div>
		</div>
	</div>
    <div class="block justify-center items-center p-4 mx-4 mt-4 mb-6" >
        <div class="min-h-[50vh]" :class="!portals?.length ? 'flex justify-center items-center' : ''">
            <div class="block px-4 my-5 w-100">
                <div class="flex flex-wrap -mx-1 lg:-mx-4" v-if="portals?.length">
                    <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3" v-for="portal in portals" :key="portal.id">
                        <div class="p-6 card relative">
                            <div class="card-gradient-teal"></div>
                            <div class="relative">
                                <div class="flex mb-8">
                                    <font-awesome-icon icon="fa-brands fa-hubspot" class="pr-0 text-3xl text-[#ff7a59]" />
                                    <div class="px-4 flex whitespace-nowrap text-ellipsis overflow-hidden">
                                        <h3 class="text-white text-xl">
                                            {{ portal.hub__domain }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="border-b-2 border-[#707A9C] mb-8"></div>
                                <h5 class="mb-4 text-lg font-semibold tracking-tight text-white">
                                    <span class="muted pr-2">Hub id:</span> {{ portal.hub__id }}
                                </h5>
                                <h5 class="mb-4 text-lg font-semibold tracking-tight text-white whitespace-nowrap overflow-hidden">
                                    <span class="muted pr-2">Authenticated by:</span> {{ portal.hub__user_email }}
                                </h5>
                                <div class="mb-2 pt-6 font-normal">
                                    <a href="javascript:void(0)" class="btn" @click="useHub(portal)" v-if="auth.hub?.id != portal.id">Use this hub</a>
                                    <div class="py-3 muted" v-if="auth.hub?.id == portal.id">
                                        Currently active portal
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center" v-if="!portals?.length">
                    <div>
                        <h1 class="mb-8 text-3xl text-center">
                            No connected HubSpot portals
                        </h1>
                        <p class="text-center subtext">
                            You don't have any portals connected to this team.
                            <a
                                href="/hs-auth"
                                class=""
                                >Add one now</a
                            >.<br /><br />
                            This sample app only requires a single scope
                            <strong>crm.lists.read</strong>. <br />It cannot read your
                            contacts and has <strong>no writing priveleges</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

	import { 
		useAuthStore, 
		useHubSpotPortalsStore 
	} from '@/store';

	import { storeToRefs } from 'pinia';
	import router from "@/router";

	const hubspotPortalsStore = useHubSpotPortalsStore();
	const { portals } = storeToRefs(hubspotPortalsStore);
	const auth = useAuthStore()

	hubspotPortalsStore.fetchPortals()

	async function useHub(portal) {
		const res = await axios.post(route("portals.alias-as"), portal);
        console.log("test")
		router.push("/hs/lists");
	}

</script>
