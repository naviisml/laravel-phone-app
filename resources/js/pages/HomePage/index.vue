<template>
	<p>Hello World!</p>
</template>

<script>
    import axios from 'axios'

	export default {
		name: 'Home',

        mounted() {
            this.translateText('example') // translates to '339926755533'

            this.translateNumber('339926755533') // translates to 'example'
        },

        methods: {
            /**
             * Translate a text to the number variant
             *
             * @param   {string}  input
             *
             * @return  {void}
             */
            async translateText(input = null) {
                const data = await axios.post('/api/parser/text', {
                    text: input
                })

                console.log(data)
            },
            /**
             * Translate a number to the text variant
             *
             * @param   {string}  input
             *
             * @return  {void}
             */
            async translateNumber(input = null) {
                const data = await axios.post('/api/parser/number', {
                    number: input
                })

                console.log(data)
            }
        }

	}
</script>
