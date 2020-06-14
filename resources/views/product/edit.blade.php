@extends('layouts.master')

@section('title',  __(\App\Models\Product::NAME))
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/photoswipe.css')}}">
<link rel="stylesheet" href="{{ asset('assets/js/croppie/croppie.min.css') }}">
@section('style')

@endsection

@section('breadcrumb-title',  __(\App\Models\Product::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __(\App\Models\Product::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __('Editar') }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-sm-12 col-xl-8">
                <div class="card">
                    <form action="{{ route('product.update', $product) }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-xl-6">
                                    <div class="form-group">
                                        <label>{{ __('Nombre') }}</label>
                                        <input required type="text" name="name" class="form-control" value="{{ old('name') ?? $product->name }}">
                                        @error('name')
                                        <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>{{ __('Administrar Stock') }}</label>
                                            <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                <div class="radio radio-primary">
                                                    <input id="radioinline1"  type="radio" {{ $product->use_stock ? "checked" : "" }} name="use_stock" value="1" required>
                                                    <label class="mb-0" for="radioinline1"><span class="digits">{{ __("Si") }}</span></label>
                                                </div>
                                                <div class="radio radio-primary">
                                                    <input id="radioinline2" type="radio" {{ $product->use_stock ? "" : "checked" }} name="use_stock" value="0" required>
                                                    <label class="mb-0" for="radioinline2"><span class="digits">{{ __("No") }}</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ __('Cantidad') }}</label>
                                                <input required type="number" name="stock" class="form-control" value="{{ old('stock') ?? $product->stock}}">
                                                @error('stock')
                                                <p class="text-danger text-sm"> {{ $errors->first('stock') }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ __('Margen') }}</label>
                                                <input required type="text" name="margin" class="form-control" value="{{ old('margin') ?? $product->margin }}">
                                                @error('margin')
                                                <p class="text-danger text-sm"> {{ $errors->first('margin') }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ __('Precio') }}</label>
                                                <input required type="number" name="price" class="form-control" step='0.001' value="{{ old('price') ?? $product->price}}" placeholder='0.000'>
                                                @error('price')
                                                <p class="text-danger text-sm"> {{ $errors->first('price') }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="row">
                                           <div class="col-12 col-md-6">
                                               <label>{{ __('Categoria') }}</label>
                                               <select name="category_id" class="form-control">
                                                   @foreach($categories as $category)
                                                       <option
                                                           {{ ( old('category_id') || $product->category_id) == $category->id ? "selected" : '' }}


                                                           value="{{ $category->id }}">{{ $category->name }}</option>
                                                   @endforeach
                                               </select>
                                               @error('category_id')
                                               <p class="text-danger text-sm"> {{ $errors->first('category_id') }}</p>
                                               @enderror
                                           </div>
                                           <div class="col-12 col-md-6">
                                               <label>{{ __('Estaciones de preparado') }}</label>
                                               <select name="station_id" class="form-control">
                                                   @foreach($stations as $item)
                                                       <option
                                                           {{ ( old('station_id') || $product->station_id) == $item->id ? "selected" : '' }}
                                                           value="{{ $item->id }}">{{ $item->name }}</option>
                                                   @endforeach
                                               </select>
                                               @error('station_id')
                                               <p class="text-danger text-sm"> {{ $errors->first('station_id') }}</p>
                                               @enderror
                                           </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Descripción') }}</label>
                                        <input required type="text" name="description" value="{{ old('description') ?? $product->description }}" class="form-control">
                                        @error('description')
                                        <p class="text-danger text-sm"> {{ $errors->first('description') }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form-group">
                                        @error('file_gallery')
                                        <p class="text-danger text-sm"> {{ $errors->first('file_gallery') }}</p>
                                        @enderror
                                        @error('file_device')
                                        <p class="text-danger text-sm"> {{ $errors->first('file_device') }}</p>
                                        @enderror
                                        <label>{{ __('Seleccionar Imagen') }} <small>({{ __("No es necesario si requieres actualizar unicamente los datos") }})</small></label>
                                        <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active show" id="icon-home-tab" data-toggle="tab" href="#icon-home" role="tab" aria-controls="icon-home" aria-selected="true" data-original-title="" title="">
                                                    <i class="icofont icofont-ui-folder"></i>{{ __("Dispositivo") }}</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" id="profile-icon-tab" data-toggle="tab" href="#profile-icon" role="tab" aria-controls="profile-icon" aria-selected="false" data-original-title="" title="">
                                                    <i class="icofont icofont-ui-image"></i>{{ __("Galeria") }}</a></li>
                                        </ul>
                                        <div class="tab-content p-3" id="icon-tabContent">
                                            <div class="tab-pane fade active show" id="icon-home" role="tabpanel" aria-labelledby="icon-home-tab">
                                                <input type="file"  id="upload_image"  class="form-control">
                                                <input type="hidden" id="file_device" name="file_device">
                                                <input type="hidden" id="file_gallery" name="file_gallery" value="">
                                                <img src="" alt="" id="result">
                                            </div>
                                            <div class="tab-pane fade" id="profile-icon" role="tabpanel" aria-labelledby="profile-icon-tab">
                                                <search-product></search-product>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp; {{ __("Guardar") }}</button>
                            <a class="btn btn-secondary text-white" href="{{ route('product.index') }}" ><i class="fa fa-mail-reply"></i>&nbsp;{{ __("Cancelar") }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <div id="uploadimageModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar tamaño de imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 text-center">
                            <div id="image_demo" style="width:350px; margin-top:30px"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary crop_image">{{ __("Aceptar") }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Cerrar") }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/isotope.pkgd.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
    <script src="{{asset('assets/js/chat-menu.js')}}"></script>
    <script src="{{asset('assets/js/masonry-gallery.js')}}"></script>
    <script src="{{ asset('assets/js/croppie/croppie.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function(){

            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width:200,
                    height:200,
                    type:'square' //circle
                },
                boundary:{
                    width:300,
                    height:300
                },
                enableOrientation : true
            });

            $('#upload_image').on('change', function(){
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });

            $('.crop_image').click(function(event){
                $image_crop.croppie('result', {
                    type: 'rawcanvas',
                    size: 'viewport'
                }).then(function(response){
                    $('#uploadimageModal').modal('hide');
                    $('#file_device').val(response.toDataURL());
                    $("#result").attr("src", response.toDataURL());
                })
            });

        });
    </script>
@endsection
