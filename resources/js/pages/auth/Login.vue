<template>
	<div class="bg-grey-lighter min-h-screen flex flex-col">
		<div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
			<form class="bg-white px-6 py-8 rounded shadow-md text-black w-full" @submit.prevent="loginUser()">
				<h1 class="mb-8 text-3xl text-center">Sign in</h1>
				<input 
					class="block border border-grey-light w-full p-3 rounded mb-4"
					v-model="loginModel.email" :class="{ 'is-invalid': loginModel.errors.has('email') }" type="email" name="email" placeholder="Email">

				<input 
					class="block border border-grey-light w-full p-3 rounded mb-4"
					v-model="loginModel.password" :class="{ 'is-invalid': loginModel.errors.has('password') }" type="password" name="password" placeholder="Password">

				<button
					type="submit"
					class="w-full text-center py-3 rounded bg-gray-500 text-white hover:bg-green-dark focus:outline-none my-1"
				>Log in</button>
			</form>

			<div class="text-grey-dark mt-6">
				Need an account? 
				<router-link class="no-underline border-b border-blue text-blue" :to="{name: 'register'}">Register</router-link>.
			</div>
		</div>
	</div>
</template>

<script>
	import router from "@/router"
  	import Form from 'vform'
	import { useAuthStore } from '@/store/auth'

	export default {
		name: 'Login',
		props: { },
        data: () => ({
			auth: useAuthStore(),
            loginModel: new Form({
				email: '',
				password: ''
			})
        }),
        mounted () { },
		methods: {
            async loginUser() {
				try {
					const res = await axios.post(route('post.login'), this.loginModel)
					this.auth.setIsLoggedIn(true)
					router.push('/portals')
				} catch (e) {
					console.log(e)
				}
			}
        }
	}
</script>