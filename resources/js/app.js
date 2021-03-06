import { createApp } from 'vue'
import { router } from './utils/router'
import { store } from './utils/store'
import { components } from './components'

import App from './components/App/App.vue'

import './utils'

export const app = createApp(App)

app.use(router)
app.use(store)

// register the components
components.forEach(Component => {
	app.component(Component.name, Component)
})

app.mount('.wrapper')
