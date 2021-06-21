<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1 class="text-center">Modificar usuario</h1>
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
                                        <label for="name">Nombre</label>
                                        <input class="form-control" id="name" name="name" type="text" v-model="usuario.name" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('name') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Correo electrónico</label>
                                        <input class="form-control" id="email" name="email" type="email" step="1" v-model="usuario.email" v-validate="'required|email'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('email') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input class="form-control" id="password" name="password" type="password" v-model="usuario.password">
                                        <div class="invalid-feedback">
                                            {{ errors.first('password') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role_id">Rol</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role_id" id="role_id1" value="1" v-model="usuario.role_id" v-validate="'required'">
                                            <label class="form-check-label" for="role_id1">
                                                Administrador
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role_id" id="role_id2" value="2" v-model="usuario.role_id" v-validate="'required'">
                                            <label class="form-check-label" for="role_id2">
                                                Operador
                                            </label>
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ errors.first('role_id') }}
                                        </div>
                                    </div>
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
                usuario: { }
            }
        },
        mounted() {
            axios.get('/api/usuarios/' + this.$route.params.id)
            .then(response => {
                this.usuario = response.data
            })
            .catch(error => {
                console.log(errors.response)
            })
        },
        methods: {
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.put('/api/usuarios/' + this.$route.params.id, this.usuario)
                        .then(response => {
                            Swal.fire('Actualización exitosa', 'El usuario fue actualizado en la base de datos', 'success')
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
