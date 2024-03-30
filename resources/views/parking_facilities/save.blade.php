@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.facility_plural')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{!! route('parking-facilities') !!}">{{trans('lang.facility_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $id == ''? trans('lang.facilties_create') :
                    trans('lang.facilties_edit')}}
                    </li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card pb-4">

                <div class="card-body">

                    <div class="error_top"></div>

                    <div class="row restaurant_payout_create">
                        <div class="restaurant_payout_create-inner">
                            <fieldset>
                                <legend>{{trans('lang.facility_details')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.name')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control name">
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.image')}}</label>
                                    <div class="col-7">
                                        <input type="file" name="image" class="form-control image"
                                               onChange="handleFileSelect(event)" id="userImage">
                                        <div class="placeholder_img_thumb user_image"></div>
                                        <div id="uploding_image"></div>

                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <div class="form-check">
                                        <input type="checkbox" class="active" id="active">
                                        <label class="col-3 control-label" for="active">{{trans('lang.enable')}}</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group col-12 text-center btm-btn">
                        <button type="button" class="btn btn-primary  create_facility_btn"><i class="fa fa-save"></i> {{
                        trans('lang.save')}}
                        </button>
                        <a href="{!! route('parking-facilities') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
                        trans('lang.cancel')}}</a>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        var database = firebase.firestore();
        var requestId = "{{$id}}";
        var id = (requestId == '') ? database.collection("tmp").doc().id : requestId;
        var ref = database.collection('vehicle_brand');
        var storageRef = firebase.storage().ref('images');
        var storage = firebase.storage();
        var photo = "";
        var fileName = "";
        var userImageFile = '';
        var placeholderImage = "{{ asset('/images/default_user.png') }}";

        ref.get().then(async function (snapshots) {
            snapshots.docs.forEach((listval) => {
                var data = listval.data();

                $('.brand').append($("<option></option>")
                    .attr("value", data.id)
                    .text(data.name));
            })
            $('.brand').select2();
        });

        $(document).ready(function () {
            if (requestId != '') {
                jQuery("#overlay").show();
                var ref = database.collection('facilities').where("id", "==", id);
                ref.get().then(async function (snapshots) {
                    var data = snapshots.docs[0].data();
                    $('.name').val(data.name);
                    if (data.image == '' || data.image == null) {
                        $(".user_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image">');
                    } else {
                        photo = data.image;
                        userImageFile = data.image;
                        $(".user_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + data.image + '" alt="image">');
                    }

                    if (data.isEnable) {
                        $('.active').prop('checked', true);
                    }
                    jQuery("#overlay").hide();
                })
            }
        });


        $(".create_facility_btn").click(function () {

            var enable = $(".active").is(':checked') ? true : false;
            var name = $(".name").val();
            if (name == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.facility_error')}}</p>");
                window.scrollTo(0, 0);
            } else {
                jQuery("#overlay").show();
                requestId == ''
                    ? storeImageData().then(IMG => {
                        database.collection('facilities').doc(id).set({
                            'id': id,
                            'isEnable': enable,
                            'name': name,
                            'image': IMG
                        }).then(function (result) {
                            window.location.href = '{{ route("parking-facilities")}}';
                        }).catch(function (error) {
                            jQuery("#overlay").hide();
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>" + error + "</p>");
                        })
                    })
                    : storeImageData().then(IMG => {
                        database.collection('facilities').doc(id).update({
                            'isEnable': enable,
                            'name': name,
                            'image': IMG
                        }).then(function (result) {
                            window.location.href = '{{ route("parking-facilities")}}';
                        }).catch(function (error) {
                            jQuery("#overlay").hide();
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>" + error + "</p>");
                        })
                    })
            }
        });

        async function storeImageData() {
            var newPhoto = '';
            try {
                if (userImageFile != "" && photo != userImageFile) {
                    var userOldImageUrlRef = await storage.refFromURL(userImageFile);
                    await userOldImageUrlRef.delete().then(() => {
                        console.log("Old file deleted!")
                    }).catch((error) => {
                        console.log("ERR File delete ===", error);
                    });
                }
                if (photo != userImageFile) {
                    photo = photo.replace(/^data:image\/[a-z]+;base64,/, "")
                    var uploadTask = await storageRef.child(fileName).putString(photo, 'base64', {contentType: 'image/jpg'});
                    var downloadURL = await uploadTask.ref.getDownloadURL();
                    newPhoto = downloadURL;
                    photo = downloadURL;
                } else {
                    newPhoto = photo;
                }
            } catch (error) {
                console.log("ERR ===", error);
            }
            return newPhoto;
        }

        function handleFileSelect(evt) {
            var f = evt.target.files[0];
            var reader = new FileReader();
            reader.onload = (function (theFile) {

                return function (e) {

                    var filePayload = e.target.result;
                    var val = f.name;
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = (f.name).replace(/C:\\fakepath\\/i, '')
                    var timestamp = Number(new Date());
                    var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                    photo = filePayload;
                    fileName = filename;
                    $(".user_image").empty();
                    $(".user_image").append('<span class="image-item" id="photo_user"><span class="remove-btn" data-id="user-remove" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + photo + '" alt="image"></span>');

                };
            })(f);
            reader.readAsDataURL(f);
        }

        $(document).on("click", ".remove-btn", function () {
            $(".image-item").remove();
            $('#userImage').val('');
        });

    </script>
@endsection
