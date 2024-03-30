@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">{{trans('lang.booking_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.booking_plural')}}</li>
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
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>


                        <div class="table-responsive m-t-10">
                            <table id="orderTable"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>

                                    <th>{{trans('lang.booking_id')}}</th>
                                    <th>{{trans('lang.booked_by')}}</th>
                                    <th>{{trans('lang.parking')}}</th>
                                    <th>{{trans('lang.date&time')}}</th>
                                    <th>{{trans('lang.duration')}}</th>
                                    <th>{{trans('lang.slot')}}</th>
                                    <th>{{trans('lang.amount')}}</th>
                                    <th>{{trans('lang.createdAt')}}</th>
                                    <th>{{trans('lang.status')}}</th>
                                    <th>{{trans('lang.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody id="append_list1">
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bookingStatusModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{trans('lang.update_status')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <form class="" >

                    <div class="form-row">

                        <input type="hidden" name="booking_id" id="booking_id">

                        <div class="form-group row">

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.status')}}</label>
                                <div class="col-12">
                                    <select name="booking_status" class="form-control" id="booking_status">
                                        <option value='placed'>{{trans("lang.placed")}}</option>
                                        <option value='onGoing'>{{trans("lang.ongoing")}}</option>
                                        <option value='completed'>{{trans("lang.completed")}}</option>
                                        <option value='canceled'>{{trans("lang.canceled")}}</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="change-status-btn">{{trans('submit')}}
                        </button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                            {{trans('close')}}
                        </button>

                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')

<script type="text/javascript">
    var database = firebase.firestore();
    var offest = 1;

    var end = null;
    var endarray = [];
    var start = null;
    var append_list = '';
    var id = "{{$id}}";
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

    var refData = (id) ? database.collection('booked_parking_order').where('parkingId', '==', id).orderBy('createdAt', 'desc') : database.collection('booked_parking_order').orderBy('createdAt', 'desc');

    $(document).ready(function () {

        jQuery("#overlay").show();

        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';

        refData.get().then(async function (snapshots) {
            html = '';
            if (snapshots.docs.length > 0) {
                html = await buildHTML(snapshots);
            }
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
            }
            $('#orderTable').DataTable({
                order: [],
                columnDefs: [
                    {
                        targets: 7,
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    },
                    {orderable: false, targets: [8, 9]},
                ],
                order: [['7', 'desc']],
                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                responsive: true
            });
            $(".ride-status-info").show();
            jQuery("#overlay").hide();
        });
    });

    async function buildHTML(snapshots) {
        var html = '';
        await Promise.all(snapshots.docs.map(async (listval) => {
            var val = listval.data();
            var getData = await getListData(val);
            html += getData;
        }));
        return html;
    }

    async function getListData(val) {
        var html = '';
        html = html + '<tr>';
        var id = val.id;
        var user_id = val.userId;
        var ride_view = '';
        var ride_view = '{{route("parking-bookings.show",":id")}}';
        ride_view = ride_view.replace(':id', val.id);
        var parking_view = '{{route("parking-list.show",":id")}}';
        parking_view = parking_view.replace(':id', val.parkingId);

        id = id.substring(0, 7);
        html += '<td><a href="' + ride_view + '">' + id + '</a></td>';
        if (val.userId) {
            var userData = await getUserName(user_id, id);
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
        html += '<td><a href="' + parking_view + '">' + val.parkingDetails.name + '</a></td>';

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
        html += '<td class="action-btn"><a href="' + ride_view + '"><i class="fa fa-eye"></i></a><a name="change-status" href="javascript:void(0)" data-toggle="modal" data-target="#bookingStatusModal" data-id="' + val.id + '" data-status="' + val.status + '"><i class="fa fa-edit"></i></a></td>';
        html += '</tr>';
        return html;
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

    $("#is_active").click(function () {
        $("#orderTable .is_open").prop('checked', $(this).prop('checked'));

    });

    $("#deleteAll").click(function () {
        if ($('#orderTable .is_open:checked').length) {
            if (confirm("{{trans('lang.selected_delete_alert')}}")) {
                jQuery("#overlay").show();
                $('#orderTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');
                    database.collection('orders').doc(dataId).delete().then(function () {
                        setTimeout(function () {
                            window.location.reload();
                        }, 5000);
                    });

                });

            }
        } else {
            alert("{{trans('lang.select_delete_alert')}}");
        }
    });

    $(document).on("click", "a[name='ride-delete']", function (e) {

        var id = this.id;
        jQuery("#overlay").show();
        database.collection('orders').doc(id).delete().then(function (result) {

            window.location.href = '{{ url()->current() }}';
        });

    });

    async function getUserName(userId, id) {
        var user = {};
        await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {
            if (snapshots.docs.length > 0) {
                user = snapshots.docs[0].data();
            }
        });
        return user;
    }

    $(document).on("click", "a[name='change-status']", function (e) {
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        $('#booking_status').val(status).trigger('change');
        $('#booking_id').val(id);
    });

    $('#change-status-btn').on('click', function () {
        var status = $('#booking_status').val();
        var id = $('#booking_id').val();
        database.collection('booked_parking_order').doc(id).update({
            'status': status,

        }).then(function (result) {
            window.location.reload();
        })
    });
</script>

@endsection
