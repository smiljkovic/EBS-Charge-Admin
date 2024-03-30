@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.model_plural')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{!! route('model.index') !!}">{{trans('lang.model_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $id == ''? trans('lang.model_create') :
                    trans('lang.model_edit')}}
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
                                <legend>{{trans('lang.model_details')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.name')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <input type="text" class="form-control name">
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.brand')}}</label>
                                    <div class="col-7">
                                        <select name="brand" class="form-control brand">
                                            <option value="">{{trans('lang.select')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <div class="form-check">
                                        <input type="checkbox" class="brand_active" id="brand_active">
                                        <label class="col-3 control-label"
                                               for="brand_active">{{trans('lang.enable')}}</label>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <div class="col-12">
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/car_model_1.png')}}"
                                                       value="{{asset('images/car_model_1.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/car_model_1.png')}}">
                                            </label>
                                        </div>
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/car_model_2.png')}}"
                                                       value="{{asset('images/car_model_2.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/car_model_2.png')}}">
                                            </label>
                                        </div>
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/car_model_3.png')}}"
                                                       value="{{asset('images/car_model_3.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/car_model_3.png')}}">
                                            </label>
                                        </div>
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/car_model_4.png')}}"
                                                       value="{{asset('images/car_model_4.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/car_model_4.png')}}">
                                            </label>
                                        </div>

                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/car_model_5.png')}}"
                                                       value="{{asset('images/car_model_5.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/car_model_5.png')}}">
                                            </label>
                                        </div>
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       dta-id="{{asset('images/car_model_6.png')}}"
                                                       value="{{asset('images/car_model_6.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/car_model_6.png')}}">
                                            </label>
                                        </div>
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/car_model_7.png')}}"
                                                       value="{{asset('images/car_model_7.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/car_model_7.png')}}">
                                            </label>
                                        </div>
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/car_model_8.png')}}"
                                                       value="{{asset('images/car_model_8.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/car_model_8.png')}}">
                                            </label>
                                        </div>
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/bike_model_1.png')}}"
                                                       value="{{asset('images/bike_model_1.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/bike_model_1.png')}}">
                                            </label>
                                        </div>
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/bike_model_2.png')}}"
                                                       value="{{asset('images/bike_model_2.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/bike_model_2.png')}}">
                                            </label>
                                        </div>
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/bike_model_3.png')}}"
                                                       value="{{asset('images/bike_model_3.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/bike_model_3.png')}}">
                                            </label>
                                        </div>
                                        <div class="select-theme-radio">
                                            <label class="form-check-label">
                                                <input type="radio" name="model_image" class="image model_image"
                                                       data-id="{{asset('images/bike_model_4.png')}}"
                                                       value="{{asset('images/bike_model_4.png')}}">
                                                <img height="100px" width="100px"
                                                     src="{{asset('images/bike_model_4.png')}}">
                                            </label>
                                        </div>


                                    </div>
                                </div>

                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group col-12 text-center btm-btn">
                        <button type="button" class="btn btn-primary  create_banner_btn"><i class="fa fa-save"></i> {{
                        trans('lang.save')}}
                        </button>
                        <a href="{!! route('model.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
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

        ref.get().then(async function (snapshots) {
            snapshots.docs.forEach((listval) => {
                var data = listval.data();

                $('.brand').append($("<option></option>")
                    .attr("value", data.id)
                    .text(data.name));
            });
            $('.brand').select2();
        });

        $(document).ready(function () {
            $('.vehicle_sub_menu li').each(function () {
                $('.vehicle_sub_menu li').each(function () {
                    var url = $(this).find('a').attr('href');
                    if (url == document.referrer) {
                        $(this).find('a').addClass('active');
                        $('.brand_menu').addClass('active').attr('aria-expanded', true);
                    }
                    $('.vehicle_sub_menu').addClass('in').attr('aria-expanded', true);
                });
                if (requestId != '') {
                    jQuery("#overlay").show();
                    var ref = database.collection('vehicle_model').where("id", "==", id);
                    ref.get().then(async function (snapshots) {
                        var data = snapshots.docs[0].data();
                        $('.name').val(data.name);
                        $('.brand').val(data.brandId).trigger('change');
                        $('input:radio[value="' + data.image + '"]').prop('checked', true);
                        if (data.enable) {
                            $('.brand_active').prop('checked', true);
                        }
                        jQuery("#overlay").hide();
                    })
                }
            });
        });

        $(".create_banner_btn").click(function () {

            var enable = $(".brand_active").is(':checked') ? true : false;
            var name = $(".name").val();
            var brand = $(".brand").val();
            var image = $('.model_image:checked').val();
            if (name == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.model_name_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (brand == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.brand_error')}}</p>");
                window.scrollTo(0, 0);

            } else if (image == '' || image == undefined) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.model_image_error')}}</p>");
                window.scrollTo(0, 0);

            } else {
                jQuery("#overlay").show();
                requestId == ''
                    ? (database.collection('vehicle_model').doc(id).set({
                        'id': id,
                        'enable': enable,
                        'name': name,
                        'brandId': brand,
                        'image': image
                    }).then(function (result) {
                        window.location.href = '{{ route("model.index")}}';
                    }).catch(function (error) {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + error + "</p>");
                    }))
                    : (database.collection('vehicle_model').doc(id).update({
                        'enable': enable,
                        'name': name,
                        'brandId': brand,
                        'image': image
                    }).then(function (result) {
                        window.location.href = '{{ route("model.index")}}';
                    }).catch(function (error) {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + error + "</p>");
                    }))
            }
        });
    </script>
@endsection
