<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1 class="text-center">Modificar cuenta</h1>
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
                                        <label for="numero">Número de cuenta</label>
                                        <input autofocus class="form-control" id="numero" name="numero" type="text" v-model="cuenta.numero" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('numero') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="banco_id">Banco</label>
                                        <select class="custom-select" id="banco_id" name="banco_id" v-model="cuenta.banco_id" v-validate="'required'">
                                            <option value=""></option>
                                            <option v-bind:value="banco.id" v-for="banco in bancos">
                                                {{ banco.name }}
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ errors.first('banco_id') }}
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
                                        Actualizar
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
                cuenta: {},
                bancos: [],
                errors_server: []
            }
        },
        mounted() {
            Promise.all([
                axios.get('/api/cuentas/' + this.$route.params.id),
                axios.get('/api/bancos')
                ])
            .then(response => {
                this.cuenta = response[0].data
                this.bancos = response[1].data.data
            })
            .catch(error => {
                console.log(errors.response)
            })
        },
        methods: {
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.put('/api/cuentas/' + this.$route.params.id, this.cuenta)
                        .then(response => {
                            Swal.fire('Actualización exitosa', 'La cuenta bancaria fue actualizada en la base de datos', 'success')
                        })
                        .catch(error => {
                            console.log(error.response)
                        })
                    }
                })
            }
        }
    }
</script>
