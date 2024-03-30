@extends('layouts.app')

@section('content')

    <div id="main-wrapper" class="page-wrapper" style="min-height: 207px;">

        <div class="container-fluid">

            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                 style="display: none;margin-top:20px;">{{trans('lang.processing')}}
            </div>

            <div class="card mb-3 business-analytics">

                <div class="card-body">

                    <div class="row flex-between align-items-center g-2 mb-3 order_stats_header">
                        <div class="col-sm-6">
                            <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
                                {{trans('lang.dashboard_today_trip')}}</h4>
                        </div>
                    </div>

                    <div class="row business-analytics_list">

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-bookings') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_today_total_orders')}}</h5>
                                <h2 id="total_booking_today"></h2>
                                <i class="mdi mdi-map-marker-multiple"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('users') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_today_total_clients')}}</h5>
                                <h2 id="users_count_today"></h2>
                                <i class="mdi mdi-account-multiple"></i>
                            </div>
                        </div>


                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_today_total_earnings')}}</h5>
                                <h2 id="earnings_count_today"></h2>
                                <i class="mdi mdi-cash-usd"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_today_admin_commission')}}</h5>
                                <h2 id="admincommission_count_today"></h2>
                                <i class="ti-wallet"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-bookings') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_today_booking_placed')}}</h5>
                                <h2 id="placed_count_today"></h2>
                                <i class="mdi mdi-check-circle"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-bookings') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_today_booking_active')}}</h5>
                                <h2 id="active_count_today"></h2>
                                <i class="mdi mdi-car-connected"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-bookings') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_today_booking_completed')}}</h5>
                                <h2 id="completed_count_today"></h2>
                                <i class="mdi mdi-check-circle-outline"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-bookings') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_today_booking_canceled')}}</h5>
                                <h2 id="canceled_count_today"></h2>
                                <i class="mdi mdi-window-close"></i>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card mb-3 business-analytics">

                <div class="card-body">

                    <div class="row flex-between align-items-center g-2 mb-3 order_stats_header">
                        <div class="col-sm-6">
                            <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
                                {{trans('lang.dashboard_total_trip')}}</h4>
                        </div>
                    </div>

                    <div class="row business-analytics_list">

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-bookings') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_total_orders')}}</h5>
                                <h2 id="total_booking"></h2>
                                <i class="mdi mdi-map-marker-multiple"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('users') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_total_clients')}}</h5>
                                <h2 id="users_count"></h2>
                                <i class="mdi mdi-account-multiple"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('users') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_total_security')}}</h5>
                                <h2 id="security_count"></h2>
                                <i class="mdi mdi-account-multiple"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('users') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_total_owner')}}</h5>
                                <h2 id="owner_count"></h2>
                                <i class="mdi mdi-account-multiple"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-list') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_total_parkings')}}</h5>
                                <h2 id="parking_count"></h2>
                                <i class="mdi mdi-parking"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_total_earnings')}}</h5>
                                <h2 id="earnings_count"></h2>
                                <i class="mdi mdi-cash-usd"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_admin_commission')}}</h5>
                                <h2 id="admincommission_count"></h2>
                                <i class="ti-wallet"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-bookings') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_booking_placed')}}</h5>
                                <h2 id="placed_count"></h2>
                                <i class="mdi mdi-check-circle"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-bookings') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_booking_active')}}</h5>
                                <h2 id="active_count"></h2>
                                <i class="mdi mdi-car-connected"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-bookings') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_booking_completed')}}</h5>
                                <h2 id="completed_count"></h2>
                                <i class="mdi mdi-check-circle-outline"></i>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('parking-bookings') !!}'">
                            <div class="card-box">
                                <h5>{{trans('lang.dashboard_booking_canceled')}}</h5>
                                <h2 id="canceled_count"></h2>
                                <i class="mdi mdi-window-close"></i>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header no-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{trans('lang.dashboard_total_sales')}}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="position-relative">
                                <canvas id="sales-chart" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2"> <i class="fa fa-square" style="color:#80b140"></i> {{trans('lang.dashboard_this_year')}} </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header no-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{trans('lang.dashboard_service_overview')}}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="flex-row">
                                <canvas id="service-overview" height="222"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header no-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{trans('lang.dashboard_sales_overview')}}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="flex-row">
                                <canvas id="sales-overview" height="222"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row daes-sec-sec">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header no-border d-flex justify-content-between">
                            <h3 class="card-title">{{trans('lang.dashboard_recent_bookings')}}</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th style="text-align:center">{{trans('lang.order_id')}}</th>
                                    <th>{{trans('lang.dashboard_user')}}</th>
                                    <th>{{trans('lang.parking')}}</th>
                                    <th>{{trans('lang.createdAt')}}</th>
                                </tr>
                                </thead>
                                <tbody id="append_list_recent_rides">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header no-border d-flex justify-content-between">
                            <h3 class="card-title">{{trans('lang.dashboard_top_parkings')}}</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th style="text-align:center">{{trans('lang.image')}}</th>
                                    <th>{{trans('lang.name')}}</th>
                                    <th>{{trans('lang.rating')}}</th>
                                    <th>{{trans('lang.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody id="append_list_top_parking">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                </div>
            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{asset('js/chart.js')}}"></script>

    <script>

        var db = firebase.firestore();
        var currency = db.collection('settings');
        const todayDate = new Date();
        todayDate.setHours(0, 0, 0, 0);

        var rides_data = [];
        var currentCurrency = '';
        var currencyAtRight = false;
        var decimal_degits = 0;
        var defaultImg = "{{ asset('/images/default_user.png') }}";

        var refCurrency = database.collection('currency').where('enable', '==', true);
        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            currencyAtRight = currencyData.symbolAtRight;
            if (currencyData.decimalDigits) {
                decimal_degits = currencyData.decimalDigits;
            }
        });
        var offest = 1;
        var pagesize = 5;
        var limit = parseInt(offest) * parseInt(pagesize);
        var append_list_recent_rides = document.getElementById('append_list_recent_rides');
        append_list_recent_rides.innerHTML = '';

        db.collection('booked_parking_order').orderBy('createdAt', 'desc').where('status', 'in', ["placed", "onGoing"]).limit(limit).get().then((snapshots) => {
            html = '';
            html = buildBookingHTML(snapshots);
            if (html != '') {
                append_list_recent_rides.innerHTML = html;
            }
        });


        $(document).ready(function () {

            jQuery("#overlay").show();

            db.collection('booked_parking_order').where('createdAt', '>=', todayDate).get().then((snapshot) => {
                jQuery("#total_booking_today").empty();
                jQuery("#total_booking_today").text(snapshot.docs.length);
            });

            db.collection('booked_parking_order').where('status', '==', 'placed').where('createdAt', '>=', todayDate).get().then((snapshot) => {
                jQuery("#placed_count_today").empty();
                jQuery("#placed_count_today").text(snapshot.docs.length);
            });

            db.collection('booked_parking_order').where('status', '==', 'onGoing').where('createdAt', '>=', todayDate).get().then((snapshot) => {
                jQuery("#active_count_today").empty();
                jQuery("#active_count_today").text(snapshot.docs.length);
            });

            db.collection('booked_parking_order').where('status', '==', 'completed').where('createdAt', '>=', todayDate).get().then((snapshot) => {
                jQuery("#completed_count_today").empty();
                jQuery("#completed_count_today").text(snapshot.docs.length);
            });

            db.collection('booked_parking_order').where('status', '==', 'canceled').where('createdAt', '>=', todayDate).get().then((snapshot) => {
                jQuery("#canceled_count_today").empty();
                jQuery("#canceled_count_today").text(snapshot.docs.length);
            });

            db.collection('users').where('role', '==', 'customer').where('createdAt', '>=', todayDate).get().then((snapshot) => {
                jQuery("#users_count_today").empty();
                jQuery("#users_count_today").text(snapshot.docs.length);
            });


            db.collection('booked_parking_order').get().then((snapshot) => {
                jQuery("#total_booking").empty();
                jQuery("#total_booking").text(snapshot.docs.length);
            });

            db.collection('users').where('role', '==', 'customer').get().then((snapshot) => {
                jQuery("#users_count").empty();
                jQuery("#users_count").text(snapshot.docs.length);
            });

            db.collection('users').where('role', '==', 'security').get().then((snapshot) => {
                jQuery("#security_count").empty();
                jQuery("#security_count").text(snapshot.docs.length);
            });

            db.collection('users').where('role', '==', 'owner').get().then((snapshot) => {
                jQuery("#owner_count").empty();
                jQuery("#owner_count").text(snapshot.docs.length);
            });


            db.collection('booked_parking_order').where('status', '==', 'placed').get().then((snapshot) => {
                jQuery("#placed_count").empty();
                jQuery("#placed_count").text(snapshot.docs.length);
            });

            db.collection('booked_parking_order').where('status', '==', 'onGoing').get().then((snapshot) => {
                jQuery("#active_count").empty();
                jQuery("#active_count").text(snapshot.docs.length);
            });

            db.collection('booked_parking_order').where('status', '==', 'completed').get().then((snapshot) => {
                jQuery("#completed_count").empty();
                jQuery("#completed_count").text(snapshot.docs.length);
            });

            db.collection('booked_parking_order').where('status', '==', 'canceled').get().then((snapshot) => {
                jQuery("#canceled_count").empty();
                jQuery("#canceled_count").text(snapshot.docs.length);
            });

            db.collection('parkings').get().then((snapshot) => {
                jQuery("#parking_count").empty();
                jQuery("#parking_count").text(snapshot.docs.length);
            });
            setTimeout(function () {
                getTotalEarnings();
                getTotalEarningsToday();

            }, 3000)
            $('#overlay').hide();
        });

        var append_listtop_parking = document.getElementById('append_list_top_parking');
        append_listtop_parking.innerHTML = '';
        db.collection('parkings').orderBy('reviewCount', 'desc').limit(limit).get().then((snapshots) => {
            html = '';
            html = buildParkingHTML(snapshots);
            if (html != '') {
                append_listtop_parking.innerHTML = html;
            }
        });

        function buildParkingHTML(snapshots) {

            var html = '';

            snapshots.docs.forEach((listval) => {
                val = listval.data();
                val.id = listval.id;
                id = val.id
                var parking_view = '{{route("parking-list.show",":id")}}';
                parking_view = parking_view.replace(':id', val.id);
                var route1 = '{{route("parking-list.save",":id")}}';
                route1 = route1.replace(':id', id);
                id = id.substring(0, 7);
                html = html + '<tr>';

                if (val.image == '' || val.image == null) {

                    html = html + '<td><img class="rounded" style="width:50px" src="' + defaultImg + '" alt="image"></td>';
                } else {
                    html = html + '<td><img class="rounded" style="width:50px" src="' + val.image + '" alt="image"></td>';
                }

                html += '<td><a href="' + parking_view + '">' + val.name + '</a></td>';
                var rating = 0;
                if (val.hasOwnProperty('reviewCount') && val.reviewCount && val.reviewCount != "0.0" && val.reviewCount != null && val.hasOwnProperty('reviewSum') && val.reviewSum && val.reviewSum != "0.0" && val.reviewSum != null) {

                    rating = (parseFloat(val.reviewSum) / parseFloat(val.reviewCount));
                }
                html = html + '<td class="redirecttopage"><div class="reviews-members-header"><div class="star-rating"><div class="d-inline-block" style="font-size: 14px;"> <ul class="rating" data-rating="' + parseInt(rating) + '"><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li></ul></div></div></div></td>';

                html += '<td class="action-btn"><a href="' + parking_view + '"><i class="fa fa-eye"></i></a></td>';
                html += '</tr>';

            });
            return html;

        }

        function buildChargerHTML(snapshots) {

        var html = '';

        snapshots.docs.forEach((listval) => {
            val = listval.data();
            val.id = listval.id;
            id = val.id
            var charger_view = '{{route("chargers-list.show",":id")}}';
            charger_view = charger_view.replace(':id', val.id);
            var route1 = '{{route("chargers-list.save",":id")}}';
            route1 = route1.replace(':id', id);
            id = id.substring(0, 7);
            html = html + '<tr>';

            if (val.image == '' || val.image == null) {

                html = html + '<td><img class="rounded" style="width:50px" src="' + defaultImg + '" alt="image"></td>';
            } else {
                html = html + '<td><img class="rounded" style="width:50px" src="' + val.image + '" alt="image"></td>';
            }

            html += '<td><a href="' + charger_view + '">' + val.name + '</a></td>';
            var rating = 0;
            if (val.hasOwnProperty('reviewCount') && val.reviewCount && val.reviewCount != "0.0" && val.reviewCount != null && val.hasOwnProperty('reviewSum') && val.reviewSum && val.reviewSum != "0.0" && val.reviewSum != null) {

                rating = (parseFloat(val.reviewSum) / parseFloat(val.reviewCount));
            }
            html = html + '<td class="redirecttopage"><div class="reviews-members-header"><div class="star-rating"><div class="d-inline-block" style="font-size: 14px;"> <ul class="rating" data-rating="' + parseInt(rating) + '"><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li></ul></div></div></div></td>';

            html += '<td class="action-btn"><a href="' + charger_view + '"><i class="fa fa-eye"></i></a></td>';
            html += '</tr>';

        });
        return html;

        }

        function buildBookingHTML(snapshots) {
            var html = '';
            snapshots.docs.forEach((listval) => {
                val = listval.data();
                val.id = listval.id;
                var booking_id = val.id.substring(0, 7);

                var booking_route = '<?php echo route("parking-bookings.show", ":id"); ?>';
                booking_route = booking_route.replace(':id', val.id);

                var parking_route = '<?php echo route("parking-list.show", ":id"); ?>';
                parking_route = parking_route.replace(':id', val.parkingDetails.id);

                html = html + '<tr>';

                html = html + '<td><a href="' + booking_route + '">' + booking_id + '</a></td>';

                if (val.userId != null) {
                    getUserName(val.userId, booking_id);
                }
                html = html + '<td class="user_name_' + booking_id + '"></td>';

                html = html + '<td class=""><a href="' + parking_route + '">' + val.parkingDetails.name + '</a></td>';

                if (val.hasOwnProperty("createdAt")) {
                    date = val.createdAt.toDate().toDateString();
                    time = val.createdAt.toDate().toLocaleTimeString('en-US');

                }
                html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';


            });
            return html;
        }


        async function getUserName(userId, id) {
            await db.collection('users').doc(userId).get().then(async function (snapshots) {
                var user = snapshots.data();
                if (user != undefined) {
                    var customer_view = '{{route("users.view",":id")}}';
                    customer_view = customer_view.replace(':id', userId);
                    $('.user_name_' + id).html('<a href="' + customer_view + '">' + user.fullName + '</a>');
                } else {
                    $('.user_name_' + id).html('{{trans("lang.unknown_user")}}');

                }
            });
        }

        async function getTotalEarnings() {
            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
            var v01 = 0;
            var v02 = 0;
            var v03 = 0;
            var v04 = 0;
            var v05 = 0;
            var v06 = 0;
            var v07 = 0;
            var v08 = 0;
            var v09 = 0;
            var v10 = 0;
            var v11 = 0;
            var v12 = 0;
            var currentYear = new Date().getFullYear();
            await db.collection('booked_parking_order').where('status', '==', 'completed').get().then(async function (orderSnapshots) {

                var paymentData = orderSnapshots.docs;
                var totalEarning = 0;
                var adminCommission = 0;
                var discount = 0;

                paymentData.forEach((order) => {

                    var orderData = order.data();
                    var price = 0;

                    if (orderData.subTotal != null && orderData.subTotal != '' && orderData.subTotal != undefined) {
                        price = orderData.subTotal;
                    }

                    if (orderData.coupon != undefined && orderData.coupon.amount != null) {
                        discount = orderData.coupon.amount;
                    }

                    if ((intRegex.test(discount) || floatRegex.test(discount)) && !isNaN(discount)) {
                        discount = parseFloat(discount).toFixed(decimal_degits);
                        price = price - parseFloat(discount);
                    }
                    commisionTotal = price;
                    tax = 0;
                    if (orderData.taxList != undefined && $.isArray(orderData.taxList)) {
                        for (let i = 0; i < orderData.taxList.length; i++) {
                            let taxData = orderData.taxList[i];
                            if (taxData.type == "percentage") {
                                tax = parseFloat(tax) + (parseFloat(taxData.tax) * parseFloat(price)) / 100;
                            } else {
                                tax = parseFloat(tax) + parseFloat(taxData.tax);
                            }
                        }
                    }

                    if (!isNaN(tax)) {
                        price = parseFloat(price) + parseFloat(tax);
                    }
                    if (orderData.adminCommission != undefined && orderData.adminCommission.type != undefined && orderData.adminCommission.amount > 0 && price > 0) {
                        var commission = 0;
                        if (orderData.adminCommission.type == "percentage") {
                            commission = (commisionTotal * parseFloat(orderData.adminCommission.amount)) / 100;
                        } else {
                            commission = parseFloat(orderData.adminCommission.amount);
                        }
                        adminCommission = commission + adminCommission;
                    }
                    totalEarning = parseFloat(totalEarning) + parseFloat(price);
                    if (orderData.createdAt) {
                        var orderMonth = orderData.createdAt.toDate().getMonth() + 1;
                        var orderYear = orderData.createdAt.toDate().getFullYear();
                        if (currentYear == orderYear) {
                            switch (parseInt(orderMonth)) {
                                case 1:
                                    v01 = parseFloat(v01) + parseFloat(price);
                                    break;
                                case 2:
                                    v02 = parseFloat(v02) + parseFloat(price);
                                    break;
                                case 3:
                                    v03 = parseFloat(v03) + parseFloat(price);
                                    break;
                                case 4:
                                    v04 = parseFloat(v04) + parseFloat(price);
                                    break;
                                case 5:
                                    v05 = parseFloat(v05) + parseFloat(price);
                                    break;
                                case 6:
                                    v06 = parseFloat(v06) + parseFloat(price);
                                    break;
                                case 7:
                                    v07 = parseFloat(v07) + parseFloat(price);
                                    break;
                                case 8:
                                    v08 = parseFloat(v08) + parseFloat(price);
                                    break;
                                case 9:
                                    v09 = parseFloat(v09) + parseFloat(price);
                                    break;
                                case 10:
                                    v10 = parseFloat(v10) + parseFloat(price);
                                    break;
                                case 11:
                                    v11 = parseFloat(v11) + parseFloat(price);
                                    break;
                                default :
                                    v12 = parseFloat(v12) + parseFloat(price);
                                    break;
                            }
                        }
                    }
                })
                totalEarning = parseFloat(totalEarning) - parseFloat(adminCommission);
                if (currencyAtRight) {
                    totalEarning = parseFloat(totalEarning).toFixed(decimal_degits) + "" + currentCurrency;
                    adminCommission = parseFloat(adminCommission).toFixed(decimal_degits) + "" + currentCurrency;
                } else {
                    totalEarning = currentCurrency + "" + parseFloat(totalEarning).toFixed(decimal_degits);
                    adminCommission = currentCurrency + "" + parseFloat(adminCommission).toFixed(decimal_degits);
                }

                $("#earnings_count").append(totalEarning);
                $("#admincommission_count").append(adminCommission);

                rides_data = [v01, v02, v03, v04, v05, v06, v07, v08, v09, v10, v11, v12];
                var labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
                var $salesChart = $('#sales-chart');

                salesChart($salesChart, rides_data, labels);
                serviceOverview();
                salesOverview();

            });

            jQuery("#overlay").hide();
        }


        async function getTotalEarningsToday() {
            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
            var v01 = 0;
            var v02 = 0;
            var v03 = 0;
            var v04 = 0;
            var v05 = 0;
            var v06 = 0;
            var v07 = 0;
            var v08 = 0;
            var v09 = 0;
            var v10 = 0;
            var v11 = 0;
            var v12 = 0;
            var currentYear = new Date().getFullYear();

            await db.collection('booked_parking_order').where('status', '==', "completed").where('createdAt', '>=', todayDate).get().then(async function (orderSnapshots) {

                var paymentData = orderSnapshots.docs;
                var totalEarning = 0;
                var adminCommission = 0;
                var discount = 0;

                paymentData.forEach((order) => {

                    var orderData = order.data();
                    var price = 0;

                    if (orderData.subTotal != null && orderData.subTotal != '' && orderData.subTotal != undefined) {
                        price = orderData.subTotal;
                    }

                    if (orderData.coupon != undefined && orderData.coupon.amount != null) {
                        discount = orderData.coupon.amount;
                    }

                    if ((intRegex.test(discount) || floatRegex.test(discount)) && !isNaN(discount)) {
                        discount = parseFloat(discount).toFixed(decimal_degits);
                        price = price - parseFloat(discount);
                    }
                    var CommssionTotal = price;
                    tax = 0;
                    if (orderData.taxList != undefined && $.isArray(orderData.taxList)) {
                        for (let i = 0; i < orderData.taxList.length; i++) {
                            let taxData = orderData.taxList[i];
                            if (taxData.type == "percentage") {
                                tax = tax + (parseFloat(taxData.tax) * price) / 100;
                            } else {
                                tax = tax + parseFloat(taxData.tax);
                            }
                        }
                    }

                    if (!isNaN(tax)) {
                        price = price + tax;
                    }


                    if (orderData.adminCommission != undefined && orderData.adminCommission.type != undefined && orderData.adminCommission.amount > 0 && price > 0) {
                        var commission = 0;
                        if (orderData.adminCommission.type == "percentage") {
                            commission = (CommssionTotal * parseFloat(orderData.adminCommission.amount)) / 100;
                        } else {
                            commission = parseFloat(orderData.adminCommission.amount);
                        }
                        adminCommission = commission + adminCommission;
                    }

                    totalEarning = parseFloat(totalEarning) + parseFloat(price);

                })
                totalEarning = totalEarning - adminCommission;
                if (currencyAtRight) {
                    totalEarning = parseFloat(totalEarning).toFixed(decimal_degits) + "" + currentCurrency;
                    adminCommission = parseFloat(adminCommission).toFixed(decimal_degits) + "" + currentCurrency;
                } else {
                    totalEarning = currentCurrency + "" + parseFloat(totalEarning).toFixed(decimal_degits);
                    adminCommission = currentCurrency + "" + parseFloat(adminCommission).toFixed(decimal_degits);
                }

                $("#earnings_count_today").append(totalEarning);
                $("#admincommission_count_today").append(adminCommission);

            });

            jQuery("#data-table_processing").hide();

        }


        function salesChart(chartNode, rides_data, labels) {
            var ticksStyle = {
                fontColor: '#666',
                fontStyle: 'bold'
            };

            var mode = 'index';
            var intersect = true;
            return new Chart(chartNode, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "{{trans('lang.order_plural')}}",
                            backgroundColor: '#80b140',
                            data: rides_data
                        },
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect,
                        callbacks: {
                            label: function (tooltipItem, data) {
                                let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return currentCurrency + parseFloat(value).toFixed(decimal_degits);
                            }
                        },
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: true
                    },
                    scales: {
                        yAxes: [{

                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    return currentCurrency + value.toFixed(decimal_degits);
                                }


                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        }

        function serviceOverview() {

            const data = {
                labels: [
                    "{{trans('lang.dashboard_total_orders')}}",
                    "{{trans('lang.dashboard_total_clients')}}",
                    "{{trans('lang.dashboard_total_parkings')}}",
                    "{{trans('lang.dashboard_booking_placed')}}",
                    "{{trans('lang.dashboard_booking_active')}}",
                    "{{trans('lang.dashboard_booking_completed')}}",
                    "{{trans('lang.dashboard_booking_canceled')}}",
                ],
                datasets: [{
                    data: [
                        jQuery("#total_booking").text(),
                        jQuery("#users_count").text(),
                        jQuery("#parking_count").text(),
                        jQuery("#placed_count").text(),
                        jQuery("#active_count").text(),
                        jQuery("#completed_count").text(),
                        jQuery("#canceled_count").text(),
                    ],
                    backgroundColor: [
                        '#218be1',
                        '#5865F2',
                        '#FF0000',
                        '#FFAB2E',
                        '#FF683A',
                        '#80b140',
                        '#000000',
                    ],
                    hoverOffset: 4
                }]
            };

            return new Chart('service-overview', {
                type: 'doughnut',
                data: data,
                options: {
                    maintainAspectRatio: false,
                }
            });
        }

        function salesOverview() {

            const data = {
                labels: [
                    "{{trans('lang.dashboard_total_earnings')}}",
                    "{{trans('lang.dashboard_admin_commission')}}",
                ],
                datasets: [{
                    data: [
                        jQuery("#earnings_count").text().replace(currentCurrency, ""),
                        jQuery("#admincommission_count").text().replace(currentCurrency, ""),
                    ],
                    backgroundColor: [
                        '#80b140',
                        '#000000',
                    ],
                    hoverOffset: 4
                }]
            };
            return new Chart('sales-overview', {
                type: 'doughnut',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItems, data) {
                                return data.labels[tooltipItems.index] + ': ' + currentCurrency + data.datasets[0].data[tooltipItems.index];
                            }
                        }
                    }
                }
            })
        }
    </script>
@endsection

