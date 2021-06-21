<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Detalle de la cuenta bancaria</h1>
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
                                        <label for="inputName" class="col-sm-2">Número de cuenta bancaria</label>
                                        <div class="col-sm-10">
                                            {{ cuenta.numero }}
                                        </div>
                                    </div>
                                    <!--div class="form-group row">
                                        <label for="inputName" class="col-sm-2">Banco</label>
                                        <div class="col-sm-10">
                                            {{ cuenta.banco }}
                                        </div>
                                    </div-->
                                </form>
                                <router-link :to="{ name: 'cuentas.edit', params: { id: cuenta.id } }">
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
                cuenta: {}
            }
        },
        mounted() {
            axios.get('/api/cuentas/' + this.$route.params.id)
            .then(response => this.cuenta = response.data)
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
