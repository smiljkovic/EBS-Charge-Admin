@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('users') !!}">{{trans('lang.user_plural')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.user_edit')}}</li>
                </ol>
            </div>

        </div>
        <div class="container-fluid">
            <div class="card pb-4">
                <div class="card-body">

                    <div id="data-table_processing" class="dataTables_processing panel panel-default"
                         style="display: none;">{{trans('lang.processing')}}</div>

                    <div class="row daes-top-sec mb-3">

                    </div>

                    <div class="error_top"></div>
                    <div class="row restaurant_payout_create">
                        <div class="restaurant_payout_create-inner">

                            <fieldset>
                                <legend>{{trans('lang.user_details')}}</legend>
                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_name')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_name">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_name_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.email')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_email">
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_email_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50" id="phone-box">
                                    <label class="col-3 control-label">{{trans('lang.country_code')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <select name="country" id="country_selector" class="form-control country_code">
                                            <option value="">{{ trans("lang.user_country_code_help") }}</option>
                                            @foreach($countries_data as $country)
                                                <option value="{{$country->phoneCode}}">{{$country->countryName}}
                                                    (+{{$country->phoneCode}})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-text text-muted">
                                            {{ trans("lang.user_country_code_help") }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_phone')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_phone">
                                        <div class="form-text text-muted w-50">
                                            {{ trans("lang.user_phone_help") }}
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_dob')}}</label>
                                    <div class="col-7">
                                        <input type="date" class="form-control user_dob">
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_gender')}}</label>
                                    <div class="col-7">
                                        <input type="radio" class="form-control" name="gender" id="Male" value="Male">
                                        <label for="Male">Male</label>
                                        <input type="radio" class="form-control" name="gender" id="Female"
                                               value="Female">
                                        <label for="Female">Female</label>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                                    <input type="file" onChange="handleFileSelect(event)" class="col-7" id="userImage">
                                    <div class="placeholder_img_thumb user_image"></div>
                                    <div id="uploding_image"></div>
                                </div>
                            </fieldset>

                            <fieldset class="owner_bank_details d-none">
                                <legend>{{trans('lang.bank_details')}}</legend>
                                <div class="form-group row width-100">
                                    <label class="col-4 control-label">{{trans('lang.bank_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" name="bank_name" class="form-control bank_name"
                                               id="bankName">
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-4 control-label">{{trans('lang.branch_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" name="branch_name" class="form-control branch_name"
                                               id="branchName">
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-4 control-label">{{trans('lang.holder_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" name="holer_name" class="form-control holder_name"
                                               id="holderName">
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-4 control-label">{{trans('lang.account_number')}}</label>
                                    <div class="col-7">
                                        <input type="text" name="account_number" class="form-control account_number"
                                               id="accountNumber">
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-4 control-label">{{trans('lang.other_information')}}</label>
                                    <div class="col-7">
                                        <input type="text" name="other_information" class="form-control other_info"
                                               id="otherDetails">
                                    </div>
                                </div>

                            </fieldset>


                        </div>
                    </div>
                </div>
                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  save_user_btn"><i
                            class="fa fa-save"></i> {{ trans('lang.save')}}</button>
                    <a href="{!! route('users') !!}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        var id = "<?php echo $id;?>";
        var database = firebase.firestore();
        var ref = database.collection('users').where("id", "==", id);
        var currentCurrency = '';
        var currencyAtRight = false;
        var decimal_degits = 0;

        var storageRef = firebase.storage().ref('images');
        var storage = firebase.storage();
        var photo = "";
        var fileName = "";
        var userImageFile = '';
        var placeholderImage = "{{ asset('/images/default_user.png') }}";

        var append_list = '';
        var bankRef = database.collection('bank_details').where("userId", "==", id);
        bankRef.get().then(async function (snapshots) {

            if (snapshots.docs.length > 0) {
                var bankData = snapshots.docs[0].data();
                $('.bank_name').val(bankData.bankName);
                $('.branch_name').val(bankData.branchName);
                $('.holder_name').val(bankData.holderName);
                $('.account_number').val(bankData.accountNumber);
                $('.other_info').val(bankData.otherInformation);
            }
        });
        var user_role = null;


        $(document).ready(function () {

            $('.user_menu').addClass('active');

            jQuery("#overlay").show();

            ref.get().then(async function (snapshots) {
                var user = snapshots.docs[0].data();
                $(".user_name").val(user.fullName);
                $(".user_email").val(user.email);
                $(".user_phone").val(user.phoneNumber);

                user_role = user.role;
                if (user.role && user.role == "owner") {
                    $('.owner_bank_details').removeClass('d-none');
                }
                if (user.dateOfBirth != null && user.dateOfBirth != "") {

                    var today = new Date(user.dateOfBirth);
                    var dd = today.getDate();
                    var mm = today.getMonth() + 1; //January is 0!

                    var yyyy = today.getFullYear();
                    if (dd < 10) {
                        dd = '0' + dd
                    }
                    if (mm < 10) {
                        mm = '0' + mm
                    }
                    today = yyyy + '-' + mm + '-' + dd;

                    $(".user_dob").attr('value', today);
                }
                if (user.gender == "Male") {
                    $("#Male").prop('checked', true);
                } else if (user.gender == "Female") {
                    $("#Female").prop('checked', true);
                }

                $(".country_code option[value='" + (user.countryCode.includes('+') ? user.countryCode.slice(1) : user.countryCode) + "']").attr("selected", "selected");
                if (user.profilePic == '' || user.profilePic == null) {
                    $(".user_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image">');
                } else {
                    photo = user.profilePic;
                    userImageFile = user.profilePic;
                    $(".user_image").append('<span class="image-item"><span class="remove-btn"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + user.profilePic + '" alt="image">');
                }
                jQuery("#overlay").hide();
            })

        });

        $(".save_user_btn").click(async function () {

            var name = $(".user_name").val();
            var email = $(".user_email").val();
            var userPhone = $(".user_phone").val();
            var userCountryCode = $(".country_code :selected").val();


            var userGender = $("input[name=gender]:checked").val();

            if (userGender == undefined) {
                userGender = null;
            }
            var user_dob = $(".user_dob").val();

            var userDob = null;
            if (user_dob && user_dob != undefined) {
                userDob = new Date(user_dob).toLocaleString('en-us', {
                    month: 'long',
                    year: 'numeric',
                    day: 'numeric'
                });
            }

            if (name == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_name_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (email == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_email_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (userPhone == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_phone_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (userCountryCode == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_country_code_error')}}</p>");
                window.scrollTo(0, 0);
            } else {
                jQuery("#overlay").show();
                await storeImageData().then(IMG => {
                    database.collection('users').doc(id).update({
                        'fullName': name,
                        'email': email,
                        'phoneNumber': userPhone,
                        'profilePic': IMG,
                        'countryCode': '+' + userCountryCode,
                        'dateOfBirth': userDob,
                        'gender': userGender,
                    }).then(function (result) {
                        if (user_role == "owner") {
                            addBankDetails();
                        } else {
                            window.location.href = '{{ route("users")}}';
                        }
                    })
                }).catch(err => {
                    jQuery("#overlay").hide();
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + err + "</p>");
                    window.scrollTo(0, 0);
                });
            }
        })


        async function addBankDetails() {
            var bankName = $('.bank_name').val();
            var branchName = $('.branch_name').val();
            var holderName = $('.holder_name').val();
            var accountNumber = $('.account_number').val();
            var otherInfo = $('.other_info').val();

            await bankRef.get().then(async function (snapshots) {
                if (snapshots.docs.length > 0) {
                    database.collection('bank_details').doc(id).update({
                        'bankName': bankName,
                        'branchName': branchName,
                        'holderName': holderName,
                        'accountNumber': accountNumber,
                        'otherInformation': otherInfo
                    }).then(function (result) {

                        window.location.href = '{{ route("users")}}';

                    })
                } else {
                    database.collection('bank_details').doc(id).set({
                        'bankName': bankName,
                        'branchName': branchName,
                        'holderName': holderName,
                        'accountNumber': accountNumber,
                        'otherInformation': otherInfo,
                        'userId': id
                    }).then(function (result) {

                        window.location.href = '{{ route("users")}}';

                    })
                }
            })

        }

        async function storeImageData() {
            var newPhoto = '';
            try {
                if (userImageFile != "" && photo != userImageFile) {
                    var userOldImageUrlRef = await storage.refFromURL(userImageFile);
                    await userOldImageUrlRef.delete().then(() => {

                    }).catch((error) => {

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
