<template>
	<p>Hello World!</p>
</template>

<script>
    import axios from 'axios'

	export default {
		name: 'Home',

        mounted() {
            this.test()
        },

        methods: {
            async test() {
                const data = await axios.post('/api/parse/text', {
                    text: 'test'
                })

                console.log(data)
            }
        }

	}
</script>
