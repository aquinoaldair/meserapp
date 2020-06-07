<div class="card mt-4 p-4">
    <h4 class="text-center">{{ $title }}</h4>
    <form class="theme-form" method="POST" action="{{ $route }}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-form-label">{{ __("Nombre del commercio") }}</label>
                    <input class="form-control" type="text" name="name"  value="{{ old('name') }}" required>
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
                                    <option {{  old('prefix_phone') ? ( old('prefix_phone') == $item->phone_code ? "selected": "" )  : ""}} value="{{ $item->phone_code }}">{{ $item->name }} (+{{ $item->phone_code }})</option>
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
                            <input class="form-control" type="text"  value="{{ old('phone_number') }}" name="phone_number" required>
                            @error('phone_number')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label">{{ __("Email") }}</label>
                    <input class="form-control" type="text" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="col-6 col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">{{ __("Contraseña") }}</label>
                            <input class="form-control" type="password" name="password" required>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">{{ __("Confirmar contraseña") }}</label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label">{{ __("Logotipo") }}</label>
                    <input class="form-control" type="file" name="logo" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-form-label">{{ __("Imagen Principal") }}</label>
                    <input class="form-control" type="file" name="first_image" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label">{{ __("Imagen Secundaria") }}</label>
                    <input class="form-control" type="file" name="second_image" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label">{{ __("Dirección") }}</label>
                    <input class="form-control" type="text" name="address" id="autocomplete" placeholder="{{ __("Ingresa tu dirección") }}" autocomplete="new_address" required>
                    <input type="hidden" id="txtLat" name="latitude">
                    <input type="hidden" id="txtLng" name="longitude">
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
            <div class="form-row">
                @if ($register)
                    <div class="col-sm-4">
                        <button class="btn btn-primary" type="submit">{{ __("Registrar") }}</button>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-left mt-2 m-l-20">{{ __("Ya tienes un usuario ?") }} <a class="btn-link text-capitalize" href="{{ route('login') }}">{{ __("Login") }}</a></div>
                    </div>
                @else
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp; {{ __("Guardar") }}</button>
                        <a class="btn btn-secondary text-white" href="{{ route('commerce.index') }}" ><i class="fa fa-mail-reply"></i>&nbsp;{{ __("Cancelar") }}</a>
                    </div>
                @endif

            </div>
        </div>
    </form>
</div>
