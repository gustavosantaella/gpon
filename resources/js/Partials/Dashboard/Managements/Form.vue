<template>
	<div>
		<div class="row mb-3">
			<div class=" col-md-4">
				<label for="name">Nombre:</label>
				<input type="text" required name="name" id="name" class="form-control"
				v-model="this.data.name">
			</div>
			<div class=" col-md-4">
				<label for="acronimo">Nombre(Acronimo):</label>
				<input type="text" required name="acronym" id="acronimo" class="form-control"
				v-model="this.data.acronym">
			</div>
			<div class="col-md-4">
				<label class="form-check-label mx-1" for="position">Orden</label>
				<input type="number" class="form-control" v-model="this.data.position" id="position">
			</div>

		</div>
	</div>
	</template>

	<script>
		export default {

			name: 'Form',
			props:['data'],

			data () {
				return {

				}
			}
		}
	</script>

	<style lang="css" scoped>
	</style>