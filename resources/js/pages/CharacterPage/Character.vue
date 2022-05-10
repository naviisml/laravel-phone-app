<template>
	<div class="container py-5" v-if="character">
        <div class="card">
            <div class="card-content">
                <p>{{ character.name }}</p>
                <p>{{ character.height }}cm</p>
                <p>Played in {{ character.films.length }} movies</p>
                <p>Hair color: {{ character.hair_color }}</p>
                <p>Skin color: {{ character.skin_color }}</p>
                <p>Eye color: {{ character.eye_color }}</p>
                <p>Born in {{ character.birth_year }}</p>
                <p>Gender: {{ character.gender }}</p>
                <p>Updated at {{ character.updated_at }}</p>
                <p>Created at {{ character.created_at }}</p>
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
