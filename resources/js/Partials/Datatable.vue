<template>
	<div class="table-responsive">
<div class="container row">
	<input type="text" placeholder="Buscar..." name="search" id="" class="form-control">
	<pre>
		{{this.items}}
	</pre>
</div>
		<table class="table table-hover table-striped">
			<thead>
				<tr>
				<th v-for='th in this.th'>{{th.text.toUpperCase()}}</th>
				<th :colspan="this.options.length" align="center">OPCIONES</th>
			</tr>
			</thead>

			<tbody>
				<tr v-for='item in this.items.data'>
					<td v-for='th in this.th'>{{item[th.original]}}</td>
					<td >
						<button  v-for="(option, key) in this.options" :key="key" :class="[option.class]" @click.prevent="this.$emit(option.method,item)">{{option.text}}</button>
					</td>
				</tr>
			</tbody>
		</table>
		
	</div>
</template>

<script>
export default {

  name: 'Datatable',
  props:['th','options', 'items'],
  data () {
    return {

    }
  }
}
</script>

<style lang="css" scoped>
</style>