$(document).ready(function(){

    $image_crop = $('#image_result').croppie({
        enableExif: true,
        viewport: {
            width:200,
            height:200,
            type:'square' //circle
        },
        boundary:{
            width:200,
            height:200
        },
        enableOrientation : true,
        enableResize : true
    });

    $('#upload_image').on('change', function(){
        var reader = new FileReader();
        reader.onload = function (event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function(){
                console.log('jQuery bind complete');
            });
        };
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
