<template>
    <div>
       <div class="row">
           <div class="col-md-8">
              <div class="card" id="rooms">
                  <div class="card-header">
                      <button class="btn btn-secondary" @click="newRoom"><i class="fa fa-plus"></i> Nueva Sala</button>
                  </div>
                  <div class="card-body">
                      <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item" v-for="(item, index) in rooms" :key="index">
                              <a @click="setRoomIndex(index)" class="nav-link" :class="{ 'active show' : roomIndex === index }" id="home-tab" data-toggle="tab" :href="'#'+item.key" role="tab">
                                  {{ item.name }}
                              </a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <h5 v-if="showTextTable" class="text-center text-muted mt-3">Seleccione una mesa para editar</h5>
                          <div v-for="(item, index) in rooms" :key="index" class="tab-pane fade" :class="{ 'active show' : roomIndex === index }" :id="item.key" role="tabpanel" >
                              <div class="container p-4">
                                  <div class="row">
                                      <div class="col-3 col-md-2 mb-2" v-for="(child, index) in item.tables">
                                          <button @click="setTableIndex(child,index)" class="btn btn-lg btn-success">
                                              {{ child.name }}
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
           </div>
           <div class="col-md-4">
               <div class="card" id="card_details">
                   <div class="card-header">
                       <div class="row align-content-center" v-if="actualRoom && !isNewRoom" >
                           <div class="col-8">
                               <h4 class="pl-2">{{ actualRoom.name }}</h4>
                           </div>
                           <div class="col-4">
                               <button @click="editRoom" type="button" class="btnIconEdit">
                                   <i class="fa fa-edit"/>
                               </button>
                               <button @click="removeRoom" type="button" class="btnIconDelete">
                                   <i class="fa fa-trash"/>
                               </button>
                           </div>
                       </div>
                   </div>
                   <div class="card-body">
                       <form @submit="storeRoom" v-if="showFormRoom">
                           <h5 class="text-center">{{ (isNewRoom) ? "Nueva Sala" : "Editar Sala"}}</h5>
                           <div class="form-group">
                               <label>Nombre</label>
                               <input v-model="room.name" required type="text" name="name" class="form-control">
                           </div>
                           <div class="row">
                               <div class="col-10 col-md-6">
                                   <button class="btn btn-sm btn-success" type="submit">
                                       <i class="fa fa-check"/>&nbsp;{{ (isNewRoom) ? "Guardar" : "Guardar"}}
                                   </button>
                               </div>
                               <div class="col-6 col-md-6">
                                   <button @click="setDefaultAllValues" class="btn btn-sm btn-warning" type="button">
                                       <i class="fa fa-mail-reply"/>&nbsp;Cancelar
                                   </button>
                               </div>
                           </div>
                       </form>

                       <form @submit="storeTable" v-if="showFormTable">
                           <h5 class="text-center">{{ isEditingTable ? "Editar" : "Nueva" }} Mesa</h5>
                           <div class="form-group">
                               <label>Numero</label>
                               <input v-model="table.name" required type="number" name="name" class="form-control">
                           </div>
                           <div class="row">
                               <div class="col-10">
                                   <button class="btn btn-sm btn-success btn-padding" type="submit">
                                       <i class="fa fa-check"/>&nbsp;{{ isEditingTable ? "Guardar" : "Guardar" }}
                                   </button>
                                   <button  class="btn btn-sm btn-warning btn-padding" v-if="isEditingTable" @click="setDefaultAllValues" type="button">
                                       <i class="fa fa-mail-reply"/>&nbsp;Cancelar
                                   </button>
                               </div>
                               <div class="col-2">
                                   <button @click="deleteTable" v-if="isEditingTable" class="btn btn-sm btn-danger btn-padding" type="button">
                                       <i class="fa fa-trash"/>
                                   </button>
                               </div>
                           </div>
                           <div  v-if="isEditingTable" class="form-group" style="text-align: center; margin-top: 10px">
                               <qrcode :value="qr" :options="{ width: 200 }"/>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
    </div>
</template>

