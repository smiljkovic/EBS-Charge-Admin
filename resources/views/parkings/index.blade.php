@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor orderTitle">{{trans('lang.parking_list')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.parking_list')}}</li>
                </ol>
            </div>
            <div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#"><i
                                            class="fa fa-list mr-2"></i>{{trans('lang.parking_list')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('parking-list.save')}}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.parking_create')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                                 style="display: none;">{{trans('lang.processing')}}
                            </div>


                            <div class="table-responsive m-t-10">
                                <table id="parkingTable"
                                       class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                               class="do_not_delete"
                                                                                               href="javascript:void(0)"><i
                                                        class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>

                                        <th>{{trans('lang.image')}}</th>
                                        <th>{{trans('lang.name')}}</th>
                                        <th>{{trans('lang.owner')}}</th>
                                        <th>{{trans('lang.address')}}</th>
                                        <th>{{trans('lang.dashboard_total_orders')}}</th>
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

@endsection

@section('scripts')

    <script type="text/javascript">
        var database = firebase.firestore();
        var offest = 1;

        var end = null;
        var endarray = [];
        var start = null;
        var append_list = '';
        var defaultImg = "{{ asset('/images/default_user.png') }}";
        var deleteMsg = "{{trans('lang.delete_alert')}}";
        var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";

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

        var refData = database.collection('parkings');

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
                $('#parkingTable').DataTable({
                    order: [],
                    columnDefs: [
                        {orderable: false, targets: [0, 1, 6, 7]},
                    ],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
                    responsive: true
                });
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
            var parking_view = '{{route("parking-list.show",":id")}}';
            parking_view = parking_view.replace(':id', val.id);
            var route1 = '{{route("parking-list.save",":id")}}';
            route1 = route1.replace(':id', id);

            html += '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
            id = id.substring(0, 7);
            if (val.image == '' || val.image == null) {

                html = html + '<td><img class="rounded" style="width:50px" src="' + defaultImg + '" alt="image"></td>';
            } else {
                html = html + '<td><img class="rounded" style="width:50px" src="' + val.image + '" alt="image"></td>';
            }

            html += '<td><a href="' + parking_view + '">' + val.name + '</a></td>';
            if (val.userId) {
                var userData = await getUserName(user_id);
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


            html = html + '<td>' + val.address + '</td>';
            total = await getBookingCount(val.id);
            var bookings_view = '{{route("parking-bookings",":id")}}';
            bookings_view = bookings_view.replace(':id', val.id);
            html = html + '<td class="redirecttopage booking_' + val.id + '"><a href="' + bookings_view + '">' + total + '</a></td>';

            if (val.isEnable) {
                html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
            } else {
                html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
            }

            html += '<td class="action-btn"><a href="' + parking_view + '"><i class="fa fa-eye"></i></a><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.id + '" class="do_not_delete" href="javascript:void(0)" name="parking-delete"><i class="fa fa-trash"></i></a></td>';
            html += '</tr>';
            return html;
        }

        async function getBookingCount(id) {
            var count = 0;
            await database.collection('booked_parking_order').where('parkingId', '==', id).get().then(async function (snapshot) {
                count = snapshot.docs.length;
                return count;

            });
            return count;
        }

        $("#is_active").click(function () {
            $("#parkingTable .is_open").prop('checked', $(this).prop('checked'));

        });

        $("#deleteAll").click(function () {
            if ($('#parkingTable .is_open:checked').length) {
                if (confirm("{{trans('lang.selected_delete_alert')}}")) {
                    jQuery("#overlay").show();
                    $('#parkingTable .is_open:checked').each(function () {
                        var dataId = $(this).attr('dataId');
                        database.collection('parkings').doc(dataId).delete().then(function () {
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

        $(document).on("click", "a[name='parking-delete']", function (e) {

            var id = this.id;
            jQuery("#overlay").show();
            database.collection('parkings').doc(id).delete().then(function (result) {

                window.location.href = '{{ url()->current() }}';
            });

        });

        async function getUserName(userId) {
            var user = {};
            await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {
                if (snapshots.docs.length > 0) {
                    user = snapshots.docs[0].data();
                }
            });
            return user;
        }

        $(document).on("click", "input[name='isEnabled']", function (e) {
            var ischeck = $(this).is(':checked');
            var id = this.id;
            database.collection('parkings').doc(id).update({'isEnable': ischeck ? true : false}).then(function (result) {
            });
        });

    </script>

@endsection
