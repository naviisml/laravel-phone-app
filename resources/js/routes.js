function Container (path) {
	return () => import(/* webpackChunkName: '' */ `./pages/${path}`).then(m => m.default || m)
}

export const routes = [
	{
		path: '/',
		name: 'home',
		component: Container('HomePage')
	},

    // Character Routes...
	{
		path: '/characters',
		name: 'characters',
		component: Container('CharacterPage/List')
	},

	{
		path: '/character/:id',
		name: 'character',
		component: Container('CharacterPage/Character')
	},

    // Auth Routes...
	{
		path: '/login',
		name: 'login',
		component: Container('Auth/LoginPage')
	},

	{
		path: '/register',
		name: 'register',
		component: Container('Auth/RegisterPage')
	},

	{
		path: '/user/user-dashboard',
		name: 'user.user-dashboard',
		component: Container('Auth/DashboardPage')
	},
]
