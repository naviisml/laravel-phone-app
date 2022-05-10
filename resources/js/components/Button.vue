<template>
	<button class="btn" :class="{[`btn-${type}`]: true,'btn-loading': loading}" :disabled="loading">
		<slot />
	</button>
</template>

<script>
	export default {
		name: 'VButton',

		props: {
			type: {
				type: String,
				default: 'default'
			},
			loading: {
				type: Boolean,
				default: false
			}
		}
	}
</script>
