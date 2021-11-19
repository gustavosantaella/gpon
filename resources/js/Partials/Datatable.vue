<template>
    <div class="table-responsive">
        <div class="container row">
            <input type="text" placeholder="Buscar..." name="search" id="" class="form-control">
            <pre>
		{{ this.items }}
	</pre>
        </div>
        <table class="table table-hover table-striped" ref="tableref" id="datatablesSimple">
            <thead>
            <tr>
                <th v-for='th in this.th'>{{ th.text.toUpperCase() }}</th>
                <th :colspan="this.options.length" align="center">OPCIONES</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for='item in this.items.data'>
                <td v-for='th in this.th'>{{ item[th.original] }}</td>
                <td>
                    <button v-for="(option, key) in this.options" :key="key" :class="[option.class]"
                            @click.prevent="this.$emit(option.method,item)">{{ option.text }}
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <a href="#" class='ml-2'
               @click="this.$inertia.get(this.items.prev_page_url)"><i class="fas fa-arrow-left"></i></a>
            <div>
                <button class="btn btn-sm" v-for="i of (Math.ceil(this.items.total /
        this.items.per_page))"

                        @click="this.$inertia.get(route('admin.gerencias.index',{
                                                    page:i
                                                }))"
                        :class="{
                                ' btn-danger ': i === this.items.current_page ?? 'btn-secondary'
                            }">{{ i  }}
                </button>


            </div>
            <a href="#" @click="this.$inertia.get(this.items.next_page_url)"><i class="fas fa-arrow-right "></i></a>
        </div>
    </div>
</template>

<script>

export default {

    name: 'Datatable',
    props: ['th', 'options', 'items'],

}
</script>

<style lang="css" scoped>
</style>
