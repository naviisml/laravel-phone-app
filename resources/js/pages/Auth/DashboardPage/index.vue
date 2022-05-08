<template>
	<div class="container py-5">
        Welcome!
	</div>
</template>

<script>
	export default {
		name: 'Dashboard',
        guards: ['auth']
	}
</script>
