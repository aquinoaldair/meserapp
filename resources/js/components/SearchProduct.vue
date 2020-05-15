<template>
    <div>
        <notifications group="message" position="top center" />

        <input type="text" class="form-control" v-model="searchTerm" placeholder="Ingresa el producto a buscar">

        <div v-if="searching" class="p-4">
            <p>Buscando ...</p>
        </div>
        <div v-if="!searching">
            <div class="card-body photoswipe-pb-responsive">
                <div class="my-gallery row grid gallery" id="aniimated-thumbnials" itemscope="">
                    <figure  v-for="item in items" class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                        <a  itemprop="contentUrl" data-size="1600x950" @click="setImage(item.image)">
                            <img class="img-thumbnail" v-bind:class="{ 'figure-selected': (item.image === imageSelected)  }" v-bind:src="'/storage/' + item.image"  itemprop="thumbnail" alt="Image description"></a>
                    </figure>

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
        border: 1px solid darkseagreen !important;
    }
</style>
