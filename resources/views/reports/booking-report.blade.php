@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.reports_booking')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{url('/reports/booking')}}">{{trans('lang.report_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.reports_booking')}}</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card  pb-4">

                <div class="card-body">
                    <div id="data-table_processing" class="dataTables_processing panel panel-default"
                         style="display: none;">{{trans('lang.processing')}}</div>
                    <div class="error_top"></div>

                    <div class="row restaurant_payout_create">
                        <div class="restaurant_payout_create-inner">
                            <fieldset>
                                <legend>{{trans('lang.reports_booking')}}</legend>


                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_user')}}</label>
                                    <div class="col-7">
                                        <select class="form-control customer">
                                            <option value="">{{trans('lang.all')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_parking')}}</label>
                                    <div class="col-7">
                                        <select class="form-control parking">
                                            <option value="">{{trans('lang.all')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_booking_status')}}</label>
                                    <div class="col-7">
                                        <select class="form-control status">
                                            <option value="">{{trans('lang.all')}}</option>
                                            <option value="placed">{{ trans('lang.placed')}}</option>
                                            <option value="onGoing">{{ trans('lang.ongoing')}}</option>
                                            <option value="completed">{{ trans('lang.completed')}}</option>
                                            <option value="canceled">{{ trans('lang.canceled')}}</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.select_payment_method')}}</label>
                                    <div class="col-7">
                                        <select class="form-control payment_method">
                                            <option value="">{{trans('lang.all')}}</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.select_date')}}</label>
                                    <div class="col-7">
                                        <div id="reportrange"
                                             style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                            <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span> <i class="fa fa-caret-down"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.file_format')}}<span
                                            class="required-field"></span></label>
                                    <div class="col-7">
                                        <select class="form-control file_format">
                                            <option value="">{{trans('lang.file_format')}}</option>
                                            <option value="csv">{{trans('lang.csv')}}</option>
                                            <option value="pdf">{{trans('lang.pdf')}}</option>
                                        </select>
                                    </div>
                                </div>

                            </fieldset>
                        </div>
                    </div>

                    <div class="form-group col-12 text-center btm-btn">
                        <button type="submit" class="btn btn-primary download-user-report"><i
                                class="fa fa-save"></i> {{ trans('lang.download')}}</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <script>
        var database = firebase.firestore();
        var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');
        var parkingRef = database.collection('parkings').orderBy('name');
        var customerRef = database.collection('users').orderBy('fullName');
        var paymentMethodRef = database.collection('settings').doc('payment');

        setDate();

        function setDate() {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
        }

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

        parkingRef.get().then(function (snapShots) {

            if (snapShots.docs.length > 0) {

                snapShots.docs.forEach((listval) => {
                    var data = listval.data();

                    $('.parking').append('<option value="' + data.id + '">' + data.name + '</option>');
                });

            }
        });

        paymentMethodRef.get().then(function (snapShots) {

            var data = snapShots.data();
            Object.keys(data).forEach((listval) => {

                $('.payment_method').append($("<option value='" + data[listval].name + "'>" + data[listval].name + "</option>"));
            });
        });

        customerRef.get().then(function (snapShots) {

            if (snapShots.docs.length > 0) {

                snapShots.docs.forEach((listval) => {
                    var data = listval.data();

                    $('.customer').append('<option value="' + data.id + '">' + data.fullName + '</option>');
                });

            }
        });

        async function getUser(userId) {
            var userData = '';
            if (userId) {
                await customerRef.where('id', '==', userId).get().then(async function (snapshots) {
                    if (snapshots.docs.length > 0) {
                        userData = snapshots.docs[0].data();
                    }
                });
            }
            return userData;
        }


        async function generateReport(orderData, headers, fileFormat) {

            if ((fileFormat == "pdf") ? document.title = "booking-report" : "") ;

            objectExporter({
                type: fileFormat,
                exportable: orderData,
                headers: headers,
                fileName: 'booking-report',
                columnSeparator: ',',
                headerStyle: 'font-weight: bold; padding: 5px; border: 1px solid #dddddd;',
                cellStyle: 'border: 1px solid lightgray; margin-bottom: -1px;',
                documentTitle: 'booking-report',
                sheetName: 'booking-report',
            });
        }

        async function getReportData(orderSnapshots, fileFormat) {

            var orderData = [];

            await Promise.all(orderSnapshots.docs.map(async (order) => {

                var orderObj = order.data();

                var orderId = orderObj.id;
                var finalOrderObject = {};

                var userData = await getUser(orderObj.userId);

                var parkingTitle = orderObj.parkingDetails.name;
                var date = orderObj.createdAt.toDate();

                var slotId = orderObj.parkingSlotId;
                var bookingDate = '';
                var time = '';
                if (orderObj.hasOwnProperty("bookingDate")) {
                    bookingDate = orderObj.bookingDate.toDate().toDateString();
                }
                if (orderObj.hasOwnProperty("bookingStartTime") && orderObj.hasOwnProperty('bookingEndTime')) {
                    startTime = orderObj.bookingStartTime.toDate().toLocaleTimeString('en-US');
                    endTime = orderObj.bookingEndTime.toDate().toLocaleTimeString('en-US');
                    time = startTime + " - " + endTime;
                }

                var paymentStatus = ((orderObj.paymentCompleted == true) ? "Paid" : "Not Paid");

                var parkingAddress = orderObj.parkingDetails.address;
                var amount = 0;
                if (orderObj.subTotal) {
                    amount = parseFloat(orderObj.subTotal);

                }
                var discount_amount = 0;
                if (orderObj.hasOwnProperty('coupon') && orderObj.coupon.enable) {
                    var data = orderObj.coupon;

                    if (data.type == "fix") {
                        discount_amount = data.amount;
                    } else {
                        discount_amount = (data.amount * amount) / 100;
                    }

                    amount -= parseFloat(discount_amount);

                }


                if (orderObj.hasOwnProperty('taxList') && orderObj.taxList.length > 0) {
                    var taxData = orderObj.taxList;

                    var tax_amount_total = 0;
                    for (var i = 0; i < taxData.length; i++) {

                        var data = taxData[i];

                        if (data.enable) {

                            var tax_amount = data.tax;

                            if (data.type == "percentage") {

                                tax_amount = (data.tax * amount) / 100;
                            }

                            tax_amount_total += parseFloat(tax_amount);

                        }
                    }
                    amount += parseFloat(tax_amount_total);


                }
                if (symbolAtRight) {
                    amount = parseFloat(amount).toFixed(decimal_degits) + currentCurrency;

                } else {
                    amount = currentCurrency + parseFloat(amount).toFixed(decimal_degits);

                }

                if (fileFormat == "csv") {
                    parkingAddress = parkingAddress.replace(/,/g, '');
                }

                finalOrderObject['Order ID'] = orderId;

                finalOrderObject['User Name'] = ((userData.fullName) ? userData.fullName : "");
                finalOrderObject['User Email'] = ((userData.email) ? userData.email : "");
                finalOrderObject['User Phone'] = userData && userData.phoneNumber ? ('(+' + (userData.countryCode.includes('+') ? userData.countryCode.slice(1) : userData.countryCode) + ') ' + userData.phoneNumber) : '';
                finalOrderObject['Created At'] = moment(date).format('ddd MMM DD YYYY h:mm:ss A');
                finalOrderObject['Parking Name'] = parkingTitle;
                finalOrderObject['Address'] = parkingAddress;
                finalOrderObject['Slot'] = slotId;
                finalOrderObject['Booking Date'] = bookingDate;
                finalOrderObject['Time'] = time;
                finalOrderObject['Amount'] = amount;
                finalOrderObject['Payment Method'] = orderObj.paymentType;
                finalOrderObject['Payment Status'] = paymentStatus;
                finalOrderObject['Status'] = orderObj.status;
                orderData.push(finalOrderObject);
            }));

            return orderData;
        }

        $(document).on('click', '.download-user-report', function () {

            var customer = $(".customer :selected").val();
            var parking = $(".parking :selected").val();
            var status = $(".status :selected").val();
            var payment_method = $(".payment_method :selected").val();
            var fileFormat = $(".file_format :selected").val();
            let start_date = moment($('#reportrange').data('daterangepicker').startDate).toDate();
            let end_date = moment($('#reportrange').data('daterangepicker').endDate).toDate();

            var headerArray = ['Order ID', 'User Name', 'User Email', 'User Phone', 'Created At', 'Parking Name', 'Address', 'Slot', 'Booking Date', 'Time', 'Amount', 'Payment Method', 'Payment Status', 'Status'];


            var headers = [];

            $(".error_top").html("");

            if (fileFormat == 'xls' || fileFormat == 'csv') {
                headers = headerArray;
                var script = document.createElement("script");
                script.setAttribute("src", "https://unpkg.com/object-exporter@3.2.1/dist/objectexporter.min.js");
                script.setAttribute("async", "false");
                var head = document.head;
                head.insertBefore(script, head.firstChild);
            } else {
                for (var k = 0; k < headerArray.length; k++) {
                    headers.push({
                        alias: headerArray[k],
                        name: headerArray[k],
                        flex: 1,
                    });
                }

                var script = document.createElement("script");
                script.setAttribute("src", "{{ asset('js/objectexporter.min.js') }}");
                script.setAttribute("async", "false");
                var head = document.head;
                head.insertBefore(script, head.firstChild);

            }

            if (fileFormat == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.file_format_error')}}</p>");
                window.scrollTo(0, 0);
            } else {
                jQuery("#overlay").show();

                var ordersRef = database.collection('booked_parking_order').orderBy('createdAt', 'desc');

                if (customer != "") {
                    ordersRef = ordersRef.where('userId', '==', customer)
                }

                if (parking != "") {
                    ordersRef = ordersRef.where('parkingId', '==', parking)
                }

                if (status != "") {
                    ordersRef = ordersRef.where('status', '==', status)
                }

                if (payment_method != "") {
                    ordersRef = ordersRef.where('paymentType', '==', payment_method)
                }


                if (start_date != "") {
                    ordersRef = ordersRef.where('createdAt', '>=', start_date)
                }

                if (end_date != "") {
                    ordersRef = ordersRef.where('createdAt', '<=', end_date)
                }

                ordersRef.get().then(async function (orderSnapshots) {

                    if (orderSnapshots.docs.length > 0) {
                        var reportData = await getReportData(orderSnapshots, fileFormat);

                        generateReport(reportData, headers, fileFormat);

                        jQuery("#overlay").hide();
                        setDate();
                        $('.file_format').val('').trigger('change');
                        $('.customer').val('').trigger('change');
                        $('.parking').val('').trigger('change');
                        $('.status').val('').trigger('change');
                        $('.payment_method').val('').trigger('change');

                    } else {
                        jQuery("#overlay").hide();
                        setDate();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.not_found_data_error')}}</p>");
                        window.scrollTo(0, 0);

                    }

                }).catch((error) => {

                    jQuery("#overlay").show();

                    console.log("Error getting documents: ", error);
                    $(".error_top").show();
                    $(".error_top").html(error);
                    window.scrollTo(0, 0);
                });
            }
        });

    </script>
@endsection
