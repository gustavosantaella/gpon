<template>

<Dashboard>
	<dialog-modal :id='this.modal.id'>
                <template v-slot:title>Crear nuevo requerimiento</template>
                <template v-slot:content >
                	<app-form
                	v-on:submitSuccess="this.success"
            :data='this.form'
            :url="this.form.action"
            :method='this.form.method'
            
                	>
                	<template v-slot:content>
                		<div>
                		<div class='mb-3'>
                			<label for="states">Seleccione un estado</label>
                			<select @change='this.getMunicipalities()' required v-model='this.form.state_id' id="states" class='form-control'>
                				<option v-for='state in this.states' :key='state.id' :value="state.id">{{state.name}}</option>
                			</select>
                		</div>
                		<div class='mb-3' @change='this.getParishes()' v-show='this.municipalities.length'>
                			<label for="mun">Seleccione un municipio</label>
                			<select  required v-model='this.form.municipality_id' id="mun" class='form-control'>
                				<option v-for='mun in this.municipalities' :key='mun.id' :value="mun.id">{{mun.name}}</option>
                			</select>
                		</div>
                		<div class='mb-3' v-show='this.parishes.length'>
                			<label for="mun">Seleccione una parroquia</label>
                			<select  required v-model='this.form.parish_id' id="mun" class='form-control'>
                				<option v-for='parish in this.parishes' :key='parish.id' :value="parish.id">{{parish.name}}</option>
                			</select>
                		</div>
                		<div class='mb-3'>
                			<label for="name">Nombre</label>
                			<input type="text" v-model="this.form.name" id="name" class="form-control">
                		</div>
                	</div>
                	</template>
                	</app-form>
                </template>
    </dialog-modal>
	<button class='btn btn-sm btn-secondary fw-bold' @click='this.openModal()'>Nuevo requerimiento</button>
	<datatable
	:items='this.planifications'
	:url="route('admin.modules.planificaciones.index')"
	:showItems="false"
	:th="[
	{
	original:'id',
	text:'id'
	},
	{
	original:'name',
	text:'nombre'
	},
	{
	original:'stateName',
	text:'estado',
	},
	{	
	original:'munName',
	text:'municipio'
	},
	{
	original:'parishName',
	text:'parroquia'
	},
	{
	original:'status',
	text:'status'
	}
	]"
	:options="[{
         text:'editar',
         method:'edit',
         class:'btn-primary',
         permission:(is('CONSULTOR'))
     },{
         text:'delete',
         method:'delete',
         class:'btn-danger',
         permission:(is('CONSULTOR'))
     }]"
	>

	</datatable>
</Dashboard>
</template>

<script>

import Dashboard from '@/Pages/Admin/Dashboard';
import Datatable from '@/Partials/Datatable';
import AppForm from '@/Partials/AppForm';
import DialogModal from '@/Jetstream/DialogModal'


export default{
components:{
Dashboard,
AppForm,
Datatable,
DialogModal
},

props:['planifications'],
data(){
	return {
		states:[],
		municipalities:[],
		parishes:[],
		form:{
			mehtod:null,
			action:null,
			state_id:null,
			municipality_id:null,
			parish_id:null,
			name:null
		},
		modal:{
			open:false,
			id:'newRequeriment'
		}
	}
},
methods: {
  openModal () {
  	 this.getStates()
  	 this.form.method = 'post'
  	 this.form.action = route('admin.modules.planificaciones.store');
    let element = document.getElementById(this.modal.id);
    let modal = new bootstrap.Modal(element);
    modal.show()
  },
  async getStates(){
  	try {
  		const response = await axios.get(route('admin.xhr.getStates'))
  		this.states = response.data;
  	} catch(e) {
  		// statements
  		alert(e.message)
  	}
  },

  async getMunicipalities(){
  	try {
  		const response = await axios.get(route('admin.xhr.getMunicipalities',{
  			state:this.form.state_id
  		}))
  		this.municipalities = response.data;
  	} catch(e) {
  		// statements
  		alert(e.message)
  	}
  },
  async getParishes(){
  	try {
  		const response = await axios.get(route('admin.xhr.getParishes',{
  			municipality:this.form.municipality_id
  		}))
  		this.parishes = response.data;
  	} catch(e) {
  		// statements
  		alert(e.message)
  	}
  },

  success(){
  	alert(123)
  }
}

}
</script>
