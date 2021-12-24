<template>
    <div class="form-responsive">
        <form @submit.prevent='this.submiting()' enctype="multipart/form-data">
            <slot name='content'></slot>

            <div>
                <input type="submit" :value="this.textButton()"
                       :class='this.classes()'
                       :disabled='this.disabled'
                       class="fw-bold"
                >
            </div>
        </form>
    </div>
</template>

<script>
export default {

    name: 'App-Form',
    props: ['class', 'data', 'method', 'buttonText', 'url', 'formData'],
    data() {
        return {
            disabled: false
        }

    },

    methods: {
        textButton() {
            return this.buttonText ?? 'Enviar'
        },
        classes() {
            return this.class ?? 'btn btn-sm btn-primary form-control'
        },
        submiting() {
            const _this = this;
            this.disabled = true
            this.$inertia[this.method](this.url, this.data, {
                forceFormData:this.formData,
                onSuccess() {

                    if (_this.$page.props.flash.error) {
                         _this.disabled = false
                        return _this.$toast.error(_this.$page.props.flash.error,{
                            position: 'top-right',
                            duration:5000,
                        })
                    }
                    if (_this.$page.props.flash.warning) {
                          _this.disabled = false
                        return _this.$toast.warning(_this.$page.props.flash.warning,{
                            position: 'top-right',
                            duration:5000,
                        })
                    }

                    if (_this.$page.props.flash.status === 200) {
                        _this.disabled = false
                        _this.$toast.success('La peticion se ha realizado con exito.',{
                            position: 'top-right',
                            duration:5000,
                        })
                        _this.$emit('submitSuccess');
                    }else if (_this.$page.props.flash.menssage) {
                        _this.$toast.warning(_this.$page.props.flash.menssage,{
                            position: 'top-right',
                            duration:5000,
                        })
                    }

                },
                onError(e) {

                    _this.disabled = false;
                    const errors = (e) => {
                        var error = '';
                        let keys = Object.keys(e);
                        keys.map(el => {
                            error += '<li>' + e[el] + '</li>'
                        })
                        return error;
                    }
                    _this.$swal('Ups!, ha sucedido un error', errors(e), 'error')
                },
                onFinish() {
                     _this.disabled = false
                    _this.$toast.success('La peticion se ha ejecutado con exito.',{
                            position: 'top-right',
                            duration:5000,
                        })
                },
                onwaiting() {
                    alert('esperando')
                }
            })
        }
    }
}
</script>

<style lang="css" scoped>
</style>
