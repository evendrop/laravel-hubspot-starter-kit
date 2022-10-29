import routes from './routes'
import { createRouter, createWebHistory } from 'vue-router'
import axios from 'axios'
import { useAuthStore } from '@/store/auth'

const router = makeRouter()

export default router

function makeRouter() {
	const router = new createRouter({
		history: createWebHistory(),
		routes
	})

	router.beforeEach(beforeEach)
	router.afterEach(afterEach)

	return router
}

async function beforeEach(to, from) {

	const authStore = useAuthStore()

	if (to.meta.requiresAuth) {
		const res = await axios.get(route('user.check.get'))
		if (!res.data) {
			return { name: 'login' }
		} else {
			authStore.setIsLoggedIn(true)
			authStore.update()
		}
	}
}

function afterEach() {

}