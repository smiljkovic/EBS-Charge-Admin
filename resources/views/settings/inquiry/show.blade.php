@extends('layouts.app')


@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.inquiry_detail')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('settings.inquiry')}}">{{trans('lang.inquiry')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.inquiry_detail')}}</li>
                </ol>
            </div>
            <div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="user-detail">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="col-group">
                                            <label for="" class="font-weight-bold">{{trans('lang.name')}}:</label>
                                            <span class="name"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="col-group">
                                            <label for="" class="font-weight-bold">{{trans('lang.user_phone')}}:</label>
                                            <span class="phone"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="col-group">
                                            <label for="" class="font-weight-bold">{{trans('lang.email')}}:</label>
                                            <span class="email"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-group">
                                            <label for="" class="font-weight-bold">{{trans('lang.message')}}:</label>
                                            <span class="message"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

    <script type="text/javascript">
        var database = firebase.firestore();
        var id = "{{$id}}";
        var ref = database.collection('inquiry').where('id', '==', id);
        var append_list = '';

        $(document).ready(function () {

            jQuery("#overlay").show();

            ref.get().then(async function (snapshots) {
                data = snapshots.docs[0].data();
                $('.name').text(data.name);
                $('.phone').text(data.phone);
                $('.email').text(data.email);
                $('.message').text(data.message);

                jQuery("#overlay").hide();
            });
        });

    </script>

@endsection
