<template>
    <div>
       <div class="row">
           <div class="col-9">
              <div class="card" id="rooms">
                  <div class="card-header">
                      <button class="btn btn-secondary" @click="newRoom"><i class="fa fa-plus"></i> Nueva Sala</button>
                  </div>
                  <div class="card-body">
                      <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item" v-for="(item, index) in rooms" :key="index">
                              <a class="nav-link" :class="{ 'active show' : index === 0 }" id="home-tab" data-toggle="tab" :href="'#'+item.key" role="tab">
                                  {{ item.name }}
                              </a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <div v-for="(item, index) in rooms" :key="index" class="tab-pane fade" :class="{ 'active show' : index === 0 }" :id="item.key" role="tabpanel" >
                              <div class="container p-4">
                                  <div class="row">
                                      <div class="col-2" v-for="(child, index) in item.tables">
                                          <button class="btn btn-lg btn-success">
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
           <div class="col-3">
               <div class="card" id="card_details">
                   <div class="card-header">
                       <div class="card-header">
                           <button class="btn btn-secondary" @click="newTable"><i class="fa fa-plus"></i> Nueva Mesa</button>
                       </div>
                   </div>
                   <div class="card-body">

                   </div>
               </div>
           </div>
       </div>
    </div>
</template>

<script>
    export default {
        name: "Table",
        data(){
            return {
                rooms : [],
                isNewRoom : false,
                isNewTable : false
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
            newRoom(){
                this.isNewRoom = true;
                this.isNewTable = false;
            },
            newTable(){
                this.isNewTable = true;
                this.isNewRoom = false;
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
    }

    .btn-lg{
        min-height: 50px;
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
</style>
