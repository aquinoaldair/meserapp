<div class="card">
    <div class="card-header cardHeader">
        <a href="{{ route('product.create') }}" class="btn btn-primary text-white" type="button">
            <i class="fa fa-plus"></i>&nbsp;{{ __("Agregar Nuevo") }}
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach($categories as $category)
                        <a class="nav-link {{ $loop->index == 0 ? "active show" : "" }}" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-{{$category->id}}" role="tab" aria-controls="v-pills-home" aria-selected="false" data-original-title="" title="">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-9 col-xs-12">
                <div class="tab-content" id="v-pills-tabContent">
                    @foreach($categories as $category)
                        <div class="tab-pane fade {{ $loop->index == 0 ? "active show" : "" }}" id="v-pills-{{ $category->id }}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="table-responsive">
                                <table class="display datatable">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('Precio') }}</th>
                                        <th>{{ __('Imagen') }}</th>
                                        <th>{{ __('Stock') }}</th>
                                        <th>{{ __("Margen") }}</th>
                                        <th>{{ __('Acciones') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($category->products as $item)
                                        <tr data-id="{{ $item->id }}">
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                @if ($item->image)
                                                    <a href="{{ asset('storage/'.$item->image) }}" target="_blank">
                                                        <img src="{{ asset('storage/'.$item->image) }}" alt="" style="width: 30px; height: 30px">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $item->stock }}</td>
                                            <td>{{ $item->margin }}</td>
                                            <td>
                                                <a href="{{ route('product.edit', $item) }}" class="btn btn-pill btn-info text-white"  data-toggle="tooltip" title="" data-original-title="{{ __("Editar") }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-pill btn-danger text-white destroy"  data-toggle="tooltip" title="" data-original-title="{{ __("Eliminar") }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
