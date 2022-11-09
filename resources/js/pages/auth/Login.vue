<template>
	<div class="block justify-center items-center p-4 mx-4 mt-4 mb-6">
		<div class="min-h-[50vh] flex flex-col">
			<div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
				<form class="bg-[#edf5ff] px-6 py-8 rounded shadow-2xl text-black w-full" @submit.prevent="loginUser()">
					<h1 class="text-[#202030] text-center mb-10">Sign in</h1>
					<input 
						v-model="loginModel.email" :class="{ 'is-invalid': loginModel.errors.has('email') }" type="email" name="email" placeholder="Email">

					<input 
						v-model="loginModel.password" :class="{ 'is-invalid': loginModel.errors.has('password') }" type="password" name="password" placeholder="Password">

					<button type="submit" class="btn w-full">Log in</button>
					<div class="text-[#818479] font-light mt-6 text-center text-sm">
						Need an account? 
						<router-link :to="{name: 'register'}">Register</router-link>.
					</div>
				</form>
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