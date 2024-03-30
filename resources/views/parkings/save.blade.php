@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.parking_plural')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{!! route('parking-list') !!}">{{trans('lang.parking_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $id == ''? trans('lang.parking_create') :
                    trans('lang.parking_edit')}}
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
                                <legend>{{trans('lang.parking_details')}}</legend>
                                @if($id=='')
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.user')}}<span
                                                class="required-field"></span></label>
                                        <div class="col-7">
                                            <select class="form-control user">
                                                <option value=''>{{trans("lang.select_user")}}</option>
                                            </select>
                                        </div>
                                    </div>

                                @endif
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
                                    <label class="col-3 control-label">{{trans('lang.address')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control location" id="location"
                                               autocomplete="on">
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.parking_for')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <select class="form-control type" id="type">
                                            <option value="">{{trans("lang.select_parking_type")}}</option>
                                            <option value="4">{{trans("lang.four_wheel")}}</option>
                                            <option value="2">{{trans("lang.two_wheel")}}</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.description')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <textarea rows=5 class="form-control description" id="description"></textarea>
                                    </div>
                                </div>


                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.price')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="number" class="form-control price" id="price">
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.parking_space')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="number" class="form-control space" id="space">
                                    </div>
                                </div>


                                <div class="form-group row width-50">
                                    <div class="form-check">
                                        <input type="checkbox" class="active" id="active">
                                        <label class="col-3 control-label" for="active">{{trans('lang.enable')}}</label>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.parking_facilities')}}</label>
                                    <div class="facilities"></div>
                                </div>


                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group col-12 text-center btm-btn">
                        <button type="button" class="btn btn-primary  create_parking_btn"><i class="fa fa-save"></i> {{
                        trans('lang.save')}}
                        </button>
                        <a href="{!! route('parking-list') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
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
        var ref = database.collection('facilities');
        var storageRef = firebase.storage().ref('images');
        var storage = firebase.storage();
        var photo = "";
        var fileName = "";
        var userImageFile = '';
        var placeholderImage = "{{ asset('/images/default_user.png') }}";
        var googleMapkey = '';

        ref.get().then(async function (snapshots) {
            checkbox = '';
            snapshots.docs.forEach((listval) => {
                var data = listval.data();
                checkbox = checkbox + '<div class="form-check width-100"><input type="checkbox" name="parking_facility" class="parking_facility" id="' + data.id + '" data-name="' + data.name + '" data-image="' + data.image + '" data-enable="' + data.isEnable + '"><label class="col-3 control-label" for="' + data.id + '" >' + data.name + '</label></div>';
            })
            $('.facilities').html(checkbox);
        });
        database.collection('users').get().then(async function (snapshot) {
            snapshot.docs.forEach((listval) => {
                var data = listval.data();
                $('.user').append($("<option></option>")
                    .attr("value", data.id)
                    .text(data.fullName));
            })
            $('.user').select2();
        })
        $(document).ready(function () {
            if (requestId != '') {
                jQuery("#overlay").show();
                var ref = database.collection('parkings').where("id", "==", id);
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
                    $('.location').val(data.address).attr('lat', data.location.latitude).attr('lng', data.location.longitude);
                    $('.description').val(data.description);
                    $('.space').val(data.parkingSpace);
                    $('.type').val(data.parkingType);
                    $('.price').val(data.perHrPrice);
                    if (data.facilities) {
                        for (var i = 0; i < data.facilities.length; i++) {
                            val = data.facilities[i];
                            $('#' + val.id).prop('checked', true);
                        }
                    }

                    jQuery("#overlay").hide();
                })
            }
        });

        function initialize() {

            var input = document.getElementById('location');
            autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                latitude = parseFloat(place.geometry.location.lat());
                longitude = parseFloat(place.geometry.location.lng());

                $("#location").val(place.formatted_address).attr('lat', latitude).attr('lng', longitude);

            });
        }

        $(".create_parking_btn").click(function () {

            var enable = $(".active").is(':checked') ? true : false;
            var name = $(".name").val();
            var address = $('.location').val();
            var lat = parseFloat($('.location').attr('lat'));
            var long = parseFloat($('.location').attr('lng'));
            var location = {'latitude': lat, 'longitude': long};
            var description = $('.description').val();
            var parkingSpace = $('.space').val();
            var parkingPrice = $('.price').val();
            var parkingType = $('.type').val();
            var facilities = [];
            var bookmarkedUser = [];
            var userId = $('.user').val();
            var checkboxes = document.getElementsByClassName('parking_facility');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    fName = checkboxes[i].dataset.name;
                    fImage = checkboxes[i].dataset.image;
                    fIsEnable = checkboxes[i].dataset.enable;
                    if (fIsEnable == "true") {
                        fIsEnable = true;
                    } else {
                        fIsEnable = false;
                    }
                    fId = checkboxes[i].id;
                    val = {'name': fName, 'image': fImage, 'isEnable': fIsEnable, 'id': fId};
                    facilities.push(val);

                }
            }
            if (name == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.parking_name_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (requestId == '' && userId == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.select_user')}}</p>");
                window.scrollTo(0, 0);

            } else if (address == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.parking_address_error')}}</p>");
                window.scrollTo(0, 0);

            } else if (description == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.parking_description_error')}}</p>");
                window.scrollTo(0, 0);

            } else if (parkingSpace == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.parking_space_error')}}</p>");
                window.scrollTo(0, 0);

            } else if (parkingType == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.parking_type_error')}}</p>");
                window.scrollTo(0, 0);

            } else if (parkingPrice == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.parking_price_error')}}</p>");
                window.scrollTo(0, 0);

            } else {

                jQuery("#overlay").show();
                requestId == ''
                    ? storeImageData().then(IMG => {
                        geoFirestore.collection('parkings').doc(id).set({
                            'id': id,
                            'isEnable': enable,
                            'name': name,
                            'image': IMG,
                            'address': address,
                            coordinates: new firebase.firestore.GeoPoint(lat, long),
                            'location': location,
                            'description': description,
                            'facilities': facilities,
                            'parkingSpace': parkingSpace,
                            'parkingType': parkingType,
                            'perHrPrice': parkingPrice,
                            'reviewCount': '0.0',
                            'reviewSum': '0.0',
                            'userId': userId,
                            'bookmarkedUser': bookmarkedUser
                        }).then(function (result) {

                            updatePositionKey(id);

                        }).catch(function (error) {
                            jQuery("#overlay").hide();
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>" + error + "</p>");
                        })
                    })
                    : storeImageData().then(IMG => {
                        geoFirestore.collection('parkings').doc(id).update({
                            'isEnable': enable,
                            'name': name,
                            'image': IMG,
                            coordinates: new firebase.firestore.GeoPoint(lat, long),
                            'address': address,
                            'location': location,
                            'description': description,
                            'facilities': facilities,
                            'parkingSpace': parkingSpace,
                            'parkingType': parkingType,
                            'perHrPrice': parkingPrice,

                        }).then(function (result) {

                            updatePositionKey(id);

                        }).catch(function (error) {
                            jQuery("#overlay").hide();
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>" + error + "</p>");
                        })
                    })
            }
        });

        async function updatePositionKey(id) {

            var docRef = geoFirestore.collection('parkings').where("id", "==", id);

            await docRef.get().then(async function (snapshots) {
                var data = snapshots.docs[0].data();
                const newPositionData = data.g;

                database.collection('parkings').doc(data.id).update({
                    position: newPositionData,
                    g: firebase.firestore.FieldValue.delete(),
                    coordinates: firebase.firestore.FieldValue.delete(),
                })
                    .then(() => {
                        window.location.href = '{{ route("parking-list")}}';
                    }).catch((error) => {
                    console.error("Error updating document:", error);
                });

            });

        }

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
