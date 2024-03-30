@extends('layouts.app')

@section('content')

    <div class="page-wrapper">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.user_table')}}</li>
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

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.select_type')}}</label>
                                <div class="col-7">
                                    <select class="form-control type">
                                        <option value="">{{trans('lang.all')}}</option>
                                        <option value="customer">{{trans('lang.customer')}}</option>
                                        <option value="security">{{trans('lang.security')}}</option>
                                        <option value="owner">{{trans('lang.owner')}}</option>
                                    </select>
                                </div>
                            </div>


                            <div class="table-responsive m-t-10">
                                <table id="userTable"
                                       class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                               class="do_not_delete"
                                                                                               href="javascript:void(0)"><i
                                                        class="fa fa-trash"></i> {{trans('lang.all')}}</a></label>
                                        </th>

                                        <th>{{trans('lang.extra_image')}}</th>
                                        <th>{{trans('lang.user_name')}}</th>
                                        <th>{{trans('lang.email')}}</th>
                                        <th>{{trans('lang.phone')}}</th>
                                        <th>{{trans('lang.role')}}</th>
                                        <th>{{trans('lang.login_type')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        <th>{{trans('lang.active')}}</th>
                                        <th>{{trans('lang.dashboard_total_orders')}}</th>
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

        var defaultImg = "{{ asset('/images/default_user.png') }}";
        var offest = 1;
        var pagesize = 10;
        var end = null;
        var endarray = [];
        var start = null;
        var user_number = [];


        var placeholderImage = '';

        var deleteMsg = "{{trans('lang.delete_alert')}}";
        var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";
        var append_list = document.getElementById('append_list1');

        $(document).ready(function () {
            $(document.body).on('click', '.redirecttopage', function () {
                var url = $(this).attr('data-url');
                window.location.href = url;
            });
            jQuery("#overlay").show();
            getData();
        });


        async function getData(type = "") {
            $('#userTable').DataTable().destroy();
            $('#append_list1').empty();


            var ref = database.collection('users');

            if (type) {
                ref = ref.where('role', '==', type);

            }
            ref = ref.orderBy('createdAt', 'desc');

            await ref.get().then(async function (snapshots) {
                var html = '';
                html = await buildHTML(snapshots);

                if (html != '') {
                    $('#append_list1').html(html);
                }

                jQuery("#overlay").hide();

            });


            $('#userTable').DataTable({
                order: [],
                columnDefs: [
                    {
                        targets: 7,
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    },
                    {orderable: false, targets: [0, 1, 8, 9, 10]},
                ],
                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                responsive: true
            });


        }

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

            const total_booking = await getTotalBooking(val.id);

            newdate = '';
            var id = val.id;
            var route1 = '{{route("users.edit",":id")}}';
            route1 = route1.replace(':id', id);

            var trroute1 = '';
            trroute1 = trroute1.replace(':id', id);

            var userview = '{{route("users.view",":id")}}';
            userview = userview.replace(':id', id);

            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
            if (val.profilePic == '' || val.profilePic == null) {

                html = html + '<td><img class="rounded" style="width:50px" src="' + defaultImg + '" alt="image"></td>';
            } else {
                html = html + '<td><img class="rounded" style="width:50px" src="' + val.profilePic + '" alt="image"></td>';
            }

            html = html + '<td><a href="' + userview + '">' + val.fullName + '</a></td>';

            html = html + '<td>' + val.email + '</td>';
            html = html + '<td>' + (val.countryCode ? '+' + (val.countryCode.includes('+') ? val.countryCode.slice(1) + '-' : val.countryCode + '-') : '') + val.phoneNumber + '</td>';

            html = html + '<td>' + ((val.role) ? ((val.role == "security") ? "Watchman" : val.role) : "") + '</td>';
            html = html + '<td>' + ((val.loginType == "emailPassword") ? "email" : val.loginType) + '</td>';


            var date = '';
            var time = '';
            if (val.hasOwnProperty("createdAt")) {
                try {
                    date = val.createdAt.toDate().toDateString();
                    time = val.createdAt.toDate().toLocaleTimeString('en-US');
                } catch (err) {

                }
                html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';
            } else {
                html = html + '<td></td>';
            }
            if (val.isActive) {
                html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
            } else {
                html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
            }
            html = html + '<td class="total_booking_' + val.id + '">' + total_booking + '</td>';


            html = html + '<td class="action-btn"><a href="' + userview + '"><i class="fa fa-eye"></i></a><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.id + '" class="do_not_delete" name="user-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';

            html = html + '</tr>';
            return html;
        }

        async function getTotalBooking(userId) {
            var total = 0;
            var booking = 0;
            await database.collection('booked_parking_order').where('userVehicle.userId', '==', userId).get().then(async function (snapShots) {
                booking = snapShots.docs.length;
            });

            total = parseInt(booking);

            return total;
        }

        $("#is_active").click(function () {
            $("#userTable .is_open").prop('checked', $(this).prop('checked'));
        });

        $("#deleteAll").click(function () {
            if ($('#userTable .is_open:checked').length) {
                if (confirm(deleteSelectedRecordMsg)) {
                    jQuery("#overlay").show();
                    $('#userTable .is_open:checked').each(function () {
                        var dataId = $(this).attr('dataId');

                        database.collection('users').doc(dataId).delete().then(function () {
                            deleteUserData(dataId);
                            setTimeout(function () {
                                window.location.reload();
                            }, 7000);
                        });
                    });
                } else {
                    return false;
                }
            } else {
                alert("{{trans('lang.select_delete_alert')}}");
            }
        });

        async function deleteUserData(userId) {

            var dataObject = {"data": {"uid": userId}};
            var projectId = '<?php echo env('FIREBASE_PROJECT_ID') ?>';
            jQuery.ajax({
                url: 'https://us-central1-' + projectId + '.cloudfunctions.net/deleteUser',
                method: 'POST',
                crossDomain: true,
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(dataObject),
                success: function (data) {
                    console.log('Delete user success:', data.result);
                },
                error: function (xhr, status, error) {
                    var responseText = JSON.parse(xhr.responseText);
                    console.log('Delete user error:', responseText.error);
                }
            });
        }

        $(document).on("click", "a[name='user-delete']", function (e) {
            if (confirm(deleteMsg)) {

                jQuery("#overlay").show();
                var id = this.id;

                database.collection('users').doc(id).delete().then(function (result) {
                    deleteUserData(id);
                    setTimeout(function () {
                        window.location.href = '{{ url()->current() }}';
                    }, 7000);
                });

            } else {
                return false;
            }

        });

        $(document).on("click", "input[name='isActive']", function (e) {
            var ischeck = $(this).is(':checked');
            var id = this.id;
            database.collection('users').doc(id).update({'isActive': ischeck ? true : false}).then(function (result) {
            });
        });

        $(document).on('change', '.type', function () {

            var type = $(this).val();
            jQuery("#overlay").show();
            getData(type);

        });
    </script>

@endsection
