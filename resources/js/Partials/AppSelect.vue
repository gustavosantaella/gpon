<template>
    <div>
        <v-select
            v-model='this.selected_id'
            :options="this.showData()"
            label="label"
            :reduce="(data) => data.id"
            :multiple="this.multiple ?? true"
            v-on:option:selected='this.selected'
            v-on:option:deselected='this.unselect'
        ></v-select>
    </div>
</template>

<script>
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

export default {
    components:{
        vSelect,
    },
    props:['data', 'multiple', 'route'],

    data(){
        return {
            selected_id: [],
        }
    },
    created() {
        this.data.map(el => {
            if(el.check) {
                this.selected_id.push(el.id)

            }
        })

        return this.selected_id;
        },

    methods:{
        showData(){
           return this.data.map(el => {
                return {
                    label:el.name,
                    id:el.id
                }
            })
        },

        selected(selectedOption) {
            let selected_id;
            selected_id = this.multipe || Array.isArray(selectedOption)? selectedOption.map(e => e.id) : selectedOption.id;
            this.$emit('selected', selected_id)
        },
        unselect(){
            let selected = (this.selected_id)
           this.$emit('selected', selected)
        },
        send(selected_id){
            axios.post(this.route,{
                selected: selected_id
            }).then(response => {

                this.selectd_id = response.data
            })
        }
    },
}
</script>
