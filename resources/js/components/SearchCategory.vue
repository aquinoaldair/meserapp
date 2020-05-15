<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="text-center text-muted">Seleccionar Categorias Generales</h6>
            </div>
            <div class="row">
                <div v-for="(item, index) in items" class="col-6 col-md-3 col-lg-3 text-center p-1">
                    <div class="col d-flex justify-content-center">
                        <img v-bind:src="'/storage/' + item.image" alt="" class="img-fluid" style="height: 100px !important;">
                    </div>
                    <div class="row justify-content-center">
                        <h6 class="text-muted text-center">{{ item.name }}</h6>
                    </div>
                    <div>
                        <button type="button" @click="addCategory(item.id, index)" class="btn btn-success btn-sm">Agregar</button>
                    </div>
                </div>


            </div>
        </div>

    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Search Category Mounted');
        },
        data() {
            return {
                items: []
            }
        },
        methods: {
            addCategory : function (id, index) {

                var vm = this;

                axios.post("/category/customer/create", { id : id}).then(function (response) {
                    vm.$swal({
                        icon: 'success',
                        title: 'Guardado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    vm.items.splice(index,1);
                }).catch(function (error) {
                    vm.$swal({
                        icon: 'error',
                        title: 'No se pudo guardar la categoria',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            }
        },
        created : function () {
            var vm = this;
            axios.get("/category/general").then(function (response) {
                vm.items = response.data;
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
</script>

<style scoped>

</style>
