<template>
	<div class="block justify-center items-center p-4 mx-4 mt-4 mb-6">
		<div class="min-h-[50vh] flex flex-col">
			<div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
				<form class="bg-[#edf5ff] px-6 py-8 rounded shadow-2xl text-black w-full" @submit.prevent="registerUser()">
					<h1 class="text-[#202030] text-center mb-10">Sign up</h1>
					<input 
						type="text"
						name="name"
						v-model="registerModel.name"
						placeholder="Full Name" />

					<input 
						type="text"
						name="email"
						v-model="registerModel.email"
						placeholder="Email" />

					<input 
						type="password"
						name="password"
						v-model="registerModel.password"
						placeholder="Password" />
					<input 
						type="password"
						name="confirm_password"
						placeholder="Confirm Password" />

					<button
						type="submit"
						class="btn w-full"
					>Create Account</button>

					<div class="text-[#818479] font-light mt-6 text-center text-sm">
						Already have an account? 
						<router-link :to="{name: 'login'}">Log in</router-link>.
					</div>
				</form>

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