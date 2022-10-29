<template></template>

<script>
	import { useAuthStore } from '@/store/auth'

	import router from "@/router"
	export default {
		name: 'Logout',
		props: { },
        data: () => ({
			auth: useAuthStore(),
		}),
        async mounted () {
			const res = await axios.get(route('auth.logout'))
			this.auth.setIsLoggedIn(false)
			this.auth.update()
			router.push('/login')
		},
		methods: { }
	}
</script>