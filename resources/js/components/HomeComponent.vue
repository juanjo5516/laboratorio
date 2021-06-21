<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb2">
                    <div class="col-1">
                        <h1>Tablero</h1>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <select class="form-control" v-on:change="getData" v-model="currentMonth">
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Importe de compras contra presupuesto</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class="text-success">
                                            {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(totalPresupuesto) }}
                                        </span>
                                        <span class="text-muted">Presupuesto</span>
                                    </p>
                                </div>
                                <div class="position-relative mb-4 text-center">
                                    <v-gauge :value="x" unit="%" :options="options"/>
                                    Total compras: <strong>{{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(totalCompra) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Importe de pagos contra compras</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class="text-success">
                                            {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(totalCompra) }}
                                        </span>
                                        <span class="text-muted">Compras</span>
                                    </p>
                                </div>
                                <div class="position-relative mb-4 text-center">
                                    <v-gauge :value="y" unit="%" :options="options2"/>
                                    Total compras: <strong>{{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(totalCompra) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Distribución de compras por proveedor</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">
                                            {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(totalCompra) }}
                                        </span>
                                        <span>
                                            Total compras
                                        </span>
                                    </p>
                                </div>
                                <pie-chart :data="data1" v-if="topProveedores.length != 0"></pie-chart>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Distribución de compras por importe en el mes
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">
                                            {{ Intl.NumberFormat("es-GT", { style: "currency", currency: "GTQ" }).format(totalCompra) }}
                                        </span>
                                        <span>
                                            Total compras
                                        </span>
                                    </p>
                                </div>
                                <pie-chart :data="data2" v-if="rangos.length != 0"></pie-chart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VGauge from 'vgauge';
    import PieChart from './PieChart.vue';

    export default {
        data() {
            return {
                currentMonth: null,
                totalPresupuesto: null,
                totalCompra: null,
                totalPagos: null,
                topProveedores: [],
                rangos: [],
                data1: {
                    labels: [],
                    datasets: [
                    {
                        label: 'Proveedores',
                        backgroundColor: [
                        "#41B883",
                        "#E46651",
                        "#66a30a",
                        "#0a59a3",
                        "#8f0aa3",
                        "#a3470a",
                        '#a3150a',
                        '#a30a7d',
                        '#6f3e63',
                        '#23f62a'
                        ],
                        data: [],
                        showLine: true
                    }]
                },
                data2: {
                    labels: [],
                    datasets: [
                    {
                        backgroundColor: ["#41B883", "#E46651", "#66a30a", "#0a59a3", "#8f0aa3"],
                        data: [],
                        showLine: true
                    }]
                },
                x: 0,
                y: 0,
                options: {
                    angle: 0.15,
                    lineWidth: 0.44,
                    radiusScale: 1,
                    pointer: {
                        length: 0.6,
                        strokeWidth: 0.035,
                        color: "#000000"
                    },
                    limitMax: true,
                    limitMin: true,
                    colorStart: "#6FADCF",
                    colorStop: "#8FC0DA",
                    strokeColor: "#E0E0E0",
                    generateGradient: true,
                    highDpiSupport: true,
                    percentColors: [
                    [0.0, '#a9d70b' ],
                    [0.2, '#67fa11' ],
                    [0.50, '#f9c802'],
                    [1.0, '#ff0000']
                    ],
                    staticLabels: {
                        font: "10px sans-serif",
                        labels: [0,100],
                        color: "#000000",
                        fractionDigits: 0
                    }
                },
                options2: {
                    angle: 0.15,
                    lineWidth: 0.44,
                    radiusScale: 1,
                    pointer: {
                        length: 0.6,
                        strokeWidth: 0.035,
                        color: "#000000"
                    },
                    limitMax: true,
                    limitMin: true,
                    colorStart: "#6FADCF",
                    colorStop: "#8FC0DA",
                    strokeColor: "#E0E0E0",
                    generateGradient: true,
                    highDpiSupport: true,
                    percentColors: [
                    [0.0, '#ff0000'],
                    [0.20, '#f9c802'],
                    [0.50, '#67fa11' ],
                    [1.00, '#a9d70b' ],
                    ],
                    staticLabels: {
                        font: "10px sans-serif",
                        labels: [0,100],
                        color: "#000000",
                        fractionDigits: 0
                    }
                }
            }
        },
        components: {
            VGauge,
            PieChart
        },
        mounted() {
            this.currentMonth = new Date().getMonth() + 1;

            this.getData()
        },
        methods: {
            getData() {
                Promise.all([
                    axios.get('/api/presupuestos/1/mes/' + this.currentMonth),
                    axios.get('/api/compras-vs-presupuesto', {
                        params: {
                            mes: this.currentMonth
                        }
                    }),
                    axios.get('/api/pagos-vs-compras', {
                        params: {
                            mes: this.currentMonth
                        }
                    }),
                    axios.get('/api/top-10-compras', {
                        params: {
                            mes: this.currentMonth
                        }
                    }),
                    axios.get('/api/rangos', {
                        params: {
                            mes: this.currentMonth
                        }
                    })
                    ])
                .then(response => {
                    this.totalPresupuesto = parseFloat(response[0].data.monto)
                    this.totalCompra = parseFloat(response[1].data)
                    this.totalPagos = parseFloat(response[2].data)
                    this.topProveedores = response[3].data
                    this.rangos = response[4].data
                    this.x = ( this.totalCompra / this.totalPresupuesto) * 100;
                    this.y += (this.totalPagos / this.totalCompra) * 100;

                    this.data1.labels = [];
                    this.data1.datasets[0].data = [];

                    this.topProveedores.forEach(top => {
                        this.data1.labels.push(top.proveedor);
                        this.data1.datasets[0].data.push(top.total);
                    })

                    this.data2.labels = [];
                    this.data2.datasets[0].data = [];
                    this.rangos.forEach(r => {
                        this.data2.labels.push(r.rango);
                        this.data2.datasets[0].data.push(r.total);
                    })

                })
                .catch(error => {

                })
            }
        }
    }
</script>
