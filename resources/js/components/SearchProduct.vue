<template>
    <div>
        <notifications group="message" position="top center" />

        <input type="text" class="form-control" v-model="searchTerm" placeholder="Ingresa el producto a buscar">

        <div v-if="searching" class="p-4">
            <p>Buscando ...</p>
        </div>
        <div v-if="!searching">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-2"  v-for="item in items">
                        <img :src="'/storage/' + item.image"
                             @click="setImage(item.image)"
                             style="max-width: 100%" alt=""
                             :class="{ 'figure-selected': (item.image === imageSelected)  }"
                        >
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
                searchTerm: "",
                searching : false,
                items : [],
                imageSelected : ''
            }
        },
        watch : {
            // cada vez que el termino de busca cambie, esta función será ejecutada
            searchTerm : function (newValue, oldValue) {
                this.debouncedGetSearch()
            }
        },
        created() {
            //esto es para que a los 5 milisegundos de que el usuario deje de escribir se ejecute el evento
            this.debouncedGetSearch = _.debounce(this.getSearch, 500)
        },
        methods: {
            setImage : function(value){
                this.$notify({
                    group: 'message',
                    title: 'Seleccionado',
                    text: 'Se ha seleccionado correctamente',
                    type: 'success'
                });

                this.imageSelected = value;

                $("#file_gallery").val(value);
            },
            getSearch: function () {
                console.log("se ejecuto la busqueda");



                if (this.searchText == ""){ return; }

                this.searching = true;
                var url = "/images/search/"+this.searchTerm;
                var vm = this;
                axios.get(url).then(function (response) {
                    vm.items = response.data;
                    console.log(response.data);
                    vm.searching = false;
                    vm.imageSelected = ""
                }).catch(function (error) {
                    vm.searching = false;
                    vm.items = [];
                    vm.imageSelected = ""
                });

            }
        }
    }
</script>

<style scoped>
    a{
        cursor: pointer;
    }

    .figure-selected{
        border: 3px solid darkseagreen !important;
    }
</style>
