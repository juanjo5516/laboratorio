<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1 class="text-center">Crear producto</h1>
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
                                <form autocomplete="off" enctype="multipart/form-data" id="formulario" v-on:submit.prevent="submit">
                                    <div class="form-group">
                                        <label for="codigo">Código</label>
                                        <input autofocus class="form-control" id="codigo" name="codigo" type="text" v-model="producto.codigo" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('codigo') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Nombre del producto</label>
                                        <input class="form-control" id="nombre" name="nombre" type="text" v-model="producto.nombre" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('nombre') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input class="form-control" id="descripcion" name="descripcion" type="text" v-model="producto.descripcion" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('descripcion') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_minimo_viable">Stock mínimo viable</label>
                                        <input class="form-control" id="stock_minimo_viable" name="stock_minimo_viable" type="number" step="1" v-model="producto.stock_minimo_viable" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('stock_minimo_viable') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="existencia">Existencia</label>
                                        <input class="form-control" id="existencia" name="existencia" type="number" step="1" v-model="producto.existencia" v-validate="'required'">
                                        <div class="invalid-feedback">
                                            {{ errors.first('existencia') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">Precio unitario</label>
                                        <input class="form-control" id="precio" name="precio" type="number" step="0.1" v-model="producto.precio" v-validate="'required'">
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
                                        <select class="custom-select" id="unidad_id" name="unidad_id" v-model="producto.unidad_id" v-validate="'required'">
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
                                        <select class="custom-select" id="categoria_id" name="categoria_id" v-model="producto.categoria_id" v-validate="'required'">
                                            <option value=""></option>
                                            <option v-bind:value="categoria.id" v-for="categoria in categorias">
                                                {{ categoria.name }}
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ errors.first('categoria_id') }}
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
                unidades: [],
                categorias: [],
                producto: {},
                errors_server: []
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
                        axios.post('/api/productos', new FormData(document.getElementById('formulario')))
                        .then(response => {
                            Swal.fire('Registro exitoso', 'El producto fue guardado en la base de datos', 'success')
                            this.producto = {}
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
