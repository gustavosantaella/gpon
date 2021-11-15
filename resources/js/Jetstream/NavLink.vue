<template>
  <li :class="{
    'nav-link':this.navlink == true
  }">
    <Link :href="href" :class="classes">
      <slot></slot>
    </Link>
  </li>
</template>

<script>
  import { defineComponent } from 'vue'
  import { Link } from '@inertiajs/inertia-vue3'

  export default defineComponent({
    components: {
      Link,
    },
    
    props: ['href', 'active', 'navlink'],
    

    computed: {
      classes() {
        return this.active
            ? 'nav-link active font-weight-bolder'
            : 'nav-link'
      }
    }
  })
</script>
