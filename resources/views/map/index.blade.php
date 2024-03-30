@extends('layouts.app')

<style>
    #append_list12 tr {
        cursor: pointer;
    }

    #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 11px;
        border: 1px solid #000;
    }

    #legend h3 {
        margin-top: 0;
    }

    #legend img {
        vertical-align: middle;
    }
</style>
@section('content')

    <div class="page-wrapper">

        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.live_tracking')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{trans('lang.live_tracking')}}
                    </li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">

            <div class="card mb-3">

                <div class="card-body">

                    <div class="row">

                        <div class="col-lg-4">

                            <div class="table-responsive ride-list">

                                <div id="overlay" style="display:none">
                                    <img src="{{ asset('images/spinner.gif') }}">
                                </div>

                                <div class="live-tracking-list">

                                </div>
                                <div id="load-more-div" style="display:none"><a href="javascript:void(0)"
                                                                                class="btn btn-primary btn-sm"
                                                                                id="load-more">Load More</a></div>

                            </div>

                        </div>

                        <div class="col-lg-8">

                            <div id="map" style="height:450px"></div>

                            <div id="legend"><h3>Legend</h3></div>

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

        var map;
        var marker;
        var markers = [];
        var map_data = [];
        var base_url = '{!! asset('/images/') !!}';

        var itemsPerPage = 5;
        var currentPage = 1;
        var rides = [];
        var parkings = [];
        var arrayParkingData = [];

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


        $(document).ready(async function () {

            jQuery("#overlay").show();

            var database = firebase.firestore();

            var ride_parkings = [];
            await database.collection('booked_parking_order').where('status', '==', 'onGoing').orderBy('createdAt', 'desc').get().then(async function (snapshots) {
                if (snapshots.docs.length > 0) {
                    snapshots.docs.forEach(async function (doc) {
                        var data = doc.data();

                        arrayParkingData.push(data);
                        if ($.inArray(data.parkingId, ride_parkings) === -1) {
                            ride_parkings.push(data.parkingId);
                            data.flag = 'on_ride';

                            rides.push(data);
                        }
                    });
                }
            });


            await database.collection('parkings').where('parkingSpace', '>=', '0').get().then(async function (snapshots) {
                if (snapshots.docs.length > 0) {
                    snapshots.docs.forEach((doc) => {
                        var data = doc.data();
                        data.flag = 'available';
                        if ($.inArray(data.id, ride_parkings) === -1) {
                            parkings.push(data);
                        }
                    });
                }

            });

            let mapdata = $.merge(rides, parkings);
            setTimeout(function () {
                loadData(mapdata, currentPage);
            }, 3000);


            setTimeout(function () {
                $(".sidebartoggler").click();
            }, 500);
        });

        $(document).on("click", ".ride-list .track-from", function () {
            var lat = $(this).data('lat');
            var lng = $(this).data('lng');
            var index = $(this).data('index');
            map.panTo(new google.maps.LatLng(lat, lng));
            google.maps.event.trigger(markers[index], 'click');
        });

        function InitializeGodsEyeMap() {

            var default_lat = getCookie('default_latitude');
            var default_lng = getCookie('default_longitude');

            var myLatlng = new google.maps.LatLng(default_lat, default_lng);
            var infowindow = new google.maps.InfoWindow();
            var legend = document.getElementById('legend');

            var mapOptions = {
                zoom: 10,
                center: myLatlng,
                streetViewControl: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map"), mapOptions);

            var fliter_icons = {
                available: {
                    name: 'Available',
                    icon: base_url + '/available.png'
                },
                ontrip: {
                    name: 'Booked',
                    icon: base_url + '/ontrip.png'
                }
            };

            for (var key in fliter_icons) {
                var type = fliter_icons[key];
                var name = type.name;
                var icon = type.icon;
                var div = document.createElement('div');
                div.innerHTML = '<img src="' + icon + '"> ' + name;
                legend.appendChild(div);
            }

            map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);

        }

        async function loadData(data, page) {
            var startIndex = (page - 1) * itemsPerPage;
            var endIndex = startIndex + itemsPerPage;
            var itemsToDisplay = data.slice(startIndex, endIndex);
            itemsToDisplay.forEach(async (item, i) => {

                val = item;

                var html = '';

                if (val.flag == "on_ride") {
                    var parkingId = val.parkingId;
                } else {
                    var parkingId = val.id;
                }

                let parking = await getParkingDetail(parkingId);
                let bookingSlot = '';
                if (parking != undefined) {
                    bookingSlot = await getBookingSlot(parkingId, parking.parkingSpace);

                }

                if (val.flag == "on_ride") {

                    let user = await getUserDetail(val.userId);

                    if (user != undefined) {
                        html += '<div class="live-tracking-box track-from" data-index="' + i + '" data-lat="' + parking.location.latitude + '" data-lng="' + parking.location.longitude + '">';
                        html += '<div class="live-tracking-inner">';
                        html += '<span class="listicon"></span>';
                        html += '<h3 class="drier-name">{{trans("lang.parking_name")}} : ' + parking.name + '</h3>';
                        if (parking.address) {
                            html += '<div class="location-ride">';
                            html += '<div class="to-ride"><span>' + parking.address + '</span></div>';
                            html += '</div>';
                        }


                        if (bookingSlot != "") {
                            html += '<div class="row">' + bookingSlot + '</div>';
                        }


                        html += '</div>';
                        html += '</div>';

                    }

                } else {
                    html += '<div class="live-tracking-box track-from" data-lat="' + parking.location.latitude + '" data-lng="' + parking.location.longitude + '">';
                    html += '<div class="live-tracking-inner">';
                    html += '<span class="listicon"></span>';
                    html += '<h3 class="drier-name">{{trans("lang.parking_name")}} : ' + parking.name + '</h3>';
                    if (bookingSlot != "") {
                        html += '<div class="row">' + bookingSlot + '</div>';
                    }
                    html += '<span class="badge badge-success">Available<span>';
                    html += '</div>';
                    html += '</div>';
                }

                $(".live-tracking-list").append(html);

                if (parking != undefined) {
                    if (typeof parking.location.latitude != 'undefined' && typeof parking.location.longitude != 'undefined') {

                        let iconImg = '';
                        let position = '';

                        if (val.flag == "available") {
                            iconImg = base_url + '/car_available.png';
                        } else {
                            iconImg = base_url + '/car_on_trip.png';
                        }

                        let marker = new google.maps.Marker({
                            position: new google.maps.LatLng(parking.location.latitude, parking.location.longitude),
                            icon: {
                                url: iconImg,
                                scaledSize: new google.maps.Size(25, 25)
                            },
                            map: map
                        });


                        if (val.userVehicle != undefined) {
                            var content = `
                    <div class="p-2">
                        <h6>{{trans('lang.parking_name')}} : ${parking.name ?? '-'} </h6>
                        <h6>{{trans('lang.hour')}} : ${(symbolAtRight) ? (parseFloat(parking.perHrPrice).toFixed(decimal_degits) + "" + currentCurrency) : (currentCurrency + "" + parseFloat(parking.perHrPrice).toFixed(decimal_degits)) ?? '-'} </h6>
                        <h6>{{trans('lang.brand')}} : ${(val.userVehicle.vehicleBrand.name) ? val.userVehicle.vehicleBrand.name : "-" ?? '-'} </h6>
                        <h6>{{trans('lang.model')}} : ${(val.userVehicle.vehicleModel.name) ? val.userVehicle.vehicleModel.name : "-" ?? '-'} </h6>
                        <h6>{{trans('lang.vehicle_number')}} : ${(val.userVehicle.vehicleNumber) ? val.userVehicle.vehicleNumber : "-" ?? '-'} </h6>
                    </div>`;
                        } else {
                            var content = `
                    <div class="p-2">
                        <h6>{{trans('lang.parking_name')}} : ${parking.name ?? '-'} </h6>
                        <h6>{{trans('lang.hour')}} : ${(symbolAtRight) ? (parseFloat(parking.perHrPrice).toFixed(decimal_degits) + "" + currentCurrency) : (currentCurrency + "" + parseFloat(parking.perHrPrice).toFixed(decimal_degits)) ?? '-'} </h6>
                    </div>`;
                        }

                        let infowindow = new google.maps.InfoWindow({
                            content: content
                        });

                        marker.addListener('click', function () {
                            infowindow.open(map, marker);
                        });

                        markers.push(marker);

                        marker.setMap(map);

                        setInterval(function () {
                            locationUpdate(marker, parking);
                        }, 10000);
                    }
                }
            });

            async function locationUpdate(marker, parking) {

                marker.setPosition(new google.maps.LatLng(parking.location.latitude, parking.location.longitude));

            }

            if (endIndex >= data.length) {
                $('#load-more-div').css('display', 'none');
            } else {
                $('#load-more-div').css('display', 'block');

            }
            jQuery("#overlay").hide();

        }

        $('#load-more').on('click', function () {
            currentPage++;
            let mapdata = $.merge(rides, parkings);
            loadData(mapdata, currentPage);
        });


        async function getUserDetail(userId) {
            return database.collection("users").doc(userId).get().then((doc) => {
                return doc.data();
            });
        }

        async function getParkingDetail(parkingId) {
            return database.collection("parkings").doc(parkingId).get().then((doc) => {
                return doc.data();
            });
        }

        async function getBookingSlot(parkingId, parkingSpace) {

            var availableSlot = [];
            for (var i = 1; i <= parkingSpace; i++) {
                var slotId = "A-" + i;
                availableSlot.push(slotId);
            }

            var slotHtml = '';

            var bookedSlot = [];
            var parkingData = [];

            for (let i = 0; i < arrayParkingData.length; i++) {

                var val = arrayParkingData[i];

                if (val.parkingId == parkingId) {
                    if ($.inArray(val.parkingSlotId, bookedSlot) === -1) {

                        let userName = await getUserDetail(val.userId);

                        var object = {
                            parkingSlotId: val.parkingSlotId,
                            bookingId: val.id,
                            userName: (userName && userName != undefined && userName != null) ? userName.fullName : "",
                        };
                        bookedSlot.push(object);
                    }
                }

            }

            var available = $.grep(availableSlot, function (element) {
                slotHtml += '<div class="col-lg-6 col-md-6 col-12"><div class="parking-slot-block"><div class="d-flex align-items-center parking-slot-box">';

                var found = false;
                var bookedUrl = '<a href="Javascript:void(0)">';
                var userName = "";
                for (var i = 0; i < bookedSlot.length; i++) {
                    if (bookedSlot[i].parkingSlotId === element) {
                        found = true; // Set the flag to true
                        bookedUrl = "{{route('parking-bookings.show','id')}}";
                        bookedUrl = bookedUrl.replace('id', bookedSlot[i].bookingId);

                        bookedUrl = '<a href="' + bookedUrl + '" target="_blank">';
                        userName = bookedSlot[i].userName;
                        break;
                    }
                }

                slotHtml += bookedUrl + '<span class="slot-number">' + element + '</span>';


                if (found) {
                    slotHtml += '<span class="slotcar-img"><img width="50px"  src="{{asset('images/car_model_1.png')}}"></span><span class="slot-booking-name">' + userName + '</span>';

                } else {
                    slotHtml += '<span class="slotcar-img parking-available">{{trans('lang.available')}}</span>';

                }

                slotHtml += '</a></div></div></div>';

            });

            return slotHtml;

        }

    </script>

@endsection
