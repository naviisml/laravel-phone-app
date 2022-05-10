<template>
	<div class="container py-5">
        <div class="card">
            <div class="card-content">
                <h3 class="py-2">Translator</h3>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                <form class="row">
                    <!-- Text -->
                    <div class="col-md-6">
                        <div class="form-group py-3">
                            <label for="text">Text</label>
                            <textarea class="form-control" type="text" v-model="parser.text" @input="lazyCaller(this.parser.text, this.translateText)" id="text"></textarea>
                        </div>
                    </div>

                    <!-- Number -->
                    <div class="col-md-6">
                        <div class="form-group py-3">
                            <label for="number">Number</label>
                            <textarea class="form-control" type="number" v-model="parser.number" @input="lazyCaller(this.parser.number, this.translateNumber)" id="number"></textarea>
                        </div>
                    </div>
                </form>
            </div>
		</div>

        <h3 class="py-3">Recent translations</h3>
        <div class="row" v-if="history">
            <div v-for="(value, key) in history" :key="key" class="col-md-3">
                <div class="card">
                    <a class="float-right p-2" @click="this.removeHistory(key)"><i class="fas fa-times"></i></a>

                    <div class="card-content">
                        <strong class="text-muted"><small>Input</small></strong>
                        <p>{{ value.input }}</p>
                    </div>

                    <div class="card-content">
                        <strong class="text-muted"><small>Output</small></strong>
                        <p>{{ value.output }}</p>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
	import axios from 'axios'
	import { mapGetters } from 'vuex'

	export default {
		name: 'Home',

		data() {
			return {
                timeout: null,
                input: '',
                parser: {
                    text: '',
                    number: '',
                }
			}
		},

		computed: mapGetters({
			history: 'history/history'
		}),

        methods: {
            /**
             * Execute the `callback` with `value` after `time` seconds
             *
             * @param   {string}  value
             * @param   {function}  callback
             * @param   {boolean}  time
             *
             * @return  {void}
             */
            lazyCaller(value, callback, time = 1000) {
                clearTimeout(this.timeout)

                this.timeout = setTimeout(() => {
                    this.input = value.toString()

                    if (typeof callback == 'function') {
                        callback(this.input)
                    }
                }, 1000)
            },
            /**
             * Translate a text to the number variant
             *
             * @param   {string}  input
             *
             * @return  {void}
             */
            async translateText(input = null) {
                const { data } = await axios.post('/api/parser/text', {
                    text: input
                })

				// save to local storage
				this.$store.dispatch('history/addEntry', {
					object: {
                        input: data.data.input,
                        output: data.data.output,
                    }
				})

                // update form data
                this.parser.text = data.data.input
                this.parser.number = data.data.output
            },
            /**
             * Translate a number to the text variant
             *
             * @param   {string}  input
             *
             * @return  {void}
             */
            async translateNumber(input = null) {
                const { data } = await axios.post('/api/parser/number', {
                    number: input
                })

				// save to local storage
				this.$store.dispatch('history/addEntry', {
					object: {
                        input: data.data.input,
                        output: data.data.output,
                    }
				})

                // update form data
                this.parser.text = data.data.output
                this.parser.number = data.data.input
            },
            /**
             * Remove a history item
             *
             * @param   {boolean}  id
             *
             * @return  {void}
             */
            removeHistory(id) {
                // save to local storage
				this.$store.dispatch('history/removeEntry', {
					id: id
				})
            }
        }

	}
</script>
