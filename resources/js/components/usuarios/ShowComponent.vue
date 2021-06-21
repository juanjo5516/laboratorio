<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Detalle de usuario</h1>
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
                                        <label for="inputName" class="col-sm-2">Nombre</label>
                                        <div class="col-sm-10">
                                            {{ usuario.name }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2">Email</label>
                                        <div class="col-sm-10">
                                            {{ usuario.email }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2">Rol</label>
                                        <div class="col-sm-10">
                                            <span class="badge" v-bind:class="{ 'badge-success': usuario.role_id == 1,  'badge-secondary': usuario.role_id == 2  }">
                                                {{ usuario.role_id == 1 ? 'Administrador' : 'Operador' }}
                                            </span>
                                        </div>
                                    </div>
                                </form>
                                <router-link :to="{ name: 'usuarios.edit', params: { id: usuario.id } }">
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
                usuario: {}
            }
        },
        mounted() {
            axios.get('/api/usuarios/' + this.$route.params.id)
            .then(response => this.usuario = response.data)
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
