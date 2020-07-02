<div class="card">
    <div class="card-header cardHeader">
        <a href="{{ route('category.create') }}" class="btn btn-primary text-white" type="button">
            <i class="fa fa-plus"></i>&nbsp;{{ __("Agregar Nuevo") }}
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="display datatable">
                <thead>
                <tr>
                    <th>{{ __('Nombre') }}</th>
                    <th>{{ __('Acciones') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="{{ route('category.edit', $item) }}" class="btn btn-pill btn-info text-white"  data-toggle="tooltip" title="" data-original-title="{{ __("Editar") }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn btn-pill btn-danger text-white destroy-reload"  data-toggle="tooltip" title="" data-original-title="{{ __("Eliminar") }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
