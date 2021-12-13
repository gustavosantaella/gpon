<template>
  <pre>
	{{ this.form.data }}
</pre
  >
  <Dashboard>
    <app-form :method="this.method" :data="this.form.data" :url="this.route">
      <template v-slot:content>
          {{ this.route }} = {{ this.method }}
        <div v-for="task in this.tasks" :key="task.id" class="mb-3">
          <div>
            <label :for="this.label(task)">{{ task.title }}</label>
            <div v-if="task.field_type === 'file'">
              <input
                @change="this.setValue($event, task)"
                :ref="this.label(task)"
                :data-type="task.field_type"
                :id="this.label(task)"
                :type="task.field_type"
                class="form-control"
              />
              <iframe :ref="this.label(task)" alt=""></iframe>
            </div>
            <div v-if="task.field_type === 'text'">
              <input
                @change="this.setValue($event, task)"
                :ref="this.label(task)"
                :data-type="task.field_type"
                :id="this.label(task)"
                :type="task.field_type"
                class="form-control"
              />
            </div>
            <div v-if="task.field_type === 'textarea'">
              <input
                @change="this.setValue($event, task)"
                :ref="this.label(task)"
                :data-type="task.field_type"
                :id="this.label(task)"
                :type="task.field_type"
                class="form-control"
              />
            </div>
            <div v-if="task.field_type === 'number'">
              <input
                @change="this.setValue($event, task)"
                :ref="this.label(task)"
                :data-type="task.field_type"
                :id="this.label(task)"
                :type="task.field_type"
                class="form-control ff"
              />
            </div>
            <div v-if="task.field_type === 'date'">
              <input
                @change="this.setValue($event, task)"
                :ref="this.label(task)"
                :data-type="task.field_type"
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

  props: ["tasks", "answerd", "lines", "routeUrl"],

  data() {
    return {
      route: route(this.routeUrl.store.url, this.routeUrl.store.params),
      method:'post',
      form: {
        data: {
          data: [],
        },
      },
    };
  },

  mounted() {
    this.setValueOnEDit();

  },
  computed: {
 
  },
  methods: {
setValueOnEDit() {

      if (this.lines) {

      this.route = route(this.routeUrl.update.url, this.routeUrl.update.params);
     this.method = "post";


        for (let line of this.lines) {
          let value;
          let search = `task-${line.task_id}`.trim();
          let ref = this.$refs[search];
          let elem = document.getElementById(search);
          if (elem.getAttribute("data-type") === "file") {
            value = new File([""], this.access(line.answer, true));
            ref.src = this.access(line.answer, true);
          } else {
            value = ref.value = line.answer;
          }
          this.form.data.data.push({
            line_id: line.id,
            answer: value,
            task_id: parseInt(elem.id.replace("task-", "")),
          });
        }
      }
    },
    setValue(element, task) {
      let value;
      if (task.field_type === "file") {
        value = element.target.files[0];
        let s = URL.createObjectURL(value);
        this.$refs[this.label(task)].src = s;
      } else {
        value = element.target.value;
      }

      let result = this.form.data.data.filter((el) => {
        if (el.task_id === task.id) {
          el.answer = task.field_type === "file" ? element : value;
          return el;
        }
      });
      if (!result.length)
        this.form.data.data.push({ answer: value, task_id: task.id });
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
