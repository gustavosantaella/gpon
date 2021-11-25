<template>
    <dialog-modal v-if="this.modal" :id='this.modal.id'>
        <template v-slot:title>{{this.modal.title}}</template>
        <template v-slot:content>
            <slot :name="this.modal.id"></slot>
        </template>
    </dialog-modal>
    <div class="table-responsive">

        <div class='row' v-if="this.filters || this.modal">
            <div  v-if="this.filters" class="form-responsive col-md-10">

                <div class="form-group">
                    <input @keyup='this.search()' v-model='this.filter.search' type="text" class="form-control"
                    name="search"
                    placeholder="Busca algo...">
                </div>

            </div>
            <dialog-modal v-if="this.modal" :id='this.modal.id'>
                <template v-slot:title>{{ this.modal.title }}</template>
                <template v-slot:content >

                    <slot :name="this.modal.id"></slot>
                </template>
            </dialog-modal>
            <button v-if="this.modal" type='button' 
            class='btn btn-sm btn-secondary fw-bold'
            :class="{'col-md-1':this.modal.class}"
            @click='this.openModal()'><i v-if='this.modal.IconFilter' class="fas fa-filter"></i>{{
                this.modal.text }}
            </button>
        </div>
        <table class="table table-hover table-striped" ref="tableref" id="datatablesSimple">
            <thead>
                <tr>
                    <th class='text-center fw-bold' :colspan="this.captionColspan()">{{this.caption}}</th>
                </tr>
                <tr>
                    <th v-if='this.th' v-for='th in this.th'>{{ th.text.toUpperCase() }}</th>
                    <th v-if="this.options" :colspan="this.options.length" align="center">OPCIONES</th>
                    <slot name="th"></slot>
                </tr>
            </thead>

            <tbody>
                <tr v-if="this.items" v-for='item in this.items.data'>
                    <td v-if='this.th' v-for='th in this.th'>{{ item[th.original] }}</td>
                    <td v-if="this.options">
                        <button v-for="(option, key) in this.options" :key="key" :class="[option.class]"
                        @click.prevent="this.$emit(option.method,item)">{{ option.text }}
                    </button>
                </td>
            </tr>
            <slot name="items"></slot>
        </tbody>
    </table>
    <div v-if="this.items" class="d-flex justify-content-end">
        <a href="#" class='ml-2'
        @click="this.$inertia.get(this.items.prev_page_url)"><i class="fas fa-arrow-left"></i></a>
        <div>
            <button class="btn btn-sm" v-for="i of (Math.ceil(this.items.total /
            this.items.per_page))"

            @click="this.$inertia.get(route('admin.gerencias.index',{
                page:i,

            }))"
            :class="{
                ' btn-danger ': i === this.items.current_page ?? 'btn-secondary'
            }">{{ i }}
        </button>


    </div>
    <a href="#" @click="this.$inertia.get(this.items.next_page_url)"><i class="fas fa-arrow-right "></i></a>
</div>
</div>
</template>

<script>
    import DialogModal from '@/Jetstream/DialogModal'

    export default {
        components: {
            DialogModal
        },
        name: 'Datatable',
        props: ['th', 'options', 'items', 'filters', 'url', 'caption', 'modal'],

        data() {
            return {
                filter: {
                    search: null
                }
            }
        },
        mounted(){

        },
        methods: {
            search() {
                try {
                    this.$inertia.get(this.url, {
                        text: this.filter.search
                    })
                } catch (e) {
                    this.$toast.error(`Sucedio un error, pongase en contacto con el administrador \n message:`, {
                        position: 'top-right'
                    });
                }
            },
            captionColspan() {
                return this.options ? this.th.length + 1 : this.th.length;
            },
             openModal(){

            let modal = new bootstrap.Modal(document.getElementById(this.modal.id))
            this.$emit('openingModal', modal)
        }
    }

}
</script>

<style lang="css" scoped>
</style>
