import { Inertia } from '@inertiajs/inertia'
import Swal from "sweetalert2";


/**
 *
 * @param {string} url
 * @param {bool} storage
 * @param {bool} fullPath
 * @returns
 */
const access = (url, storage = false, fullPath = false) => {
    let urlPath = "";
    if (fullPath) {
        urlPath += `${window.location.origin}`;
    }

    if (storage) {
        urlPath += "/storage";
    }

    return `${urlPath}/${url}`;
};

const action = (app, method, route, params = {}) => {
    const _this = app;
     Inertia[method.toLowerCase()](route, params, {
        onSuccess() {
            if (Inertia.page.props.flash.error) {

                return _this.$toast.error(Inertia.page.props.flash.error, {
                    position: "top-right",
                    duration: 5000,
                });
            }
            if (Inertia.page.props.flash.warning) {

                return _this.$toast.warning(Inertia.page.props.flash.warning, {
                    position: "top-right",
                    duration: 5000,
                });
            }
                if (_this.$page.props.flash.info) {
                    _this.disabled = false;
                    return _this.$toast.info(_this.$page.props.flash.info, {
                        position: "top-right",
                        duration: 5000,
                    });
                }

            if (Inertia.page.props.flash.status === 200) {

                _this.$toast.success("La peticion se ha realizado con exito.", {
                    position: "top-right",
                    duration: 5000,
                });

             }
             if (Inertia.page.props.flash.menssage) {
                _this.$toast.warning(Inertia.page.props.flash.menssage, {
                    position: "top-right",
                    duration: 5000,
                });
            }
        },
        onError(e) {

            const errors = (e) => {
                var error = "";
                let keys = Object.keys(e);
                keys.map((el) => {
                    error += "<li>" + e[el] + "</li>";
                });
                return error;
            };
            _this.$swal("Ups!, ha sucedido un error", errors(e), "error");
        },
        onFinish() {

            _this.$toast.success("La peticion se ha ejecutado con exito.", {
                position: "top-right",
                duration: 5000,
            });
        },
        onWaiting() {
            alert("esperando");
        },
    });
};


const $destroyNotify = (url) => {
     new Swal({
        title: "Estas seguro?",
        text: "Si eliminas este registro, se eliminara permanentemente del sistema.",
        icon: "warning",
        dangerMode: true,
        showCancelButton: true,
      }).then((e) => {
        if (e.isConfirmed) {

            Inertia.delete(url)

        }
      });
}

export { access, action, $destroyNotify };
