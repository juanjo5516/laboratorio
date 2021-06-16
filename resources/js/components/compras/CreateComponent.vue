<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Compras</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nit">Nit</label>
                                        <input class="form-control" type="text" v-on:blur="search" v-model="proveedor.nit">
                                        <div class="text-danger mt-2" v-show="notFound">
                                            Este nit no existe
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row invoice-info" v-show="notFound">
                                <div class="col-sm-4 invoice-col">
                                    Proveedor
                                    <address>
                                        <strong>
                                            {{ proveedor.nombre }}
                                        </strong>
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    Dirección
                                    <address>
                                        <strong>
                                            {{ proveedor.direccion }}
                                        </strong>
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    Contacto
                                    <address>
                                        <strong>
                                            {{ proveedor.telefono }}
                                        </strong>
                                        <br>
                                        <strong>
                                            {{ proveedor.email }}
                                        </strong>
                                    </address>
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
                proveedor: {},
                notFound: false
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            search() {
                axios.get('/api/proveedor/search', {
                    params: {
                        nit: this.proveedor.nit
                    }
                })
                .then(response => {
                    this.proveedor = response.data
                    this.notFound = false
                })
                .catch(error => {
                    this.notFound = true
                    console.log(error.response)
                })
            }
        }
    }
</script>
