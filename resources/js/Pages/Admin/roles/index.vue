<template>
<Dashboard>
	
		<table class="table table-striped">
        <thead>
        <tr>
            <td>ID</td>
            <td>Nombre</td>
            <td>Created At</td>
        </tr>
        </thead>
        <tbody>
        <tr v-for="role in this.roles">
            <td>{{ role.id }}</td>
            <td>{{ role.name }}</td>
            <td>{{ role.created_at }}</td>
        </tr>

        <tr>
            <td colspan="5">
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-show="this.roles['prev_page_url']">
                            <a href="#" class="page-link" @click.prevent="getPreviousPage">
                                <span>
                                  <span aria-hidden="true">«</span>
                                </span>
                            </a>
                        </li>
                        <li class="page-item" :class="{ 'active': (this.roles['current_page']=== n) }" v-for="n in this.roles['last_page']">
                            <a href="#" class="page-link" @click.prevent="getPage(n)">
                                <span >
                                    {{ n }}
                                </span>
                            </a>
                        </li>
                        <li class="page-item" v-show="this.roles['next_page_url']">
                            <a href="#" class="page-link" @click.prevent="getNextPage">
                                <span>
                                  <span aria-hidden="true">»</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </td>
        </tr>

        </tbody>
    </table>
</Dashboard>

</template>

<script>
	import Dashboard from '@/Pages/Admin/Dashboard'; 
export default {
	components:{
		Dashboard
	},
  name: 'index',
  props:['roles'],
  data () {
    return {

    }
  },
      methods: {
            getPage(page){
                this.$inertia.get(route('admin.roles.index', {page}))
            },
            getPreviousPage(){
           
                  this.$inertia.get(this.roles['prev_page_url'])
            },
            getNextPage(){
            	  this.$inertia.get(this.roles['next_page_url'])
               
            },
        }
}
</script>

<style lang="css" scoped>
</style>