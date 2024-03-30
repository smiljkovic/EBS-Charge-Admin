@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.charger_details')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{!! route('chargers-list') !!}">{{trans('lang.chargers_list')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ trans('lang.charger_details')}}

                    </li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row no_data_found">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="card card-block p-card">
                                        <div class="profile-box">
                                            <div class="profile-card rounded">
                                                <img src="" alt="profile-bg"
                                                     class="avatar-100 d-block mx-auto img-fluid mb-3  avatar-rounded user-image">
                                                <h3 class="font-600 text-white text-center charger-name"></h3>
                                                <div class="font-600 text-white text-center mb-3 charger-ratings"></div>

                                            </div>
                                            <div class="pro-content rounded">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="p-icon mr-3">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                    <p class="mb-0 eml charger-owner"></p>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="p-icon mr-3">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                    <p class="mb-0 eml location"></p>
                                                </div>


                                            </div>

                                            <div class="personal-detail">
                                                <h3></h3>
                                                <div class="table-responsive user-list-table">
                                                    <table class="table mb-0">
                                                        <tbody id="charger-detail">
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span
                                                                    class="font-weight-bold w-100">{{trans("lang.assign_to")}}:</span>
                                                            </td>
                                                            <td class="py-2 px-0 assign_to"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span
                                                                    class="font-weight-bold w-100">{{trans("lang.charger_for")}}:</span>
                                                            </td>
                                                            <td class="py-2 px-0 type"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span
                                                                    class="font-weight-bold w-100">{{trans("lang.charger_space")}}:</span>
                                                            </td>
                                                            <td class="py-2 px-0 space"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span
                                                                    class="font-weight-bold w-100">{{trans("lang.price")}}:</span>
                                                            </td>
                                                            <td class="py-2 px-0 price"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span
                                                                    class="font-weight-bold w-100">{{trans("lang.status")}}:</span>
                                                            </td>
                                                            <td class="py-2 px-0 enable"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Nikola - replaced parking_facilities with charging_facilities -->
                                            <!-- <div class="personal-detail">
                                                <h3>{{trans("lang.parking_facilities")}}</h3>
                                                <div class="rules-list">
                                                    <ul id="facilities"></ul>

                                                </div>

                                            </div> -->

                                            <div class="personal-detail">
                                                <h3>{{trans("lang.charging_facilities")}}</h3>
                                                <div class="rules-list">
                                                    <ul id="facilities"></ul>

                                                </div>

                                            </div>

                                            <div class="personal-detail mb-0">
                                                <h3>{{trans("lang.description")}}</h3>
                                                <div class="description"></div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card card-block card-stretch">
                                <div class="card-header">
                                    <h3 class="card-title">{{trans("lang.charger_slots")}}</h3>
                                    <div class="row mt-2 date-time-row">
                                        <div class="col-md-5">
                                            <div class="date-box">
                                                <label class="control-label">{{trans("lang.date")}}</label>
                                                <input type="date" id="booking-date"
                                                       value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="fr-to-box d-flex">
                                                <div class="from-box">
                                                    <label class="control-label">{{trans("lang.from")}}</label>
                                                    <input type="time" id="from-time"
                                                           pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$">
                                                </div>
                                                <div class="to-box">
                                                    <label class="control-label">{{trans("lang.to")}}</label>
                                                    <input type="time" id="to-time"
                                                           pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$">
                                                </div>
                                            </div>
                                            <div class="bar-box range-wrap">
                                                <input type="range" value="2" id="duration" name="duration"
                                                       class="duration"
                                                       min="1" max="24">
                                                <label class="control-label">{{trans("lang.duration")}}: <span
                                                        id="selected_uration">2</span> {{trans("lang.hours")}}
                                                    {{trans("lang.hours_min_max")}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">

                                    <div class="row slots">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-12 text-center btm-btn doc-footer">
            <a href="{!! route('chargers-list') !!}" class="btn btn-default"><i
                    class="fa fa-undo cancel-btn"></i>{{trans('lang.back')}}</a>
        </div>

    </div>

    <div class="modal fade" id="assignUserModal" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered location_modal">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title locationModalTitle">{{trans('lang.assign_to')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <form class="">
                        <div class="form-row">

                            <div class="form-group row">
                                <div class="form-group row width-100">
                                    <label class="col-12 control-label">{{trans('lang.security')}}</label>
                                    <div class="col-12">
                                        <select name="security" id="security" class="form-control security">
                                            <option value="">{{ trans("lang.select_security") }}</option>

                                        </select>
                                        <div id="security_error" style="color:red"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"
                                    id="assign-user-btn">{{trans('lang.submit')}} </button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                    aria-label="Close">{{trans('lang.close')}} </button>
                        </div>
                    </form>
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
        var id = requestId;
        var ref = database.collection('facilities');
        var storageRef = firebase.storage().ref('images');
        var storage = firebase.storage();
        var photo = "";
        var fileName = "";
        var userImageFile = '';
        var placeholderImage = "{{ asset('/images/default_user.png') }}";
        var googleMapkey = '';
        var decimal_degits = 0;
        var symbolAtRight = false;
        var currentCurrency = '';
        var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');


        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            decimal_degits = currencyData.decimalDigits;
            if (currencyData.symbolAtRight) {
                symbolAtRight = true;
            }
        });
        var bookedSlot = [];
        var bookedSlotId = [];
        var refBooking = database.collection('booked_charger_order').where('chargerId', '==', id).where('status', 'in', ['placed', 'onGoing']).get().then(async function (snapshot) {
            if (snapshot.docs.length > 0) {
                snapshot.docs.forEach((listval) => {
                    var val = listval.data();
                    date = val.bookingDate.toDate().toDateString();

                    bookedSlot.push(val);
                    bookedSlotId.push(val.chargerSlotId);

                });
            }
        });

        function getTwentyFourFormat(h, timeslot) {

            if (timeslot == "PM" && h > 12) {
                h = parseInt(h) + 12;
            } else if (h < 10 && timeslot == "AM") {

                h = '0' + h;
            }
            return h;
        }

        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();

        var formattedTime = hours.toString().padStart(2, '0') + ':' +
            minutes.toString().padStart(2, '0');

        $('#from-time').val(formattedTime);

        var duration = $('#duration').val();
        var totime = (parseInt(formattedTime.split(':')[0]) + parseInt(duration));
        totime = (totime < 10 ? '0' + totime : totime);
        if (totime >= 24) {
            var to = "23:59";
        } else {
            var to = totime + ":" + formattedTime.split(':')[1];

        }
        document.getElementById("to-time").value = to;

        async function getSlotData(val = '') {
            var selectedDate = $('#booking-date').val();
            var from_time = $('#from-time').val();
            var to = $('#to-time').val();
            var timeDuration = $('#duration').val();

            var duration = 2;
            if (timeDuration != '') {
                duration = parseInt(timeDuration);
                $('#duration').attr('data-range', duration);
                if (duration == 1) {
                    $('#selected_uration').text(duration + " " + "{{trans('lang.hour')}}");
                } else {
                    $('#selected_uration').text(duration + " " + "{{trans('lang.hours')}}");
                }
            }

            if (val) {
                if (from_time != '' && val.id == 'from-time' || val.id == 'duration') {

                    var h = (parseInt(from_time.split(':')[0]) + duration);
                    h = (h < 10 ? '0' + h : h);

                    if (h >= 24) {
                        to = "23:59";
                    } else {
                        to = h + ":" + from_time.split(':')[1];

                    }

                    document.getElementById("to-time").value = to;
                }

                if (to != '' && val.id == 'to-time') {

                    var h = (parseInt(to.split(':')[0]) - duration);
                    if (h < 0) {
                        from_time = "00:00";
                    } else {
                        if (h < 10) {
                            h = "0" + h;
                        }
                        from_time = h + ":" + to.split(':')[1];
                    }

                    document.getElementById("from-time").value = from_time;
                }
            }
            var from_time = $('#from-time').val();
            var to = $('#to-time').val();


            var selectedStartTime = new Date(selectedDate + " " + from_time);
            var selectedEndTime = new Date(selectedDate + " " + to);

            const startfirebaseTimestamp = firebase.firestore.Timestamp.fromDate(selectedStartTime);
            const endFirebaseTimestamp = firebase.firestore.Timestamp.fromDate(selectedEndTime);


            var ridesRef = await database.collection('booked_charger_order').where('chargerId', '==', id).where('status', 'in', ['placed', 'onGoing']);
            var startQuery = ridesRef.where('bookingStartTime', '>=', startfirebaseTimestamp).where('bookingStartTime', '<=', endFirebaseTimestamp);

            $('.charger_slot').text('').addClass('charger-available ');
            $('.charger_slot').append('{{trans("lang.available")}}');
            var finalResults = [];

            var endQuery = ridesRef.where('bookingEndTime', '>=', startfirebaseTimestamp).where('bookingEndTime', '<=', endFirebaseTimestamp);
            await Promise.all([startQuery.get(), endQuery.get()])
                .then(function (querySnapshots) {
                    var startResults = querySnapshots[0].docs.map(doc => doc.data());
                    var endResults = querySnapshots[1].docs.map(doc => doc.data());

                    console.log(startResults);
                    console.log(endResults);
                    finalResults = startResults.concat(endResults);

                })
                .catch(function (error) {
                    console.error('Error retrieving data:', error);
                });


            for (var i = 0; i < finalResults.length; i++) {
                var val = finalResults[i];

                if ((val.bookingStartTime >= startfirebaseTimestamp && val.bookingStartTime <= endFirebaseTimestamp) ||
                    (val.bookingEndTime >= startfirebaseTimestamp && val.bookingEndTime <= endFirebaseTimestamp)) {
                        // TODO Nikola - handle parking-bookings
                    var booking_route = "{{route('parking-bookings.show',':id')}}";
                    booking_route = booking_route.replace(':id', val.id);

                    $('#' + val.parkingSlotId).text('').removeClass('parking-available ');
                    $('#redirect_' + val.parkingSlotId).attr('href', booking_route);
                    $('#' + val.parkingSlotId).append('<img src="{{asset('images/car_model_1.png')}}" width="50px" >');
                }
            }
        }

        $('#booking-date,#from-time,#to-time,#duration').change(async function (e) {

            jQuery("#overlay").show();
            await getSlotData(this);

            jQuery("#overlay").hide();

        });

        $(document).ready(function () {
            jQuery("#overlay").show();
            if (requestId != '') {

                var ref = database.collection('chargers').where("id", "==", id);
                ref.get().then(async function (snapshots) {
                    if (snapshots.docs.length > 0) {
                        var data = snapshots.docs[0].data();
                        getUserName(data.userId);
                        $('.charger-name').text(data.name);
                        if (data.image == '' || data.image == null) {
                            $(".user-image").attr('src', placeholderImage);
                        } else {
                            $(".user-image").attr('src', data.image);
                        }

                        if (data.isEnable) {
                            $('.enable').html('<span class="py-2 px-3 badge badge-success">{{trans("lang.active")}}</span>');
                        } else {
                            $('.enable').html('<span class="py-2 px-3 badge badge-danger">{{trans("lang.inactive")}}</span>');

                        }
                        var rating = 0;
                        if (data.hasOwnProperty('reviewCount') && data.reviewCount && data.reviewCount != "0.0" && data.reviewCount != null && data.hasOwnProperty('reviewSum') && data.reviewSum && data.reviewSum != "0.0" && data.reviewSum != null) {

                            rating = (parseFloat(data.reviewSum) / parseFloat(data.reviewCount));
                        }
                        $('.charger-ratings').html('<span class="badge badge-warning text-white dr-review"><i class="fa fa-star"></i>' + (rating).toFixed(1) + '</span>');

                        $('.location').text(data.address);

                        $('.description').text(data.description);
                        $('.space').text(data.chargerSpace);
                        $('.type').text(data.chargerType + " {{trans('lang.wheeler')}}");

                        var assign_to = await getAssignUserDetails(data.id);

                        $('.assign_to').html(assign_to);

                        var price = 0;
                        if (symbolAtRight == true) {
                            price = parseFloat(data.perHrPrice).toFixed(decimal_degits) + currentCurrency + "/hr";
                        } else {
                            price = currentCurrency + parseFloat(data.perHrPrice).toFixed(decimal_degits) + "/hr";

                        }
                        $('.price').text(price);
                        if (data.facilities) {
                            var html = '';
                            for (var i = 0; i < data.facilities.length; i++) {
                                val = data.facilities[i];
                                html += '<li>';
                                html += '<span class="rule-img"><img  style="width:50px" src=" ' + val.image + ' " /></span>';
                                html += '<span class="font-weight-bold w-100">' + val.name + '</span>';
                                html += '</li>';
                                $('#facilities').html(html);
                            }

                        } else {
                            html += '<tr><td>{{trans("lang.no_facilities_found")}}</td></tr>';
                            $("#facilities").html(html);
                        }
                        var space = data.chargerSpace;
                        var slotHtml = '';

                        for (var i = 1; i <= space; i++) {
                            var slotId = "A-" + i;
                            slotHtml += '<div class="col-lg-3 col-md-3 col-12"><div class="charger-slot-block"><div class="d-flex align-items-center charger-slot-box">';
                            slotHtml += '<a href="javascript:void(0)" id="redirect_' + slotId + '"><span class="slot-number">' + slotId + '</span>';

                            slotHtml += '<span class="slotcar-img charger-available charger_slot" id="A-' + i + '">{{trans("lang.available")}}</span>';

                            slotHtml += '</a></div></div></div>';
                        }
                        $('.slots').append(slotHtml);
                    } else {
                        $('.no_data_found').html('<p align="center">{{trans("lang.no_data_found")}}</p>');

                    }

                    await getSlotData();
                    jQuery("#overlay").hide();
                })
            }


        });

        async function getAssignUserDetails(chargerId) {
            var userName = '';
            await database.collection('users').where('chargerId', '==', chargerId).get().then(async function (snapshot) {
                if (snapshot.docs.length > 0) {
                    var data = snapshot.docs[0].data();
                    userName = data.fullName;

                } else {
                    userName = '{{trans("lang.not_assign")}}';
                }
            });
            return userName;
        }

        function getUserName(userId) {
            database.collection('users').where('id', '==', userId).get().then(async function (snapshot) {

                if (snapshot.docs.length) {
                    var data = snapshot.docs[0].data();
                    $('.charger-owner').text(data.fullName);
                } else {
                    $('.charger-owner').text("{{trans('lang.unknown_user')}}");
                }

            })
        }

        async function getBookingInfo(slotId) {
            var bookingId = '';
            await database.collection('booked_charger_order').where('chargerId', '==', id).where('chargerSlotId', '==', slotId).where('status', '==', 'onGoing').get().then(async function (snapshot) {
                if (snapshot.docs.length > 0) {
                    data = snapshot.docs[0].data();
                    bookingId = data.id;
                }
                return bookingId;

            });
            return bookingId;

        }

        $("#assign-user-btn").click(async function () {

            var security = $('#security').val();
            if (security == '') {
                $('#security_error').text('{{trans("lang.select_security")}}');
                return false;
            }

            var check_flag = true;

            if (id) {
                await database.collection('users').where('chargerId', '==', id).get().then(function (snapshots) {

                    if (snapshots.docs.length > 0) {
                        check_flag = false;
                    }
                });
            }
            if (check_flag) {
                database.collection('users').doc(security).update({
                    'chargerId': id
                }).then(async function (result) {

                    window.location.reload();

                });

            } else {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.charger_assign_error')}}</p>");
                window.scrollTo(0, 0);
            }


        });

    </script>
@endsection
