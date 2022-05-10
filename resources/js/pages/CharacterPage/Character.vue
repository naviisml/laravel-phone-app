<template>
	<div class="container py-5" v-if="character">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <h3>Character</h3>
                        <p>Name: {{ character.name }}</p>
                        <p>Length: {{ character.height }}cm</p>
                        <p>Year: {{ character.birth_year }}</p>
                        <p>Gender: {{ character.gender }}</p>
                        <p>Played in {{ character.films.length }} movies</p>
                        <p>Updated at {{ character.updated_at }}</p>
                        <p>Created at {{ character.created_at }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <h3>Planet</h3>
                        <p>Name: {{ character.planet.name }}</p>
                        <p>Population: {{ character.planet.population }}</p>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
	import axios from 'axios'

	export default {
		name: 'Characters',

        data() {
            return {
                character: null
            }
        },

        created() {
            this.get(this.$route.params.id);
        },

        methods: {
            /**
             * Retrieve the list of characters
             *
             * @param   {string}  id
             *
             * @return  {void}
             */
            async get(id = null) {
                const { data } = await axios.get(`/api/sw/character/${id}`)

                this.character = data
            },
        }

	}
</script>
