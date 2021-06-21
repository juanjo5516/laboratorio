<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-12">
                        <h1>Usuarios</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <router-link class="btn btn-primary" :to="{ name: 'usuarios.create' }">Agregar</router-link>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover" v-if="usuarios.length > 0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Correo electrónico</th>
                                            <th scope="col">Rol</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="usuario in usuarios">
                                            <th scope="row">{{ usuario.id }}</th>
                                            <td>{{ usuario.name }}</td>
                                            <td>{{ usuario.email }}</td>
                                            <td>
                                                <span class="badge" v-bind:class="{ 'badge-success': usuario.role_id == 1,  'badge-secondary': usuario.role_id == 2  }">
                                                    {{ usuario.role_id == 1 ? 'Administrador' : 'Operador' }}
                                                </span>
                                            </td>
                                            <td>
                                                <router-link :to="{ name: 'usuarios.show', params: { id: usuario.id } }">
                                                    Detalle
                                                </router-link>
                                                <router-link :to="{ name: 'usuarios.edit', params: { id: usuario.id } }">
                                                    Modificar
                                                </router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <blockquote class="quote-primary m-0" v-else>
                                    <h4>No hay registros</h4>
                                    Ningún usuario ha sido registrado
                                </blockquote>
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
</div>
</template>

<script>
    export default {
        data() {
            return {
                usuarios: []
            }
        },
        mounted() {
            axios.get('/api/usuarios')
            .then(response => {
                this.usuarios = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>
