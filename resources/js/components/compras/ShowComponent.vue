<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Detalle de la compra</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <i class="fas fa-arrow-left fa-lg mb-3" role="button" title="Regresar" v-on:click="$router.go(-1)"></i>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center">
                                    {{ compra.proveedor }}
                                </h3>
                                <p class="text-muted text-center">
                                    Compra <span class="text-lowercase">{{ compra.forma_pago }}</span>
                                    <br>
                                    {{ compra.created_at }}
                                </p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>ID</b>
                                        <a class="float-right">
                                            {{ compra.id }}
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Factura</b>
                                        <a class="float-right">
                                            {{ compra.factura }}
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total</b>
                                        <a class="float-right">
                                            {{ compra.total }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <h4>Productos</h4>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio unitario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="producto in productos">
                                            <th scope="row">{{ producto.id }}</th>
                                            <td>{{ producto.nombre }}</td>
                                            <td>{{ producto.pivot.cantidad }}</td>
                                            <td>{{ producto.pivot.precio }}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                compra: {},
                productos: []
            }
        },
        mounted() {
            Promise.all([
                axios.get('/api/compras/' + this.$route.params.id),
                axios.get(`/api/compras/${this.$route.params.id}/productos`)
                ])
            
            .then(response => {
                this.compra = response[0].data
                this.productos = response[1].data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
