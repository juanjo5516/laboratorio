<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Detalle de proveedor</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-arrow-left fa-lg mb-3" role="button" title="Regresar" v-on:click="$router.go(-1)"></i>
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2">Nit</label>
                                        <div class="col-sm-10">
                                            {{ proveedor.nit }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2">Nombre</label>
                                        <div class="col-sm-10">
                                            {{ proveedor.nombre }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2">Dirección</label>
                                        <div class="col-sm-10">
                                            {{ proveedor.direccion }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2">Teléfono</label>
                                        <div class="col-sm-10">
                                            {{ proveedor.telefono }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2">Email</label>
                                        <div class="col-sm-10">
                                            {{ proveedor.email }}
                                        </div>
                                    </div>
                                </form>
                                <router-link :to="{ name: 'proveedores.edit', params: { id: proveedor.id } }">
                                    Modificar
                                </router-link>
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
                proveedor: {}
            }
        },
        mounted() {
            axios.get('/api/proveedores/' + this.$route.params.id)
            .then(response => this.proveedor = response.data)
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
