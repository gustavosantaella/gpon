<template>
    <div class="col-md-6">
        <div class="row">
            <h2 class="col-md-6">Actividades</h2>
            <button  type='button' data-bs-toggle="modal"
                     class='btn btn-sm btn-secondary fw-bold col-md-1'
                     data-bs-target="#modalfilters">+</button>
        </div>
        <div>
            <datatable
                :items="this.tasks"
               :th="this.th"
            />


        </div>
    </div>
</template>

<script>
import Datatable from '@/Partials/Datatable';
export default {
    components:{
        Datatable
    },

    props:['tasks', 'th']
}
</script>
