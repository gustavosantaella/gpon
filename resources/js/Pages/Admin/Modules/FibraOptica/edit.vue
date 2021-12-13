<template>
  <pre>
	{{ this.form.data }}
</pre
  >
  <Dashboard>

    <app-form
    method='post'
    :data='this.form.data'
    :url="this.route"
    >
      <template v-slot:content>
        <div v-for="task in this.tasks" :key="task.id" class="mb-3">
          <div>
            <label :for="this.label(task)">{{ task.title }}</label>
            <div v-if="task.field_type === 'file'">
              <input
                @change="this.setValue($event, task)"
                ref="photo"
                :id="this.label(task)"
                :type="task.field_type"
                class="form-control"
              />
              <iframe  :ref='this.label(task)' alt=""></iframe>
            </div>
             <div v-if="task.field_type === 'text'">
              <input
               @change="this.setValue($event,task)"
                ref="photo"
                :id="this.label(task)"
                :type="task.field_type"
                class="form-control"
              />
            </div>
             <div v-if="task.field_type === 'textarea'">
              <input
               @change="this.setValue($event,task)"
                ref="photo"
                :id="this.label(task)"
                :type="task.field_type"
                class="form-control"
              />
            </div>
             <div v-if="task.field_type === 'number'">
              <input
                @change="this.setValue($event,task)"
                ref="photo"
                :id="this.label(task)"
                :type="task.field_type"
                class="form-control"
              />
            </div>
             <div v-if="task.field_type === 'date'">
              <input
               @change="this.setValue($event,task)"
                ref="photo"
                :id="this.label(task)"
                :type="task.field_type"
                class="form-control"
              />
            </div>

          </div>
        </div>
      </template>
    </app-form>
  </Dashboard>
</template>

<script>
import Dashboard from "@/Pages/Admin/Dashboard";
import AppForm from "@/Partials/AppForm";

export default {
  components: {
    Dashboard,
    AppForm,
  },

  props: ["tasks", "route"],


  data() {
    return {

      form: {
        data: {
            data:[]
        },
      },
    };
  },
  methods: {

      setValue(element , task){

          let value;
          if(task.field_type === 'file'){
              value = element.target.files[0];
              let s =  URL.createObjectURL(value);
            this.$refs[this.label(task)].src = s
          }else{
            value = element.target.value;
          }

       let result = this.form.data.data.filter((el)=> {
           if(el.task_id === task.id){
             el.answer = task.field_type === 'file'? element : value
               return el;
           }
        })
        if(!result.length)
        this.form.data.data.push({answer:value,task_id:task.id})
      },

    label(task) {
      return `task-${task.id}`;
    },

    submit() {
      alert("envi");
    },
  },
};
</script>
