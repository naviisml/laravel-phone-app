<template>
	<div class="container py-5">
        <div class="card">
            <div class="card-content">
                <h3 class="py-2">Translator</h3>
                <p class="text-muted">This tool will translate your messages to a 9-digit system, just like our old phone's used to have! Just type whatever you like in the box and we will do the magic!</p>

                <form class="row">
                    <!-- Text -->
                    <div class="col-md-6">
                        <div class="form-group py-3">
                            <label for="text">Text</label>
                            <textarea class="form-control" type="text" v-model="parser.text" @input="lazyCaller(this.parser.text.toString(), this.translateText)" id="text" placeholder="How are you today?"></textarea>
                            <small class="text-muted">The text you want to parse to the number variant (minimum 4 letters)</small>
                        </div>
                    </div>

                    <!-- Number -->
                    <div class="col-md-6">
                        <div class="form-group py-3">
                            <label for="number">Number</label>
                            <textarea class="form-control" type="text" v-model="parser.number" @input="lazyCaller(this.parser.number.toString(), this.translateNumber)" id="number"></textarea>
                            <small class="text-muted">The number you want to parse to text variant (minimum 4 digits)</small>
                        </div>
                    </div>
                </form>
            </div>
		</div>

        <div v-if="history.length >= 1">
            <h3 class="py-3">Recent translations</h3>

            <div class="row">
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
                    this.input = value

                    if (!this.input) {
                        this.parser.text = ''
                        this.parser.number = ''
                        return false
                    }

                    if (this.input.length <= 3) {
                        return false
                    }

                    if (typeof callback == 'function') {
                        return callback(this.input)
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
                if (!input) return

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
                if (!input) return

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
