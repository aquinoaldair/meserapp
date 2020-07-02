<template>
    <div>
        <div class="row mb-2">
            <button @click="openModal" type="button" class="btn btn-success btn-block">Subir Archivo</button>
        </div>
        <div class="row mt-2" style="margin-top: 10px">
            <img class="result" style="max-width: 100%" :src="resultURL" alt="">
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="modalImage">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Selecciona una imagen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a class="btn btn-success">
                            <clipper-upload v-model="imgURL">Seleccionar Imagen</clipper-upload>
                        </a>
                        <clipper-basic :ratio="1" class="my-clipper" ref="clipper" :src="imgURL">
                        </clipper-basic>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="getResult">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "ImageCrop",
        data() {
            return {
                imgURL: '',
                resultURL: '',
                isOpening : false
            }
        },
        methods: {
            openModal : function () {
                this.isOpening = true;
                $('#modalImage').modal('show');
            },
            getResult: function () {
                const canvas = this.$refs.clipper.clip();//call component's clip method
                this.resultURL = canvas.toDataURL("image/jpeg", 1);//canvas->image
                $('#file_device').val(this.resultURL);
                $('#modalImage').modal('hide');
            }
        }
    }
</script>

<style scoped>
    .my-clipper {
        width: 100%;
    }
    button.title{
        color: white !important;
    }
</style>
