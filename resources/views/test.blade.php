<html lang="en">

<head>
    <title>Crop Image Before Upload Using Croppie.js in Laravel 9</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

</head>


<body>
    <div class="container" style="margin-top:30px;">
        <div class="panel panel-primary">
            <div class="panel-heading">Crop Image Before Upload Using Croppie.js in Laravel 9</div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-4 text-center" style="padding-top:30px;">
                      <div id="upload-input" style="width:350px; height: 400px;"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                      <strong>Select Image:</strong>
                      <br/>
                      <input type="file" id="upload">
                      <br/>
                      <button class="btn btn-success upload-result">Upload Image</button>
                    </div>
                    <div class="col-md-4" >
                      <div id="uploaded-input" style="background:#e1e1e1;width:300px;padding:30px;height:300px;margin-top:30px">
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>

    <script type="text/javascript">
        $(function() {
            // Start upload,crop,preview image - croppie plugin
            // by Darpan, 19 May 2022
            var $uploadCrop,
                tempFilename,
                rawImg,
                imageId;

            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.upload-demo').addClass('ready');
                        $('#cropImagePop').modal('show');
                        rawImg = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                    input.value = null;
                } else {
                    console.log("Sorry - you're browser doesn't support the FileReader API");
                }
            }

            $uploadCrop = $('#upload-input').croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'circle'
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });


            $('#upload').on('change', function () {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });

                }
                reader.readAsDataURL(this.files[0]);
            });

            $uploadCrop = $('#upload-input').croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'circle'
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });

            $uploadCrop = $('#upload-demo3243').croppie({
                viewport: {
                    width: 105,
                    height: 105,
                    type: 'circle'
                },
                enforceBoundary: false,
                enableExif: true
            });

            $('#upload').on('change', function () {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });

                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#cropImagePop').on('shown.bs.modal', function() {
                $uploadCrop.croppie('bind', {
                    url: rawImg
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            });

            $('.item-img').on('change', function() {
                imageId = $(this).data('id');
                tempFilename = $(this).val();
                $('#cancelCropBtn').data('id', imageId);
                readFile(this);
            });

            $('#cropImageBtn').on('click', function(ev) {
                $uploadCrop.croppie('result', {
                    type: 'base64',
                    format: 'png',
                    size: {
                        width: 105,
                        height: 105
                    }
                }).then(function(resp) {
                    var id = $('#user_id').val();

                    //upload image
                    $.ajax({
                        type: 'POST',
                        url: update_profile_picture,
                        data: {
                            'id': id,
                            'image': resp
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.success) {
                                $('#preview-profile-image').attr('src', resp);
                                $('#cropImagePop').modal('hide');
                                toastr.success(data.success);
                            } else if (data.error) {
                                toastr.error(data.error);
                            }
                        }
                    });
                });
            });
            // End upload preview image

            // file trigger using anchor tag
            // by Darpan, 19 May 2022
            $('.edit_profile_img').on('click', function(ev) {
                ev.preventDefault();
                $("#h_file:file").trigger('click');
            });
        });
    </script>

</body>

</html>
