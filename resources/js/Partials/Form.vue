<template>
	<div class="form-responsive">
		<form @submit.prevent='this.submiting()'>
			<slot name='content'></slot>

			<div>
				<input type="submit" :value="this.textButton()" 
				:class='this.classes()'
				:disabled='this.disabled'
				class="form-control">
			</div>
		</form>
	</div>
</template>

<script>
export default {

  name: 'Form',
  props:['class', 'data', 'method', 'buttonText', 'url'],
  data () {
    return {
    	disabled:false
    }

  },

    methods:{
    	textButton(){
    		return this.buttonText ?? 'Enviar'
    	},
    	classes(){
    		return this.class ?? 'btn btn-sm btn-primary'
    	},
    	submiting(){
    		const _this = this;
    		this.$inertia[this.method](this.url, this.data, {
    			onSuccess(){
    				_this.$emit('submitSuccess');
    			}
    		})
    	}
    }
}
</script>

<style lang="css" scoped>
</style>