<script>
    export default {
        name: "Table",
        props: ['roomStore', 'roomDelete', 'roomUpdate', 'tableStore', 'tableDelete', 'tableUpdate', 'tableQr'],
        data(){
            return {
                rooms : [],
                isNewRoom : false,
                isNewTable : false,
                isEditingRoom : false,
                isEditingTable : false,
                room : {},
                table : {},
                roomIndex : 0,
                tableIndex : 0
            }
        },
        computed : {
            actualRoom : function() {
                return this.rooms[this.roomIndex];
            },
            showFormTable : function () {
                return (!this.isNewRoom && !this.isEditingRoom && (this.isNewTable || this.isEditingTable || this.rooms.length ) );
            },
            showFormRoom : function () {
                return (this.isNewRoom || this.isEditingRoom);
            },
            showTextTable : function () {
                return this.rooms.length > 0;
            },
            qr : function () {
                return this.tableQr.replace(':qr', this.table.key);
            }
        },
        mounted() {
            var vm = this;

            axios.get("/rooms").then(function (response) {
                vm.rooms = response.data;
            }).catch(function (error) {
                console.log(error);
            });
        },
        methods:{
            deleteTable(){
                var table = this.table;
                var route = this.tableDelete.replace(":table", table.key);
                route = route.replace(":room", this.rooms[this.roomIndex].key);

                var vm = this;

                vm.$swal({
                    title: 'Estas Seguro?',
                    text: "No podras revertir esta acción",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete(route).then(function (response) {
                            console.log(response);
                            vm.$swal(
                                'Eliminado',
                                'Se ha eliminado correctamente',
                                'success'
                            );
                            //vm.rooms.splice(vm.roomIndex, 1);
                            vm.rooms[vm.roomIndex].tables.splice(vm.tableIndex, 1);
                            vm.setDefaultAllValues();
                        }).catch(function (error) {
                            console.log(error);
                            vm.$swal({
                                icon: 'error',
                                title: 'No se pudo guardar',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        });
                    }
                })

            },
            setTableIndex(table, index){
                this.setDefaultAllValues();
                this.isEditingTable = true;
                this.tableIndex = index;
                this.table = JSON.parse(JSON.stringify(table));
            },
            updateTable(){
                var table = this.table;
                var route = this.tableUpdate.replace(":table", table.key);
                route = route.replace(":room", this.rooms[this.roomIndex].key);

                var vm = this;

                axios.put(route, { 'name' : table.name }).then(function (response) {
                    vm.$swal({
                        icon: 'success',
                        title: 'Guardado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    vm.rooms[vm.roomIndex].tables[vm.tableIndex].name = table.name;

                    vm.setDefaultAllValues();

                }).catch(function (error) {

                    console.log(error);
                    vm.$swal({
                        icon: 'error',
                        title: 'No se pudo guardar',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });

            },
            storeTable(e){
                e.preventDefault();
                var vm = this;

                if (this.isEditingTable){
                    this.updateTable();
                }else{
                    var room = this.rooms[this.roomIndex];
                    var route = this.tableStore.replace(":room", room.key);

                    axios.post(route, this.table).then(function (response) {

                        vm.rooms[vm.roomIndex].tables.push(response.data);

                        vm.table = {};

                        vm.$swal({
                            icon: 'success',
                            title: 'Guardado correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        vm.setDefaultAllValues();

                    }).catch(function (error) {
                        console.log(error);
                        vm.$swal({
                            icon: 'error',
                            title: 'No se pudo guardar',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });

                }
            },
            setRoomIndex(index){
                this.roomIndex = index;
            },
            newRoom(){
                this.isNewRoom = true;
                this.isNewTable = false;
            },
            newTable(){
                this.isNewTable = true;
                this.isNewRoom = false;
            },
            editRoom(){
                this.isEditingRoom = true;
                this.room = JSON.parse(JSON.stringify(this.actualRoom));
            },
            updateRoom(){
                var route = this.roomDelete.replace(":key", this.actualRoom.key);
                var vm = this;
                axios.put(route, this.room).then(function (response) {
                    vm.$swal({
                        icon: 'success',
                        title: 'Guardado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    vm.rooms =  response.data;
                    vm.setDefaultAllValues();
                }).catch(function (error) {
                    vm.$swal({
                        icon: 'error',
                        title: 'No se pudo guardar',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            },
            storeRoom(e){
                e.preventDefault();

                var vm = this;

                if (this.isEditingRoom){
                    this.updateRoom()
                }else{
                    axios.post(this.roomStore, this.room).then(function (response) {
                        vm.$swal({
                            icon: 'success',
                            title: 'Guardado correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        vm.rooms =  response.data;
                        vm.setDefaultAllValues();
                    }).catch(function (error) {
                        vm.$swal({
                            icon: 'error',
                            title: 'No se pudo guardar',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                }


            },
            removeRoom(){
                var route = this.roomDelete.replace(":key", this.actualRoom.key);
                var vm = this;
                vm.$swal({
                    title: 'Estas Seguro?',
                    text: "No podras revertir esta acción",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete(route).then(function (response) {
                            vm.$swal(
                                'Eliminado',
                                'Se ha eliminado correctamente',
                                'success'
                            );
                            vm.rooms.splice(vm.roomIndex, 1);
                            vm.roomIndex = 0;
                        }).catch(function (error) {
                            vm.$swal({
                                icon: 'error',
                                title: 'No se pudo guardar',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        });
                    }
                })
            },
            setDefaultValuesRoom(){
                this.isNewRoom = false;
                this.isEditingRoom = false;
                this.room = {};
            },
            setDefaultValuesTable(){
                this.isNewTable= false;
                this.isEditingTable = false;
                this.table = {};
            },
            setDefaultAllValues(){
                this.setDefaultValuesRoom();
                this.setDefaultValuesTable();
            }

        }
    }
</script>

<style scoped>
    .nav-link{
        margin-right: 10px;
        background-color: #555555;
        color: white;
        font-size: 1.1em;
        margin-bottom: 5px;
    }

    .btn-lg{
    }

    .card{
        min-height: 400px;
    }

    .card .card-header{
        padding: 5px;
    }

    #rooms{
        background-color: #FAFAFA;
    }
    #card_details{
        background-color: #F6F6F6;
    }

    #card_details .card-header h4{
        color:  #555555;
    }

    .btnIconDelete, .btnIconEdit{
        padding: 5px 10px;
        background-color: #EA5356;
        color: white;
        border: 0px;
        border-radius: 5px;
        cursor: pointer;
    }
    .btnIconEdit{
        background-color: #4466F2;
    }

    .btn-padding{
        padding: 10px !important;
    }
</style>
