@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor userTitle">{{trans('lang.user_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('users') !!}">{{trans('lang.user_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.user_details')}}</li>
                </ol>
            </div>

        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="card card-block p-card">
                                        <div class="profile-box">
                                            <div class="profile-card rounded">
                                                <img src="https://goride.siswebapp.com/images/default_user.png"
                                                     alt="profile-bg"
                                                     class="avatar-100 d-block mx-auto img-fluid mb-3  avatar-rounded user-image">
                                                <h3 class="font-600 text-white text-center user-name"></h3>
                                                <div
                                                    class="font-600 text-white text-center mb-3 user-total-ratings"></div>
                                                <h3 class="font-600 text-white text-center mb-5 user-wallet wallet_transactions_div d-none"></h3>
                                                <a href="javascript:void(0)" data-toggle="modal"
                                                   data-target="#addWalletModal"
                                                   class="ml-3 mb-2 text-white add-wallate btn btn-sm btn-success wallet_transactions_div d-none"><i
                                                        class="fa fa-plus"></i>{{trans("lang.add_wallet_amount")}}
                                                </a>
                                                <a href="javascript:void(0)" data-toggle="modal"
                                                   data-target="#addVehicleModel" id="add_vehicle_btn"
                                                   class="ml-3 mb-2 text-white add-wallate btn btn-sm btn-success d-none"><i
                                                        class="fa fa-plus"></i>{{trans("lang.add_vehicle")}}</a>


                                            </div>
                                            <div class="pro-content rounded">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="p-icon mr-3">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                    <p class="mb-0 eml user-email"></p>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="p-icon mr-3">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                    <p class="mb-0 user-phone"></p>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="p-icon mr-3">
                                                        <i class="fa fa-birthday-cake"></i>
                                                    </div>
                                                    <p class="mb-0 user-birthday"></p>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="p-icon mr-3">
                                                        <i class="fa fa-user-o"></i>
                                                    </div>
                                                    <p class="mb-0 user-gender"></p>
                                                </div>
                                                <div class="assign_parking_div" style="display: none">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="p-icon mr-3">
                                                            <i class="mdi mdi-parking"></i>
                                                        </div>
                                                        <p class="mb-0 assign_parking_name"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-block card-stretch">
                                        <div class="card-header bg-white">
                                            <ul class="nav nav-pills mb-3" role="tablist">

                                                <li class="nav-item parking_list_div d-none">
                                                    <a class="nav-link parking_list active" data-toggle="pill"
                                                       href="#parking_list"
                                                       role="tab">{{trans('lang.parking_list')}}</a>
                                                </li>

                                                <li class="nav-item booked_parking_div d-none">
                                                    <a class="nav-link booked_parkings " data-toggle="pill"
                                                       href="#booked_parkings"
                                                       role="tab">{{trans('lang.booked_parkings')}}</a>
                                                </li>

                                                <li class="nav-item my_booking_div d-none">
                                                    <a class="nav-link booking_list " data-toggle="pill"
                                                       href="#booking_list"
                                                       role="tab">{{trans('lang.own_booking')}}</a>
                                                </li>

                                                <li class="nav-item security_list_div d-none">
                                                    <a class="nav-link security_list " data-toggle="pill"
                                                       href="#security_list"
                                                       role="tab">{{trans('lang.security_list')}} </a>
                                                </li>

                                                <li class="nav-item wallet_transactions_div">
                                                    <a class="nav-link wallet_transactions " data-toggle="pill"
                                                       href="#wallet_transactions"
                                                       role="tab">{{trans('lang.wallet_transactions')}}</a>
                                                </li>
                                                <li class="nav-item vehicle_list_div d-none">
                                                    <a class="nav-link vehicle_list " data-toggle="pill"
                                                       href="#vehicle_list"
                                                       role="tab">{{trans('lang.vehicle_list')}}</a>
                                                </li>


                                            </ul>
                                        </div>

                                        <div class="card-body">
                                            <div class="tab-content">


                                                <div class="tab-pane active" id="parking_list" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-valign-middle"
                                                               id="parkingListTable">
                                                            <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col"> {{trans('lang.image')}}</th>
                                                                <th scope="col">{{trans('lang.name')}}</th>
                                                                <th scope="col">{{trans('lang.address')}}</th>
                                                                <th scope="col">{{trans('lang.status')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="parking_list_rows"></tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane " id="booked_parkings" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-valign-middle"
                                                               id="bookedParkingTable">
                                                            <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col">{{trans('lang.name')}}</th>
                                                                <th scope="col">{{trans('lang.booked_by')}}</th>
                                                                <th scope="col">{{trans('lang.duration')}}</th>
                                                                <th scope="col">{{trans('lang.slot')}}</th>
                                                                <th scope="col">{{trans('lang.amount')}}</th>
                                                                <th scope="col">{{trans('lang.createdAt')}}</th>
                                                                <th scope="col">{{trans('lang.status')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="booked_parking_rows"></tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                                <div class="tab-pane" id="booking_list" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-valign-middle"
                                                               id="bookingListTable">
                                                            <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col"> {{trans('lang.id')}}</th>
                                                                <th scope="col">{{trans('lang.date&time')}}</th>
                                                                <th scope="col">{{trans('lang.duration')}}</th>
                                                                <th scope="col">{{trans('lang.slot')}}</th>
                                                                <th scope="col">{{trans('lang.amount')}}</th>
                                                                <th scope="col">{{trans('lang.createdAt')}}</th>
                                                                <th scope="col">{{trans('lang.status')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="booking_list_rows"></tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="security_list" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-valign-middle"
                                                               id="securityListTable">
                                                            <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col">{{trans('lang.name')}}</th>
                                                                <th scope="col">{{trans('lang.email')}}</th>
                                                                <th scope="col">{{trans('lang.phone')}}</th>
                                                                <th scope="col">{{trans('lang.salary')}}</th>
                                                                <th scope="col">{{trans('lang.assign_parking')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="security_list_rows"></tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                                <div class="tab-pane" id="wallet_transactions" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-valign-middle"
                                                               id="transactionListTable">
                                                            <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col"> {{trans('lang.id')}}</th>
                                                                <th scope="col">{{trans('lang.payment_method')}}</th>
                                                                <th scope="col">{{trans('lang.txn_id')}}</th>
                                                                <th scope="col">{{trans('lang.date')}}</th>
                                                                <th scope="col">{{trans('lang.note')}}</th>
                                                                <th scope="col">{{trans('lang.total_amount')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="wallet_transactions_rows"></tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="vehicle_list" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-valign-middle"
                                                               id="vehicleListTable">
                                                            <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col">{{trans('lang.car_number')}}</th>
                                                                <th scope="col">{{trans('lang.brand')}}</th>
                                                                <th scope="col">{{trans('lang.model')}}</th>
                                                                <th scope="col">{{trans('lang.actions')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="vehicle_list_rows"></tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12 text-center btm-btn">
                        <a href="{!! route('users') !!}" class="btn btn-default"><i
                                class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade" id="addWalletModal" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered location_modal">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title locationModalTitle">{{trans('lang.add_wallet_amount')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>

                    <div class="modal-body">

                        <form class="">

                            <div class="form-row">

                                <div class="form-group row">

                                    <div class="form-group row width-100">
                                        <label class="col-12 control-label">{{
                                    trans('lang.amount')}}</label>
                                        <div class="col-12">
                                            <input type="number" name="amount" class="form-control" id="amount">
                                            <div id="wallet_error" style="color:red"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-12 control-label">{{
                                    trans('lang.note')}}</label>
                                        <div class="col-12">
                                            <input type="text" name="note" class="form-control" id="note">
                                        </div>
                                    </div>
                                    <div class="form-group row width-100">

                                        <div id="user_account_not_found_error" class="align-items-center"
                                             style="color:red"></div>
                                    </div>


                                </div>

                            </div>

                        </form>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"
                                    id="add-wallet-btn">{{trans('lang.submit')}}</a>
                            </button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                                {{trans('lang.close')}}</a>
                            </button>

                        </div>

                    </div>
                </div>

            </div>

        </div>
        <div class="modal fade" id="addVehicleModel" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered location_modal">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title locationModalTitle">{{trans('lang.add_vehicle')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>

                    <div class="modal-body">

                        <form class="">

                            <div class="form-row">

                                <div class="form-group row">

                                    <div class="form-group row width-100">
                                        <label class="col-12 control-label">{{trans('lang.car_number')}}<span
                                                class="required-field"></span></label>
                                        <div class="col-12">
                                            <input type="text" class="form-control car_number add_car_number">
                                            <div class="form-group row width-100">

                                                <div id="car_number_error"
                                                     class="align-items-center add_car_number_error error"
                                                     style="color:red"></div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-12 control-label">{{trans('lang.brand')}}<span
                                                class="required-field"></span></label>
                                        <div class="col-12">
                                            <select name="brand" class="form-control brand add_brand" id="brand">
                                                <option value="">{{trans('lang.select')}}</option>
                                            </select>
                                            <div class="form-group row width-100">

                                                <div id="brand_error" class="align-items-center add_brand_error error"
                                                     style="color:red"></div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-12 control-label">{{trans('lang.model')}}<span
                                                class="required-field"></span></label>
                                        <div class="col-12">
                                            <select name="model" class="form-control model add_model">
                                                <option value="">{{trans('lang.select')}}</option>
                                            </select>
                                            <div class="form-group row width-100">

                                                <div id="model_error" class="align-items-center add_model_error error"
                                                     style="color:red"></div>
                                            </div>

                                        </div>

                                    </div>


                                </div>

                            </div>

                        </form>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="add-vehicle-btn"
                                    onclick="addUserVehicle()">{{trans('lang.submit')}}</a>
                            </button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                                {{trans('lang.close')}}</a>
                            </button>

                        </div>

                    </div>
                </div>

            </div>

        </div>
        <div class="modal fade" id="editVehicleModel" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered location_modal">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title locationModalTitle">{{trans('lang.edit_vehicle')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>

                    <div class="modal-body">

                        <form class="">

                            <div class="form-row">

                                <div class="form-group row">
                                    <input type="hidden" id="vehicle_id">
                                    <div class="form-group row width-100">
                                        <label class="col-12 control-label">{{trans('lang.car_number')}}<span
                                                class="required-field"></span></label>
                                        <div class="col-12">
                                            <input type="text" class="form-control car_number edit_car_number">
                                            <div class="form-group row width-100">

                                                <div class="align-items-center edit_car_number_error error"
                                                     style="color:red"></div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-12 control-label">{{trans('lang.brand')}}<span
                                                class="required-field"></span></label>
                                        <div class="col-12">
                                            <select name="brand" class="form-control brand edit_brand" id="edit_brand">
                                                <option value="">{{trans('lang.select')}}</option>
                                            </select>
                                            <div class="form-group row width-100">

                                                <div class="align-items-center edit_brand_error error"
                                                     style="color:red"></div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-12 control-label">{{trans('lang.model')}}<span
                                                class="required-field"></span></label>
                                        <div class="col-12">
                                            <select name="model" class="form-control model edit_model">
                                                <option value="">{{trans('lang.select')}}</option>
                                            </select>
                                            <div class="form-group row width-100">

                                                <div class="align-items-center edit_model_error error"
                                                     style="color:red"></div>
                                            </div>

                                        </div>

                                    </div>


                                </div>

                            </div>

                        </form>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="edit-vehicle-btn"
                                    onclick="editUserVehicle()">{{trans('lang.submit')}}</a>
                            </button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                                {{trans('lang.close')}}</a>
                            </button>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script type="text/javascript">

        var id = "<?php echo $id; ?>";
        var database = firebase.firestore();
        var userRef = database.collection('users').doc(id);
        var placeholderImage = "{{ asset('/images/default_user.png') }}";
        var users_details = "{{trans('lang.users_details')}}";
        var notFound = "{{ trans('lang.doc_not_found') }}";
        var walletRef = database.collection('wallet_transaction').where("userId", "==", id).orderBy('createdDate', 'desc');
        var parkingRef = database.collection('parkings').where("userId", "==", id);
        var bookingRef = database.collection('booked_parking_order').where("userId", "==", id).orderBy('createdAt', 'desc');
        var securityRef = database.collection('users').where("ownerId", "==", id).orderBy('createdAt', 'desc');
        var defaultImg = "{{ asset('/images/default_user.png') }}";
        var refBrand = database.collection('vehicle_brand').where('enable', '==', true);
        refBrand.get().then(async function (snapshots) {
            snapshots.docs.forEach((listval) => {
                var data = listval.data();

                $('.brand').append($("<option></option>")
                    .attr("value", data.id)
                    .attr("id", data.id)
                    .text(data.name));
            })
        });

        getModel();
        $(document).on("click", "a[name='edit-vehicle']", function (e) {
            vehId = this.id;
            database.collection('user_vehicles').where('id', '==', vehId).get().then(async function (vehSnapshots) {

                vehData = vehSnapshots.docs[0].data();
                $('#vehicle_id').val(vehId);
                $('.car_number').val(vehData.vehicleNumber);
                $('.brand').val(vehData.vehicleBrand.id);
                getModel(vehData.vehicleBrand.id, vehData.vehicleModel.id);

                $('#editVehicleModel').modal('show');
            })

        });

        var user_role = null;
        var parking_id = null;

        var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');
        var decimal_degits = 0;
        var symbolAtRight = false;
        var currentCurrency = '';

        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            decimal_degits = currencyData.decimalDigits;
            if (currencyData.symbolAtRight) {
                symbolAtRight = true;
            }
        });

        async function getModel(brand = '', model = '') {
            $('.model').empty();
            var options = '<option value="">{{trans("lang.select")}} {{trans("lang.model")}}</option>';
            var refModel = database.collection('vehicle_model').where('enable', '==', true);

            if (brand) {
                refModel = refModel.where('brandId', '==', brand)
            }

            await refModel.get().then(async function (snapshots) {

                snapshots.docs.forEach((listval) => {
                    var data = listval.data();
                    options += '<option value="' + data.id + '" >' + data.name + '</option>';

                })
            });
            $('.model').append(options);
            if (model) {
                $('select[name="model"]').find('option[value="' + model + '"]').attr("selected", true);

            }
        }

        var vehicleRef = database.collection('user_vehicles').where('userId', '==', id);
        $(document).ready(function () {
            $('.user_menu').addClass('active');
            $('.brand').on('change', function () {
                var brand = $(this).val();
                console.log(brand);
                $('.brand').val(brand);
                getModel(brand);


            });

            getParkingList();
        });
        $(document).on('click', '.wallet_transactions', function () {
            getWalletTransactions();
        });
        $(document).on('click', '.parking_list', function () {
            getParkingList();
        });
        $(document).on('click', '.booking_list', function () {
            getBookingList();
        });
        $(document).on('click', '.security_list', function () {
            getSecurityList();
        });

        $(document).on('click', '.booked_parkings', function () {
            getBookedParkingList();
        });

        $(document).on('click', '.vehicle_list', function () {
            getVehicleList();
        });

        userRef.get().then(async function (snapshot) {
            let data = snapshot.data();

            user_role = data.role;
            parking_id = data.parkingId;

            if (data.hasOwnProperty("role")) {

                if (data.role == "security") {
                    $('.userTitle').html("Watchman");

                } else {
                    $('.userTitle').html(data.role);

                }
            }

            if (data.hasOwnProperty("role") && data.role == "security") {
                $('.wallet_transactions_div').addClass('d-none');

                var parking_name = await getAssignParkingName(data.parkingId);
                $('.assign_parking_name').html(parking_name);
                $('.assign_parking_div').show();
                $('.booked_parking_div').removeClass('d-none');
                $('#parking_list').removeClass('active');
                $('.booked_parkings,#booked_parkings').addClass('active').addClass('show');
                getBookedParkingList();
            } else {
                $('.wallet_transactions_div').removeClass('d-none');
            }

            if (data.hasOwnProperty("role") && data.role == "owner") {
                $('.security_list_div').removeClass('d-none');
                $('.parking_list_div').removeClass('d-none');
                $('.booked_parking_div').removeClass('d-none');


            }
            if (data.hasOwnProperty("role") && data.role == "customer") {
                $('#add_vehicle_btn').removeClass('d-none');
                $('.vehicle_list_div').removeClass('d-none');
                $('.my_booking_div').removeClass('d-none');
                $('#parking_list').removeClass('active');
                $('.booking_list,#booking_list').addClass('active').addClass('show');
                getBookingList();
            }


            $(".user-name").text(data.fullName);
            $(".user-email").text(data.email);
            $(".user-phone").text(data.countryCode + data.phoneNumber);

            if (data.hasOwnProperty('dateOfBirth') && data.dateOfBirth != null && data.dateOfBirth != "") {
                $(".user-birthday").text(data.dateOfBirth);
            } else {
                $(".user-birthday").text("N/A");

            }
            if (data.hasOwnProperty('gender') && data.gender != null && data.gender != "") {
                $('.user-gender').text(data.gender);
            } else {
                $('.user-gender').text("N/A");

            }

            var walletAmount = 0;
            if (data.hasOwnProperty('walletAmount') && data.walletAmount != null) {
                walletAmount = data.walletAmount;
            }
            if (symbolAtRight) {
                $(".user-wallet").text(parseFloat(walletAmount).toFixed(decimal_degits) + currentCurrency);
            } else {
                $(".user-wallet").text(currentCurrency + parseFloat(walletAmount).toFixed(decimal_degits));
            }
            if (data.profilePic != null && data.profilePic != '') {
                $(".user-image").attr('src', data.profilePic);
            }
        });

        function getParkingList() {
            $("#parking_list_rows").html('');

            jQuery("#overlay").show();

            parkingRef.get().then(async function (docSnapshot) {

                let html = '';

                html = await buildParkingListHtml(docSnapshot);

                if (html != '') {
                    $("#parking_list_rows").html(html);

                }

                var table = $('#parkingListTable').DataTable();

                table.destroy();

                table =
                    $('#parkingListTable').DataTable({
                        order: [],
                        columnDefs: [

                            {orderable: false, targets: 1},
                        ],

                        "language": {
                            "zeroRecords": "{{trans('lang.no_record_found')}}",
                            "emptyTable": "{{trans('lang.no_record_found')}}"
                        },
                        responsive: true

                    });

                jQuery("#overlay").hide();

            });

        }

        async function buildParkingListHtml(snapshots) {
            var html = '';

            await Promise.all(snapshots.docs.map(async (listval) => {

                var val = listval.data();

                var getData = await getParkingListData(val);
                html += getData;
            }));

            return html;
        }

        async function getParkingListData(val) {
            var html = '';
            html = html + '<tr>';
            var id = val.id;
            var parking_view = '{{route("parking-list.show",":id")}}';
            parking_view = parking_view.replace(':id', val.id);

            if (val.image == '' || val.image == null) {

                html = html + '<td><img class="rounded" style="width:50px" src="' + defaultImg + '" alt="image"></td>';
            } else {
                html = html + '<td><img class="rounded" style="width:50px" src="' + val.image + '" alt="image"></td>';
            }

            html += '<td><a href="' + parking_view + '">' + val.name + '</a></td>';

            html = html + '<td>' + val.address + '</td>';
            if (val.isEnable) {
                html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
            } else {
                html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
            }
            html += '</tr>';
            return html;

        }

        async function getBookedParkingList() {
            $("#booked_parking_rows").html('');

            jQuery("#overlay").show();

            var bookedParkingRef = database.collection('booked_parking_order').where('parkingDetails.userId', '==', id).orderBy('createdAt', 'desc');

            if (user_role == "security") {
                bookedParkingRef = database.collection('booked_parking_order').where('parkingId', '==', parking_id).orderBy('createdAt', 'desc');

            }
            bookedParkingRef.get().then(async function (docSnapshot) {

                let html = '';
                html = await buildBookedParkingHtml(docSnapshot);

                if (html != '') {
                    $("#booked_parking_rows").html(html);

                }

                var table = $('#bookedParkingTable').DataTable();

                table.destroy();

                table =
                    $('#bookedParkingTable').DataTable({
                        order: [],
                        columnDefs: [
                            {
                                targets: 5,
                                type: 'date',
                                render: function (data) {
                                    return data;
                                }
                            },
                            {orderable: false, targets: 1},
                        ],
                        order: [['5', 'desc']],
                        "language": {
                            "zeroRecords": "{{trans('lang.no_record_found')}}",
                            "emptyTable": "{{trans('lang.no_record_found')}}"
                        },
                        responsive: true

                    });

                jQuery("#overlay").hide();

            });

        }

        async function buildBookedParkingHtml(snapshots) {
            var html = '';

            await Promise.all(snapshots.docs.map(async (listval) => {

                var val = listval.data();

                var getData = await getBookedParkingListData(val);
                html += getData;
            }));

            return html;
        }

        async function getBookedParkingListData(val) {
            var html = '';
            html = html + '<tr>';
            var id = val.id;
            var parking_view = '{{route("parking-bookings.show",":id")}}';
            parking_view = parking_view.replace(':id', val.id);


            html += '<td><a href="' + parking_view + '">' + val.parkingDetails.name + '</a></td>';
            if (val.userId) {
                var userData = await getUserName(val.userId);
                if (Object.keys(userData).length > 0) {
                    var customer_view = '{{route("users.view",":id")}}';
                    customer_view = customer_view.replace(':id', val.userId);
                    html += '<td class="redirecttopage user_name_' + val.id + '"><a href="' + customer_view + '">' + userData.fullName + '</a></td>';
                } else {
                    html += '<td class="redirecttopage user_name_' + val.id + '">' + '{{trans("lang.unknown_user")}}' + '</td>';
                }
            } else {
                html += '<td class="redirecttopage user_name_' + val.id + '"></td>';
            }
            html = html + '<td>' + val.duration + ' {{trans("lang.hours")}}</td>';
            html = html + '<td>' + val.parkingSlotId + '</td>';

            var amount = 0;

            amount = await getOrderDetails(val);
            if (symbolAtRight) {
                html += '<td>' + amount + currentCurrency + '</td>';
            } else {
                html += '<td>' + currentCurrency + amount + '</td>';
            }


            var date = '';
            var time = '';
            if (val.hasOwnProperty("createdAt")) {
                date = val.createdAt.toDate().toDateString();
                time = val.createdAt.toDate().toLocaleTimeString('en-US');

            }
            html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';

            if (val.status == "placed") {
                html += '<td><span class="badge badge-primary py-2 px-3">{{trans("lang.placed")}}</span></td>';
            } else if (val.status == "canceled") {
                html += '<td><span  class="badge badge-danger py-2 px-3">{{trans("lang.canceled")}}</span></td>';
            } else if (val.status == "onGoing") {
                html += '<td><span class="badge badge-info py-2 px-3">{{trans("lang.ongoing")}}</span></td>';
            } else if (val.status == "completed") {
                html += '<td><span class="badge badge-success py-2 px-3">{{trans("lang.completed")}}</span></td>';
            } else {
                html += '<td><span class="badge badge-primary py-2 px-3">' + val.status + '</span></td>';

            }
            html += '</tr>';
            return html;

        }

        function getSecurityList() {
            $('#security_list_rows').html('');
            jQuery("#overlay").show();

            securityRef.get().then(async function (docSnapshot) {

                let html = '';

                html = await buildSecurityListHtml(docSnapshot);

                if (html != '') {
                    $("#security_list_rows").html(html);

                }

                var table = $('#securityListTable').DataTable();

                table.destroy();

                table =
                    $('#securityListTable').DataTable({
                        order: [],
                        "language": {
                            "zeroRecords": "{{trans("lang.no_record_found")}}",
                            "emptyTable": "{{trans("lang.no_record_found")}}"
                        },
                        responsive: true

                    });

                jQuery("#overlay").hide();

            });

        }

        async function buildSecurityListHtml(snapshots) {
            var html = '';

            await Promise.all(snapshots.docs.map(async (listval) => {

                var val = listval.data();

                var getData = await getSecurityListData(val);
                html += getData;
            }));

            return html;
        }

        async function getSecurityListData(val) {
            var html = '';
            html = html + '<tr>';

            var view = '{{route("users.view",":id")}}';
            view = view.replace(':id', val.id);

            var parking_name = await getAssignParkingName(val.parkingId);

            html += '<td><a href="' + view + '">' + val.fullName + '</a></td>';
            html += '<td>' + val.email + '</td>';
            html = html + '<td>' + (val.countryCode ? '+' + (val.countryCode.includes('+') ? val.countryCode.slice(1) + '-' : val.countryCode + '-') : '') + val.phoneNumber + '</td>';

            if (symbolAtRight) {
                html += '<td>' + parseFloat(val.salary).toFixed(decimal_degits) + currentCurrency + '</td>';

            } else {
                html += '<td>' + currentCurrency + parseFloat(val.salary).toFixed(decimal_degits) + '</td>';

            }
            html += '<td>' + parking_name + '</td>';

            html += '</tr>';
            return html;

        }

        async function getAssignParkingName(parkingId) {
            var user_name = '';
            await database.collection('parkings').where('id', '==', parkingId).get().then(async function (snapshots) {
                if (snapshots.docs.length > 0) {
                    var user = snapshots.docs[0].data();
                    user_name = user.name;
                } else {
                    user_name = "{{trans('lang.not_assign')}}";
                }
            });
            return user_name;
        }


        function getBookingList() {
            $("#booking_list_rows").html('');

            jQuery("#overlay").show();

            bookingRef.get().then(async function (docSnapshot) {

                let html = '';

                html = await buildBookingListHtml(docSnapshot);

                if (html != '') {
                    $("#booking_list_rows").html(html);

                }

                var table = $('#bookingListTable').DataTable();

                table.destroy();

                table =
                    $('#bookingListTable').DataTable({
                        order: [],
                        columnDefs: [
                            {
                                targets: 5,
                                type: 'date',
                                render: function (data) {
                                    return data;
                                }
                            },
                            // { orderable: false, targets: 1 },
                        ],
                        order: [['5', 'desc']],
                        "language": {
                            "zeroRecords": "{{trans("lang.no_record_found")}}",
                            "emptyTable": "{{trans("lang.no_record_found")}}"
                        },
                        responsive: true

                    });

                jQuery("#overlay").hide();

            });

        }

        async function buildBookingListHtml(snapshots) {
            var html = '';

            await Promise.all(snapshots.docs.map(async (listval) => {

                var val = listval.data();

                var getData = await getBookingListData(val);
                html += getData;
            }));

            return html;
        }

        async function getBookingListData(val) {
            var html = '';
            html = html + '<tr>';
            var id = val.id;
            var user_id = val.userId;
            var ride_view = '';
            var ride_view = '{{route("parking-bookings.show",":id")}}';
            ride_view = ride_view.replace(':id', val.id);
            id = id.substring(0, 7);
            html += '<td><a href="' + ride_view + '">' + id + '</a></td>';

            var date = '';
            var time = '';
            if (val.hasOwnProperty("bookingDate")) {
                date = val.bookingDate.toDate().toDateString();
            }
            if (val.hasOwnProperty("bookingStartTime") && val.hasOwnProperty('bookingEndTime')) {
                startTime = val.bookingStartTime.toDate().toLocaleTimeString('en-US');
                endTime = val.bookingEndTime.toDate().toLocaleTimeString('en-US');
                time = startTime + " - " + endTime;
            }
            html = html + '<td class="dt-time">' + date + '<br>' + time + '</td>';
            html = html + '<td>' + val.duration + ' {{trans("lang.hours")}}</td>';
            html = html + '<td>' + val.parkingSlotId + '</td>';

            var amount = 0;

            amount = await getOrderDetails(val);
            if (symbolAtRight) {
                html += '<td>' + amount + currentCurrency + '</td>';
            } else {
                html += '<td>' + currentCurrency + amount + '</td>';
            }


            var date = '';
            var time = '';
            if (val.hasOwnProperty("createdAt")) {
                date = val.createdAt.toDate().toDateString();
                time = val.createdAt.toDate().toLocaleTimeString('en-US');

            }
            html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';

            if (val.status == "placed") {
                html += '<td><span class="badge badge-primary py-2 px-3">{{trans("lang.placed")}}</span></td>';
            } else if (val.status == "canceled") {
                html += '<td><span  class="badge badge-danger py-2 px-3">{{trans("lang.canceled")}}</span></td>';
            } else if (val.status == "onGoing") {
                html += '<td><span class="badge badge-info py-2 px-3">{{trans("lang.ongoing")}}</span></td>';
            } else if (val.status == "completed") {
                html += '<td><span class="badge badge-success py-2 px-3">{{trans("lang.completed")}}</span></td>';
            } else {
                html += '<td><span class="badge badge-primary py-2 px-3">' + val.status + '</span></td>';

            }
            html += '</tr>';
            return html;

        }

        function getWalletTransactions() {

            $("#wallet_transactions_rows").html('');

            jQuery("#overlay").show();

            walletRef.get().then(async function (docSnapshot) {

                let html = '';

                html = await buildWalletTransactionsHtml(docSnapshot);

                if (html != '') {
                    $("#wallet_transactions_rows").html(html);

                }

                var table = $('#transactionListTable').DataTable();

                table.destroy();

                table =
                    $('#transactionListTable').DataTable({
                        order: [],
                        columnDefs: [
                            {
                                targets: 3,
                                type: 'date',
                                render: function (data) {
                                    return data;
                                }
                            },
                            {orderable: false, targets: 1},
                        ],
                        order: [['3', 'desc']],
                        "language": {
                            "zeroRecords": "{{trans("lang.no_record_found")}}",
                            "emptyTable": "{{trans("lang.no_record_found")}}"
                        },
                        responsive: true

                    });

                jQuery("#overlay").hide();

            });

        }

        async function buildWalletTransactionsHtml(snapshots) {
            var html = '';
            await Promise.all(snapshots.docs.map(async (listval) => {
                var val = listval.data();
                var getData = await getWalletTransactionsListData(val);
                html += getData;
            }));
            return html;
        }

        async function getWalletTransactionsListData(data) {

            let html = '';

            html += '<tr>';

            html += '<td>' + data.id.substring(0, 7) + '</td>';

            if (data.paymentType) {
                var image = await getPaymentImage(data.id.substring(0, 7), data.paymentType);
                html += '<td class="payment_icon ' + data.id.substring(0, 7) + '_' + data.paymentType + '"><img width="80" src="' + image + '" alt="image"></td>';
            } else {
                html += '<td>-</td>';
            }

            html += '<td>' + data.transactionId + '</td>';

            if (data.hasOwnProperty("createdDate")) {
                date = data.createdDate.toDate().toDateString();
                time = data.createdDate.toDate().toLocaleTimeString('en-US');
                html = html + '<td class="dt-time"><span class="date">' + date + '</span><span class="time"> ' + time + '</span></td>';
            } else {
                html = html + '<td></td>';
            }

            html += '<td>' + data.note + '</td>';

            var amount = parseFloat(data.amount);

            if (symbolAtRight) {
                if (amount.toFixed(decimal_degits) <= 0) {
                    amount = Math.abs(amount);
                    html += '<td><span style="color:red">(-' + amount.toFixed(decimal_degits) + currentCurrency + ')</span></td>';
                } else {
                    html += '<td><span style="color:green">' + amount.toFixed(decimal_degits) + currentCurrency + '</sapn></td>';
                }
            } else {
                if (amount.toFixed(decimal_degits) <= 0) {
                    amount = Math.abs(amount);

                    html += '<td><span style="color:red">(-' + currentCurrency + amount.toFixed(decimal_degits) + ')</span></td>';
                } else {
                    html += '<td><span style="color:green">' + currentCurrency + amount.toFixed(decimal_degits) + '</sapn></td>';
                }
            }

            html += '</tr>';

            return html;
        }

        async function getPaymentImage(id, paymentType) {
            var payImage = '';
            await database.collection('settings').doc('payment').get().then(async function (snapshots) {
                var payment = snapshots.data();
                type = paymentType.toLowerCase();
                if (type == "flutterwave") {
                    type = "flutterWave";
                } else if (type == "stripe") {
                    type = "strip";
                } else if (type == "paystack") {
                    type = "payStack";
                } else if (type == "mercadopago") {
                    type = "mercadoPago";
                }
                payment = payment[type];
                payImage = payment.image;

            });
            return payImage;
        }

        async function getOrderDetails(orderData) {

            var amount = 0;
            var total_amount = 0;

            if (orderData.subTotal) {
                amount = parseFloat(orderData.subTotal);

            }
            total_amount = amount;

            var discount_amount = 0;
            if (orderData.hasOwnProperty('coupon') && orderData.coupon.enable) {
                var data = orderData.coupon;

                if (data.type == "fix") {
                    discount_amount = data.amount;
                } else {
                    discount_amount = (data.amount * amount) / 100;
                }

                total_amount -= parseFloat(discount_amount);

            }


            if (orderData.hasOwnProperty('taxList') && orderData.taxList.length > 0) {
                var taxData = orderData.taxList;

                var tax_amount_total = 0;
                for (var i = 0; i < taxData.length; i++) {

                    var data = taxData[i];

                    if (data.enable) {

                        var tax_amount = data.tax;

                        if (data.type == "percentage") {

                            tax_amount = (data.tax * total_amount) / 100;
                        }

                        tax_amount_total += parseFloat(tax_amount);

                    }
                }
                total_amount += parseFloat(tax_amount_total);


            }
            total_amount = total_amount.toFixed(decimal_degits);

            return total_amount;
        }

        async function getUserName(userId, id) {
            var user = {};
            await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {
                if (snapshots.docs.length > 0) {
                    user = snapshots.docs[0].data();
                }
            });
            return user;
        }

        $("#add-wallet-btn").click(function () {
            var date = firebase.firestore.FieldValue.serverTimestamp();
            var amount = $('#amount').val();
            if (amount == '') {
                $('#wallet_error').text('{{trans("lang.add_wallet_amount_error")}}');
                return false;
            }
            var note = $('#note').val();

            database.collection('users').where('id', '==', id).get().then(async function (snapshot) {

                if (snapshot.docs.length > 0) {
                    var data = snapshot.docs[0].data();

                    var walletAmount = 0;

                    if (data.hasOwnProperty('walletAmount') && !isNaN(data.walletAmount) && data.walletAmount != null) {
                        walletAmount = data.walletAmount;

                    }
                    var user_id = data.id;
                    var newWalletAmount = parseFloat(walletAmount) + parseFloat(amount);

                    database.collection('users').doc(id).update({
                        'walletAmount': newWalletAmount.toString()
                    }).then(function (result) {
                        var tempId = database.collection("tmp").doc().id;
                        var transactionId = (new Date()).getTime();
                        database.collection('wallet_transaction').doc(tempId).set({
                            'amount': amount.toString(),
                            'createdDate': date,
                            'id': tempId,
                            'isCredit': true,
                            'note': note,
                            'paymentType': 'Wallet',
                            'transactionId': transactionId.toString(),
                            'userId': user_id,

                        }).then(async function (result) {
                            window.location.reload();

                        });
                    })
                }
            });
        })

        async function addUserVehicle() {
            var date = firebase.firestore.FieldValue.serverTimestamp();
            var brandId = $('.brand').val();
            var modelId = $('.model').val();
            var carNumber = $('.add_car_number').val();

            $('.error').html('');


            if (carNumber == '') {
                $('.add_car_number_error').text('{{trans("lang.car_number_help")}}');
                return false;

            } else if (brandId == '') {
                $('.add_brand_error').text('{{trans("lang.brand_error")}}');
                return false;
            } else if (modelId == '') {
                $('.add_model_error').text('{{trans("lang.model_error")}}');
                return false;
            }
            var brandData = await database.collection('vehicle_brand').where('id', '==', brandId).get().then(async function (snapshots) {
                return snapshots.docs[0].data();

            });
            var modelData = await database.collection('vehicle_model').where('id', '==', modelId).get().then(async function (snapshots) {
                return snapshots.docs[0].data();

            });

            var tempId = database.collection("tmp").doc().id;
            database.collection('user_vehicles').doc(tempId).set({
                'vehicleNumber': carNumber,
                'vehicleBrand': brandData,
                'vehicleModel': modelData,
                'userId': id,
                'id': tempId
            }).then(async function (result) {
                window.location.reload();

            });

        }

        async function editUserVehicle() {
            var vehId = $('#vehicle_id').val();
            var brandId = $('.edit_brand option:selected').val();
            var modelId = $('.edit_model option:selected').val();
            var carNumber = $('.edit_car_number').val();

            $('.error').html('');
            if (carNumber == '') {
                $('.edit_car_number_error').text('{{trans("lang.car_number_help")}}');
                return false;

            } else if (brandId == '') {
                $('.edit_brand_error').text('{{trans("lang.brand_error")}}');
                return false;
            } else if (modelId == '') {
                $('.edit_model_error').text('{{trans("lang.model_error")}}');
                return false;
            }
            var brandData = await database.collection('vehicle_brand').where('id', '==', brandId).get().then(async function (snapshots) {
                return snapshots.docs[0].data();
            });
            var modelData = await database.collection('vehicle_model').where('id', '==', modelId).get().then(async function (snapshots) {
                return snapshots.docs[0].data();
            });


            database.collection('user_vehicles').doc(vehId).update({
                'vehicleNumber': carNumber,
                'vehicleBrand': brandData,
                'vehicleModel': modelData,
                'userId': id
            }).then(async function (result) {
                window.location.reload();

            });

        }

        function getVehicleList() {
            $("#vehicle_list_rows").html('');

            jQuery("#overlay").show();

            vehicleRef.get().then(async function (docSnapshot) {

                let html = '';

                html = await buildVehicleListHtml(docSnapshot);

                if (html != '') {
                    $("#vehicle_list_rows").html(html);

                }

                var table = $('#vehicleListTable').DataTable();

                table.destroy();

                table =
                    $('#vehicleListTable').DataTable({
                        order: [],

                        "language": {
                            "zeroRecords": "{{trans('lang.no_record_found')}}",
                            "emptyTable": "{{trans('lang.no_record_found')}}"
                        },
                        responsive: true

                    });

                jQuery("#overlay").hide();

            });

        }

        async function buildVehicleListHtml(snapshots) {
            var html = '';

            await Promise.all(snapshots.docs.map(async (listval) => {

                var val = listval.data();

                var getData = await getVehicleListData(val);
                html += getData;
            }));

            return html;
        }

        async function getVehicleListData(val) {
            var html = '';
            html = html + '<tr>';
            var id = val.id;

            html += '<td>' + val.vehicleNumber + '</td>';

            html = html + '<td>' + val.vehicleBrand.name + '</td>';
            html = html + '<td>' + val.vehicleModel.name + '</td>';
            html += '<td class="action-btn"><a href="javascript:void(0)" id="' + val.id + '" name="edit-vehicle"><i class="fa fa-edit"></i></a></td>';

            html += '</tr>';
            return html;

        }

    </script>
@endsection
