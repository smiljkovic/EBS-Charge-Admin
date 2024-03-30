@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.brand_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('brand.index') !!}">{{trans('lang.brand_plural')}}</a>
                </li>
                <li class="breadcrumb-item active">{{ $id == ''? trans('lang.brand_create') :
                    trans('lang.brand_edit')}}
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
                            <legend>{{trans('lang.brand_details')}}</legend>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.name')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control name" >
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <div class="form-check">
                                    <input type="checkbox" class="brand_active" id="brand_active">
                                    <label class="col-3 control-label"
                                        for="brand_active">{{trans('lang.enable')}}</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  create_banner_btn"><i class="fa fa-save"></i> {{
                        trans('lang.save')}}
                    </button>
                    <a href="{!! route('brand.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
                        trans('lang.cancel')}}</a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    var database = firebase.firestore();
    var requestId = "{{$id}}";
    var id = (requestId == '') ? database.collection("tmp").doc().id : requestId;

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
                var ref = database.collection('vehicle_brand').where("id", "==", id);
                ref.get().then(async function (snapshots) {
                    var data = snapshots.docs[0].data();
                    $('.name').val(data.name);
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
        if (name == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.banner_name_error')}}</p>");
            window.scrollTo(0, 0);
        } 
        else {
            jQuery("#overlay").show();
                requestId == ''
                    ? (database.collection('vehicle_brand').doc(id).set({
                        'id': id,
                        'enable': enable,
                        'name': name,
                    }).then(function (result) {
                        window.location.href = '{{ route("brand.index")}}';
                    }).catch(function (error) {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + error + "</p>");
                    }))
                    : (database.collection('vehicle_brand').doc(id).update({
                        'enable': enable,
                        'name': name,
                    }).then(function (result) {
                        window.location.href = '{{ route("brand.index")}}';
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