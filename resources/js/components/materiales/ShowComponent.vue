<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Detalle de material</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-arrow-left fa-lg" role="button" title="Regresar" v-on:click="$router.go(-1)"></i>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <img class="product-image" v-bind:src="material.foto">
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h3 class="my-3">
                                            {{ material.nombre }}
                                        </h3>
                                        <p>
                                            {{ material.descripcion }}
                                        </p>
                                        <h4 class="mt-3">Disponibilidad</h4>
                                        <div class="btn-group btn-group-toggle">
                                            <label class="btn btn-default text-center">
                                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                <span class="text-xl">
                                                    {{ material.stock_minimo_viable }}
                                                </span>
                                                <br>
                                                Stock mínimo
                                            </label>
                                            <label class="btn btn-default text-center">
                                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                <span class="text-xl">
                                                    {{ material.existencia }}
                                                </span>
                                                <br>
                                                Existencia
                                            </label>
                                        </div>
                                        <div class="bg-gray py-2 px-3 mt-4">
                                            <h2 class="mb-0">
                                                {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(material.precio) }}
                                            </h2>
                                            <h4 class="mt-0">
                                                <small>Precio unitario</small>
                                            </h4>
                                        </div>
                                        <div class="alert alert-danger py-2 px-3 mt-4" v-show="material.existencia < material.stock_minimo_viable">
                                            Quedan pocas unidades de
                                            <span class="text-lowercase font-weight-bold">
                                                {{ material.nombre }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                material: {}
            }
        },
        mounted() {
            axios.get('/api/materiales/' + this.$route.params.id)
            .then(response => this.material = response.data)
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
