<template>
	<div class="bg-grey-lighter min-h-screen flex flex-col">
		<div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
			<form class="bg-white px-6 py-8 rounded shadow-md text-black w-full" @submit.prevent="registerUser()">
				<h1 class="mb-8 text-3xl text-center">Sign up</h1>
				<input 
					type="text"
					class="block border border-indigo w-full p-3 rounded mb-4"
					name="name"
					v-model="registerModel.name"
					placeholder="Full Name" />

				<input 
					type="text"
					class="block border border-grey-light w-full p-3 rounded mb-4"
					name="email"
					v-model="registerModel.email"
					placeholder="Email" />

				<input 
					type="password"
					class="block border border-grey-light w-full p-3 rounded mb-4"
					name="password"
					v-model="registerModel.password"
					placeholder="Password" />
				<input 
					type="password"
					class="block border border-grey-light w-full p-3 rounded mb-4"
					name="confirm_password"
					placeholder="Confirm Password" />

				<button
					type="submit"
					class="w-full text-center py-3 rounded bg-gray-500 text-white hover:bg-green-dark focus:outline-none my-1"
				>Create Account</button>
			</form>

			<div class="text-grey-dark mt-6">
				Already have an account? 
				<router-link class="no-underline border-b border-blue text-blue" :to="{name: 'login'}">Log in</router-link>.
			</div>
		</div>
	</div>
</template>

<script>
	import router from "@/router";
	import Form from 'vform'
	import { useAuthStore } from "@/store/auth";

	export default {
		name: 'Login',
		props: { },
        data: () => ({
			auth: useAuthStore(),
            registerModel: new Form({
				email: '',
				password: '',
				password: ''
			})
        }),
        mounted () { },
		methods: {
            async registerUser() {
				try {
					const res = await axios.post(route('post.register'), this.registerModel)
					this.auth.setIsLoggedIn(true)
					this.auth.update(() => router.push('/portals'))
				} catch (e) {
					console.log(e)
				}
			}
        }
	}
</script>