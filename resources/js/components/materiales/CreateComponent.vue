<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1 class="text-center">Crear material</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-6 col-offset-3">
                        <div class="card">
                            <div class="card-body p-5">
                                <i class="fas fa-arrow-left fa-lg mb-3" role="button" title="Regresar" v-on:click="$router.go(-1)"></i>
                                <form autocomplete="off" enctype="multipart/form-data" id="formulario" v-on:submit.prevent="submit">
                                    <div class="form-group">
                                        <label for="codigo">Código</label>
                                        <input autofocus class="form-control" id="codigo" name="codigo" type="text" v-model="material.codigo" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('codigo') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Nombre del material</label>
                                        <input class="form-control" id="nombre" name="nombre" type="text" v-model="material.nombre" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('nombre') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input class="form-control" id="descripcion" name="descripcion" type="text" v-model="material.descripcion" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('descripcion') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_minimo_viable">Stock mínimo viable</label>
                                        <input class="form-control" id="stock_minimo_viable" name="stock_minimo_viable" type="number" step="1" v-model="material.stock_minimo_viable" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('stock_minimo_viable') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="existencia">Existencia</label>
                                        <input class="form-control" id="existencia" name="existencia" type="number" step="1" v-model="material.existencia" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('existencia') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">Precio unitario</label>
                                        <input class="form-control" id="precio" name="precio" type="number" step="0.1" v-model="material.precio" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('precio') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto del producto</label>
                                        <input class="form-control" id="foto" name="foto" type="file" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="unidad_id">Unidad de medidad</label>
                                        <select class="custom-select" id="unidad_id" name="unidad_id" v-model="material.unidad_id" v-validate="'required'">
                                            <option value=""></option>
                                            <option v-bind:value="unidad.id" v-for="unidad in unidades">
                                                {{ unidad.name }}
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ errors.first('unidad_id') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoria_id">Categoria</label>
                                        <select class="custom-select" id="categoria_id" name="categoria_id" v-model="material.categoria_id" v-validate="'required'">
                                            <option value=""></option>
                                            <option v-bind:value="categoria.id" v-for="categoria in categorias">
                                                {{ categoria.name }}
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ errors.first('categoria_id') }}
                                        </div>
                                    </div>
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
                unidades: [],
                categorias: [],
                material: {}
            }
        },
        mounted() {
            Promise.all([
                axios.get('/api/unidades'),
                axios.get('/api/categorias')
                ])
            .then(response => {
                this.unidades = response[0].data.data
                this.categorias = response[1].data.data
            })
            .catch(error => {
                console.log(errors.response)
            })
        },
        methods: {
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.post('/api/materiales', new FormData(document.getElementById('formulario')))
                        .then(response => {
                            Swal.fire('Registro exitoso', 'El material fue guardado en la base de datos', 'success')
                            this.material = {}
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
