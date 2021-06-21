<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1 class="text-center">Crear proveedor</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body p-5">
                                <i class="fas fa-arrow-left fa-lg mb-3" role="button" title="Regresar" v-on:click="$router.go(-1)"></i>
                                <form autocomplete="off" id="formulario" v-on:submit.prevent="submit">
                                    <div class="form-group">
                                        <label for="nit">Nit</label>
                                        <input autofocus class="form-control" id="nit" name="nit" type="text" v-model="proveedor.nit" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('nit') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Nombre del proveedor</label>
                                        <input class="form-control" id="nombre" name="nombre" type="text" v-model="proveedor.nombre" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('nombre') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input class="form-control" id="direccion" name="direccion" type="text" v-model="proveedor.direccion" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('direccion') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input class="form-control" id="telefono" name="telefono" type="text" step="1" v-model="proveedor.telefono" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('telefono') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="email" step="1" v-model="proveedor.email" v-validate="'required|email'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('email') }}
                                        </div>
                                    </div>
                                    <blockquote class="quote-danger ml-0" v-show="errors_server.length > 0">
                                        <h4>
                                            El formulario tiene los siguientes errores
                                        </h4>
                                        <ul>
                                            <li v-for="error in errors_server">
                                                {{ error }}
                                            </li>
                                        </ul>
                                    </blockquote>
                                    <button class="btn btn-primary btn-block" type="submit">
                                        Registrar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import es from 'vee-validate/dist/locale/es';
    import VeeValidate, { Validator } from 'vee-validate';
    import Vue from 'vue';
    import Swal from 'sweetalert2';

    Vue.use(VeeValidate, {
        classes: true,
        classNames: {
            valid: 'valid',
            invalid: 'is-invalid'
        }
    });

    Validator.localize('es', es);

    export default {
        data() {
            return {
                proveedor: {},
                errors_server: []
            }
        },
        methods: {
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.post('/api/proveedores', this.proveedor)
                        .then(response => {
                            Swal.fire('Registro exitoso', 'El proveedor fue guardado en la base de datos', 'success')
                            this.proveedor = {}
                        })
                        .catch(error => {
                            if (typeof error.response.data === 'object') {
                                this.errors_server = _.flatten(_.toArray(error.response.data.errors));
                            } else {
                                this.errors_server = [
                                error.response.data.message ? error.response.data.message :
                                error.response.data
                                ];
                            }
                        })
                    }
                })
            }
        }
    }
</script>
