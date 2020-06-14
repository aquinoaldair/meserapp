@extends('layouts.master')

@section('title',  __('Comercios'))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
@endsection

@section('breadcrumb-title',  __('Comercios'))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('commerce.index') }}">{{ __('Comercios') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Editar') }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-10">
                <x-form-update-commerce title="Actualizar" route="{{ route('profile.update') }}"  :commerce="$commerce"></x-form-update-commerce>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.es.js')}}"></script>

    <script>

        var placeSearch, autocomplete;

        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        var map;

        var markers = [];

        var input = document.getElementById('autocomplete');

        function initMap() {
            var lat = @json($commerce->latitude);
            var lng = @json($commerce->longitude);



            var map = new google.maps.Map(document.getElementById('map'), {
                center: (lat != null) ?  {lat: Number(lat), lng: Number(lng)} :   {lat: -33.8688, lng: 151.2195},
                zoom: 13,
                mapTypeId: 'roadmap'
            });



            if(lat && lng) {
                var myLatLng = {lat: Number(lat), lng: Number(lng)};

                var vMarker = new google.maps.Marker({
                    map: map,
                    position: myLatLng,
                    draggable: true,
                });

                google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                    setLatLng(evt.latLng.lat().toFixed(6), evt.latLng.lng().toFixed(6));
                    map.panTo(evt.latLng);
                });

                markers.push(vMarker);
            }


            var searchBox = new google.maps.places.SearchBox(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });


            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    setLatLng(place.geometry.location.lat().toFixed(6),place.geometry.location.lng().toFixed(6));

                    // Create a marker for each place.

                    var vMarker = new google.maps.Marker({
                        map: map,
                        title: place.name,
                        position: place.geometry.location,
                        draggable: true,
                    });

                    markers.push(vMarker);

                    google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                        setLatLng(evt.latLng.lat().toFixed(6), evt.latLng.lng().toFixed(6));
                        map.panTo(evt.latLng);
                    });


                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }


        function setLatLng(lat, lng){
            var input_lat = document.getElementById("txtLat");
            var input_lng = document.getElementById("txtLng");
            input_lat.setAttribute('value', lat);
            input_lng.setAttribute('value', lng);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();

            console.log(place);
        }


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('meserapp.google_api_key') }}&libraries=places&callback=initMap" async defer></script>
@endsection
