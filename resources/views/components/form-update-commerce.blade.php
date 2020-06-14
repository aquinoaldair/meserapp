<div class="card">
    <form action="{{ $route }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">{{ __("Nombre del Comercio") }}</label>
                        <input class="form-control" type="text" name="name"  value="{{ old('name') ?? $commerce->name }}" required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="col-4 col-md-5">
                            <div class="form-group">
                                <label class="col-form-label">{{ __("País") }}</label>
                                <select class="form-control mb-1" name="prefix_phone" required>
                                    @foreach(\Aquinoaldair\PhoneCode\PhoneCode::get() as $item)
                                        <option {{
                                                    old('prefix_phone')
                                                            ? ( old('prefix_phone') == $item->phone_code ? "selected": "" )
                                                            : ($commerce->prefix_phone == $item->phone_code ) ? "selected" : '' }}

                                                value="{{ $item->phone_code }}">{{ $item->name }} (+{{ $item->phone_code }})</option>
                                    @endforeach
                                </select>
                                @error('prefix_phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-8 col-md-7">
                            <div class="form-group">
                                <label class="col-form-label">{{ __("Telefono") }}</label>
                                <input class="form-control" type="text"  value="{{ old('phone_number') ?? $commerce->phone_number }}" name="phone_number" required>
                                @error('phone_number')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">{{ __("Email") }}</label>
                        <input class="form-control" type="text" name="email" value="{{ old('email') ?? $commerce->user->email }}" required>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-form-label">{{ __("Contraseña") }}</label>
                                <input class="form-control" type="password" name="password">
                                <small>La contraseña no sera modificada al menos que se ingrese una nueva</small>
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">{{ __("Tipo de negocio") }}</label>
                        <input class="form-control" type="text" name="type" value="{{ old('type') ?? $commerce->type }}" required>
                        @error('type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">{{ __("Descripción") }}</label>
                        <textarea class="form-control" name="description">{{ old('description') ?? $commerce->description }}</textarea>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">{{ __("Logotipo") }}</label>
                        <input class="form-control" type="file" name="logo">
                        <small>{{ __("El logotipo no sera modificada al menos que se ingrese una nueva") }}</small>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">{{ __("Imagen Principal") }}</label>
                        <input class="form-control" type="file" name="first_image">
                        <small>{{ __("La imagen no sera modificada al menos que se ingrese una nueva") }}</small>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">{{ __("Imagen Secundaria") }}</label>
                        <input class="form-control" type="file" name="second_image">
                        <small>{{ __("La imagen no sera modificada al menos que se ingrese una nueva") }}</small>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">{{ __("Dirección") }}</label>
                        <input class="form-control" type="text" name="address" value="{{ $commerce->address }}" id="autocomplete" placeholder="{{ __("Ingresa tu dirección") }}" autocomplete="new_address" required>
                        <input type="hidden" id="txtLat" name="latitude" value="{{ $commerce->latitude }}">
                        <input type="hidden" id="txtLng" name="longitude" value="{{ $commerce->longitude }}">
                    </div>
                    <div class="form-group">
                        <div style="border: 0px solid red; width: 100%; height: 100% !important;">
                            <div id="map" style="min-height: 250px; height: 100% !important; width: 100%"></div>
                        </div>
                        @error('latitude')
                        <small class="text-danger">{{ __("Es necesario la ubicacion de la dirección en el mapa") }}</small>
                        @enderror
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp {{ __("Guardar") }}</button>
            <a class="btn btn-secondary text-white" href="{{ route('commerce.index') }}" ><i class="fa fa-mail-reply"></i>&nbsp;{{ __("Cancelar") }}</a>
        </div>
    </form>
</div>
