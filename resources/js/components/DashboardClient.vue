<template>
    <div class="row">
        <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" v-for="(item, index) in rooms" :key="index">
                            <a @click="setRoomIndex(index)" class="nav-link" :class="{ 'active show' : roomIndex === index }" id="home-tab" data-toggle="tab" :href="'#'+item.key" role="tab">
                                {{ item.name }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div v-for="(item, index) in rooms" :key="index" class="tab-pane fade" :class="{ 'active show' : roomIndex === index }" :id="item.key" role="tabpanel" >
                            <div class="container p-4">
                                <div class="row">
                                    <div class="col-12 col-md-3 col-sm-3 mb-2" v-for="(table, index) in item.tables">
                                        <div @click="selectTable(index)" class="card card-absolute card-table" :class="table.class">
                                            <div class="card-body">
                                                <div class="row justify-content-end">
                                                    <h5 class="text-right"><strong>Mesa {{ table.name }}</strong></h5>
                                                </div>
                                                <div class="row mt-2">
                                                    <h6 class="text-left" style="width: 100%"><strong>{{ table.status_trans }}</strong></h6><br>
                                                </div>
                                                <div v-if="table.status === 'occupied' || table.status === 'ordered'">
                                                    <div  class="row">
                                                        <small v-if="table.last_service">{{ table.last_service.date }}</small>
                                                        <small v-if="!table.last_service">&nbsp;</small>
                                                    </div>
                                                    <div class="row justify-content-end mt-3">
                                                        <h6  v-if="table.last_service"  class="text-right"><strong>$ {{ table.last_service.total }}</strong></h6>
                                                        <h6  v-if="!table.last_service"  class="text-right">&nbsp;</h6>
                                                    </div>
                                                </div>
                                                <div v-if="table.status !== 'occupied' && table.status !== 'ordered'">
                                                    <div class="row">
                                                        <small>&nbsp;</small>
                                                    </div>
                                                    <div class="row justify-content-end mt-3">
                                                        <h6 class="text-right"><strong>&nbsp;</strong></h6>
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
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <h4 class="text-center">Selecciona una mesa</h4>
                    </div>
                </div>
                <div class="card-body">
                    <h4 v-if="table.name" class="text-center text-muted">Mesa {{ table.name }}</h4>
                    <div class="row" v-if="table.status == 'enabled'">
                        <div class="col-12 mb-2">
                            <button @click="changeStatusTable('reserved')" type="button" class="btn btn-sm btn-warning btn-block">
                                Cambiar a Reservada &nbsp;&nbsp;&nbsp;</button>
                        </div>
                        <div class="col-12 mb-2">
                            <button @click="changeStatusTable('disabled')" type="button" class="btn btn-sm btn-danger btn-block">
                                Cambiar a Fuera de Servicio</button>
                        </div>
                    </div>

                    <div class="row" v-if="table.status === 'disabled' || table.status === 'reserved'">
                        <div class="col-12 mb-2">
                            <button @click="changeStatusTable('enabled')" type="button" class="btn btn-sm btn-warning btn-block">Habilitar &nbsp;&nbsp;&nbsp;</button>
                        </div>
                    </div>

                    <div v-if="table.status === 'occupied' || table.status === 'ordered' || table.status === 'paying'">

                        <div class="row mb-3 pl-3 pr-3">
                            <button v-if="!isMoving && table.status !== 'paying'" @click="moveToAnotherTable" type="button" class="btn btn-sm btn-success btn-block">Cambiar de Mesa &nbsp;&nbsp;&nbsp;</button>
                            <button v-if="isMoving" @click="isMoving=false" type="button" class="btn btn-sm btn-warning btn-block">Cancelar Cambio &nbsp;&nbsp;&nbsp;</button>
                            <button v-if="table.status === 'paying'" @click="changeStatusTable('enabled')" type="button" class="btn btn-sm btn-warning btn-block">Finalizar Mesa &nbsp;&nbsp;&nbsp;</button>
                        </div>
                        <template v-if="table.last_service !== null">

                            <button v-if="!isMoving && table.status !== 'paying'" @click="createOrderToService" type="button" class="btn btn-sm btn-info btn-block mb-2">Agregar Producto</button>

                            <div  class="row"  v-for="(order, index) in table.last_service.orders">
                                <template v-if="order.details.length > 0">
                                    <h5>
                                        <strong>Orden {{ index + 1 }}</strong> &nbsp;&nbsp;&nbsp;
                                        <strong>
                                            <a target="_blank" :href="'/order/print/'+order.id" ><i style="cursor:pointer" class="fa fa-print"/></a>
                                        </strong>
                                    </h5>
                                    <table class="table" style="width: 100% !important">
                                        <thead>
                                        <tr>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(detail) in order.details">
                                            <td scope="row">{{ detail.quantity}} {{ detail.product.name}}</td>
                                            <td scope="row">$ {{ detail.price }}</td>
                                            <td scope="row">
                                                <button @click="editProduct(detail)" class="btn btn-sm btn-primary" style="padding: 5px 10px !important">
                                                    <i class="fa fa-edit"/></button>
                                                <button @click="removeProduct(order.id, detail.id)" class="btn btn-sm btn-danger" style="padding: 5px 10px !important">
                                                    <i class="fa fa-trash"/></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="text-align: right; font-weight: bold">Total : ${{ order.total}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </template>
                            </div>


                            <div v-if="table.status === 'paying'" class="row">
                                <h6>Propina: {{ table.last_service.payment.tip }}</h6>
                            </div>
                            <h3 style="text-align: center; font-weight: bold">Total ${{ table.last_service.total }}</h3>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="modalProduct">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <template v-if="detail !== null">
                            <div class="row">
                                <div class="col-3">
                                    <img :src="detail.product.full_image" style="max-width: 100%">
                                </div>
                                <div class="col-9">
                                    <h5 class="text-center">{{ detail.product.name }}</h5>
                                    <p>{{ detail.product.description }}</p>
                                    <h6> ${{ detail.product.price }}</h6>
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-6">
                                            <button @click="(detail.quantity <= 1) ? detail.quantity = 1  : detail.quantity-- " class="btn btn-pill btn-outline-warning" type="button" data-original-title="btn btn-pill btn-outline-warning" title="">
                                                <i class="fa fa-minus"/>
                                            </button>
                                            <button @click="detail.quantity++" class="btn btn-pill btn-outline-success" type="button" data-original-title="btn btn-pill btn-outline-warning" title="">
                                                <i class="fa fa-plus"/>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-center">Total</p>
                                            <h2 class="text-center"> {{ detail.quantity }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </template>
                    </div>
                    <div class="modal-footer">
                        <button @click="updateProduct" type="button" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="modalAddProduct">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Productos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <template>
                            <input type="text" class="form-control" v-model="searchTerm" placeholder="Ingresa el producto a buscar">
                        </template>
                        <template>
                            <div class="row">
                                <div class="col-md-4" v-for="(product, index) in productsFromSearch">
                                    <div @click="storeOrder(product)" class="card mt-2" style="cursor: pointer; border: 1px solid #6951FC">
                                        <div class="card-body p-1">
                                            <p class="text-center mb-0"><strong>{{ product.name }}</strong></p>
                                            <p class="mb-0" style="font-size: 10px !important;">{{ product.description }}</p>
                                            <h6> ${{ product.price }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        name: "DashboardClient",
        components: {
            Loading
        },
        data(){
            return {
                rooms : [],
                roomIndex : 0,
                tableIndex : null,
                table : {},
                isLoading: false,
                fullPage: true,
                isMoving : false,
                detail : null,
                searchTerm : '',
                productsFromSearch : []
            }
        },
        watch : {
            // cada vez que el termino de busca cambie, esta función será ejecutada
            searchTerm : function (newValue, oldValue) {
                this.debouncedGetSearch()
            }
        },
        methods:{
            async storeOrder(product){
                var result = await this.$swal({
                    title: 'Estas Seguro?',
                    text: "este producto se agregará a una orden",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Guardar!'
                });

                if(result.isConfirmed){
                    try {
                        var data = { "service_id" : this.table.last_service_id,
                            "products" : [
                                { "id" : product.id , "quantity" : 1},
                            ]
                        };
                        $("#modalAddProduct").modal("hide");
                        var response = await axios.post("api/order", data);
                        this.$swal('Guardado', 'Se ha guardado correctamente', 'success');
                        await this.getRoomsWithFullDataAsync();
                        this.selectTable(this.tableIndex);
                    }
                    catch (e) {
                        this.$swal({ icon: 'error', title: 'No se pudo eliminar', showConfirmButton: false, timer: 1500});
                    }
                }
            },
            async getSearch() {
                this.productsFromSearch = [];
                if (!this.isLoading){
                    this.isLoading = true;
                    try {
                        var url = "/product/search/"+this.searchTerm;
                        var response = await axios.get(url);
                        this.productsFromSearch = response.data;
                        this.isLoading = false;
                    }catch (e) {
                        this.isLoading = false;
                    }
                }
            },
            createOrderToService(){
                $("#modalAddProduct").modal("show");
            },
            editProduct(detail){
                console.log(detail);
                this.detail = JSON.parse(JSON.stringify(detail));
                $("#modalProduct").modal("show");
            },
            async updateProduct(){
                var vm = this;
                $("#modalProduct").modal("hide");
                try {
                    var response = await axios.post('/service/order/product/detail', {
                        "detail_id" : this.detail.id ,
                        "quantity" : this.detail.quantity
                    });
                    await this.getRoomsWithFullDataAsync();
                    this.selectTable(this.tableIndex);
                }catch (e) {}
            },
            async removeProduct(order_id, detail_id){
                var vm = this;

                var result = await this.$swal({
                    title: 'Estas Seguro?',
                    text: "No podras revertir esta acción",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                });

                if(result.isConfirmed){
                    try {
                        var response = await axios.post("/order/product/delete", { "order_id" : order_id , "detail_id" : detail_id });
                        this.$swal('Eliminado', 'Se ha eliminado correctamente', 'success');
                        await this.getRoomsWithFullDataAsync();
                        this.selectTable(this.tableIndex);
                    }
                    catch (e) {
                        this.$swal({ icon: 'error', title: 'No se pudo eliminar', showConfirmButton: false, timer: 1500});
                    }
                }
            },
            blinkTable(){
                this.rooms.forEach(function (room) {
                    room.tables.forEach(function (table) {
                        if (table.status == "ordered"){
                            if (table.class == "ordered"){
                                table.class = "ordered animated flash"
                            }else{
                                table.class = "ordered"
                            }
                        }
                    });
                });
            },
            getClassTable(item){
                return 'table-'+item.status;
            },
            setRoomIndex(index){
                this.roomIndex = index;
            },
            moveToAnotherTable(){
                this.isMoving = true;
                this.$swal('Seleccione una mesa libre');
            },
            selectTable(index){
                if (this.isMoving){
                    var selected_table = this.rooms[this.roomIndex].tables[index];

                    if (selected_table.status !== 'enabled'){
                        this.$swal('Seleccione una mesa libre');
                        return;
                    }

                    var vm = this;
                    var data = {
                        'table_to_move' : this.rooms[this.roomIndex].tables[index].id,
                        'table_id' : this.table.id,
                        "service_id" : this.table.last_service_id
                    };
                    vm.isLoading = true;
                    axios.post("/service/move/table", data).then(function (response) {
                        console.log(response);
                        vm.isMoving = false;
                        vm.isLoading = false;
                        vm.tableIndex = null;
                        vm.table = {};
                        vm.getRoomsWithFullData();
                    }).catch(function (error) {
                        vm.isLoading = false;
                        vm.isMoving = false;
                        vm.$swal('Error', 'No se pudo realizar el cambio de mesa', 'warning');
                    });
                }else{
                    this.tableIndex = index;
                    this.table = this.rooms[this.roomIndex].tables[this.tableIndex];
                    if (this.table.status == "ordered"){
                        this.table.status  = "occupied";
                        this.rooms[this.roomIndex].tables[index].class = "occupied";
                        this.table.status_trans = "Ocupada";
                        axios.post("/table/status", {'status' : "occupied", 'id' : this.table.id});
                    }
                }

            },
            changeStatusTable(status){
                var vm = this;
                axios.post("/table/status", {
                    'status' : status,
                    'id'     : vm.table.id
                }).then(function (response) {
                    vm.table = {};
                    vm.getRoomsWithFullData();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getRoomsWithFullData(){
                var vm = this;
                vm.isLoading = true;
                axios.get("/rooms/tables").then(function (response) {
                    vm.isLoading = false;
                    console.log(response.data);
                    vm.rooms = response.data;
                }).catch(function (error) {
                    console.log(error);
                    vm.isLoading = false;
                });
            },
            async getRoomsWithFullDataAsync(){
                this.isLoading = true;
                try {
                    const response = await axios.get("/rooms/tables");
                    this.isLoading = false;
                    this.rooms = response.data;
                    console.log("finish data async");
                } catch (error) {
                    console.error(error);
                    this.isLoading = false;
                }

            }
        },
        created() {
            this.getRoomsWithFullData();
            this.debouncedGetSearch = _.debounce(this.getSearch, 500);
        },
        mounted() {
            setInterval(this.blinkTable, 3000);
        }
    }
</script>

<style scoped>
    .nav-tabs .nav-link, .nav-tabs .nav-item .nav-link {
        font-size: 1.2em;
        color: gray !important;
    }
    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        color: black !important;
        background-color: #fff;
        border-color: #dee2e6 #dee2e6 #fff;
    }

    .card-absolute .card-header {
        position: absolute;
        top: -20px;
        margin-bottom: 30px;
        left: 15px;
        border-radius: 0.25rem;
        padding: 5px 15px;
    }

    .card-absolute .card-body {
        margin-top: 0px;
    }
    .card-table{
        border-radius: 10px !important;
        cursor: pointer;
    }

    .card .card-header {
        padding: 5px;
    }

    .card .card-body {
        padding: 10px 20px 5px;
        background-color: rgba(0,0,0,0);
    }

    .enabled{
        border: 1px solid #64dd17 !important;
    }
    .disabled{
        border: 2px solid #424242 !important;
        background-color: #d3d3d3;
    }
    .occupied{
        border: 3px solid #f44336 !important;
        /*background-color: rgba(201, 76, 76, 0.3) !important;*/
    }
    .ordered{
        border: 3px solid #7C45D8 !important;
    }
    .reserved{
        border: 3px solid #4e342e !important;
    }

    .paying{
        border: 3px solid #fdd835!important;
    }

    .animated {
        -webkit-animation-duration: 3s;
        animation-duration: 3s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }
    @-webkit-keyframes flash {
        0%, 50%, 100% {
            opacity: 1;
        }
        25%, 75% {
            opacity: 0;
        }
    }
    @keyframes flash {
        0%, 50%, 100% {
            opacity: 1;
        }
        25%, 75% {
            opacity: 0;
        }
    }
    .flash {
        -webkit-animation-name: flash;
        animation-name: flash;
    }
</style>
