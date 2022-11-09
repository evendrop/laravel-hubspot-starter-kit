<template>
	<div class="block justify-center items-center" >
        <div class="px-12">
			<div class="pt-5 flex justify-between">
				<div> <h1>My HubSpot contact lists</h1> <div class="subtext">Contact lists currently active in your HubSpot hub.</div> </div>
			</div>
		</div>
	</div>
	<div class="block justify-center items-center p-4 mx-4 mt-4 mb-6" >
		<div class="min-h-[50vh]" :class="!lists?.length ? 'flex justify-center items-center' : ''" v-if="!loading">
			<div class="flex flex-wrap -mx-1 lg:-mx-4" v-if="lists.length">
				<div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4" v-for="(list, key) in lists" :key="key">

					<div class="p-6 card relative">
						<div class="card-gradient-teal"></div>
						<div class="flex mb-8">
							<font-awesome-icon icon="fa-brands fa-hubspot" class="pr-0 text-3xl text-[#ff7a59]" />
							<div class="px-4 flex whitespace-nowrap text-ellipsis overflow-hidden"><h3 class="text-white text-xl">Contact List</h3></div>
						</div>
						<div class="border-b-2 border-[#707A9C] mb-8"></div>
						<h5 class="mb-2 text-lg font-semibold tracking-tight text-white">
							<span class="muted pr-2">Name:</span> {{ list.name }}
						</h5>
						<h5 class="mb-2 text-lg font-semibold tracking-tight text-white">
							<span class="muted pr-2">Type:</span> {{list.listType}}
						</h5>
						<h5 class="mb-2 text-lg font-semibold tracking-tight text-white">
							<span class="muted pr-2">Size:</span> {{list.metaData?.size}}
						</h5>
					</div>


				</div>
			</div>
			<div class="flex justify-center" v-if="!lists.length">
				<div>
					<h1 class="mb-8 text-3xl text-center">No Lists found.</h1>
					<p class="text-center subtext">You don't have any Contact Lists in this hub.<br> <router-link :to="{name: 'portals'}">Choose another hub</router-link> or navigate to your HubSpot hub and add some contact lists.</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>

	import { storeToRefs } from 'pinia';
	import { useHubSpotListsStore } from '@/store'
	

	const hubspotListsStore = useHubSpotListsStore();
	const { lists, loading } = storeToRefs(useHubSpotListsStore());

	hubspotListsStore.fetchLists()

</script>
