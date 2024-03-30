@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.reports_parking')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{url('/reports/parking')}}">{{trans('lang.report_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.reports_parking')}}</li>
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
                                <legend>{{trans('lang.reports_parking')}}</legend>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.select_status')}}</label>
                                    <div class="col-7">
                                        <select class="form-control status">
                                            <option value="true">{{trans('lang.active')}}</option>
                                            <option value="false">{{trans('lang.inactive')}}</option>
                                        </select>
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
                        <button type="submit" class="btn btn-primary download-parking-report"><i
                                class="fa fa-save"></i> {{ trans('lang.download')}}</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/objectexporter.min.js') }}"></script>
    <script>
        var database = firebase.firestore();
        var parkingRef = database.collection('parkings');
        var activeParkingData = [];
        var nonActiveParkingData = [];

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

        $(document).on('click', '.download-parking-report', function () {
            var status = $(".status :selected").val();
            var fileFormat = $(".file_format :selected").val();
            var headerArray = ['Name', 'Address', 'Owner', 'Parking For', 'Price', 'Space', 'Facility', 'Status'];
            var headers = [];
            var headers = [];
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

            $(".error_top").html("");

            if (fileFormat == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.file_format_error')}}</p>");
                window.scrollTo(0, 0);
            } else {
                jQuery("#overlay").show();
                parkingRef.get().then(async function (snapshots) {
                    if (snapshots.docs.length > 0) {
                        var filterData = await getData(snapshots);

                        ((fileFormat == "pdf") ? document.title = "parking-report" : "");
                        objectExporter({
                            type: fileFormat,
                            exportable: ((status == "true") ? activeParkingData : nonActiveParkingData),
                            headers: headers,
                            columnSeparator: ',',
                            fileName: 'parking-report',
                            headerStyle: 'font-weight: bold; padding: 5px; border: 1px solid #dddddd;',
                            cellStyle: 'border: 1px solid lightgray; margin-bottom: -1px;',
                            documentTitle: '',
                            sheetName: 'parking-report'
                        });

                        jQuery("#overlay").hide();
                        activeParkingData = [];
                        nonActiveParkingData = [];
                        $('.file_format option[value=""]').attr('selected', 'selected');
                    } else {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.not_found_data_error')}}</p>");
                        window.scrollTo(0, 0);
                    }
                });
            }
        })

        async function getData(querySnapshot) {
            var dataArray = [];
            await Promise.all(querySnapshot.docs.map(async (doc) => {
                var userObj = doc.data();
                var newUserObj = {};
                userData = await getUser(userObj.userId);
                if (userObj.hasOwnProperty('facilities')) {
                    var facilityHtml = '';
                    for (var i = 0; i < userObj.facilities.length; i++) {
                        if (i > 0) {
                            facilityHtml += '|';
                        }
                        facilityHtml += userObj.facilities[i].name;
                    }
                }
                if (symbolAtRight) {
                    price = parseFloat(userObj.perHrPrice).toFixed(decimal_degits) + currentCurrency;
                } else {
                    price = currentCurrency + parseFloat(userObj.perHrPrice).toFixed(decimal_degits);
                }
                newUserObj['Name'] = userObj.name;
                newUserObj['Address'] = userObj.address;
                newUserObj['Owner'] = ((userData.fullName) ? userData.fullName : "");
                newUserObj['Parking For'] = (userObj.parkingType) ? userObj.parkingType + " {{trans('lang.wheeler')}}" : "";
                newUserObj['Price'] = price + "/hr";
                newUserObj['Space'] = userObj.parkingSpace;
                newUserObj['Facility'] = facilityHtml;
                newUserObj['Status'] = ((userObj.isEnable) ? 'Active' : 'In-active');
                if (userObj.isEnable) {
                    activeParkingData.push(newUserObj);
                } else {
                    nonActiveParkingData.push(newUserObj);
                }
                dataArray.push(newUserObj);
            }));
            return dataArray;
        }

        async function getUser(userId) {
            var userData = '';
            if (userId) {
                await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {
                    if (snapshots.docs.length > 0) {
                        userData = snapshots.docs[0].data();
                    }
                });
            }
            return userData;
        }

    </script>
@endsection
