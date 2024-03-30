@extends('layouts.app')

@section('content')

    <div class="page-wrapper">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.all_coupon_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.coupon_table')}}</li>
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
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i
                                            class="fa fa-list mr-2"></i>{{trans('lang.coupon_table')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! url('/coupons/save/0') !!}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.coupon_create')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                                 style="display: none;">{{trans('lang.processing')}}
                            </div>

                            <div class="table-responsive m-t-10">
                                <table id="taxTable"
                                       class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                               class="do_not_delete"
                                                                                               href="javascript:void(0)"><i
                                                        class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>
                                        <th>{{trans('lang.coupon_title')}}</th>
                                        <th>{{trans('lang.coupon_code')}}</th>
                                        <th>{{trans('lang.coupon_type')}}</th>
                                        <th>{{trans('lang.coupon_discount')}}</th>
                                        <th>{{trans('lang.coupon_enable')}}</th>
                                        <th>{{trans('lang.privacy')}}</th>
                                        <th>{{trans('lang.coupon_validity')}}</th>
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
        var pagesize = 10;
        var end = null;
        var endarray = [];
        var start = null;
        var user_number = [];

        var ref = database.collection('coupon').orderBy('title');

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
        var append_list = '';

        var deleteMsg = "{{trans('lang.delete_alert')}}";
        var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";

        $(document).ready(function () {
            $(document.body).on('click', '.redirecttopage', function () {
                var url = $(this).attr('data-url');
                window.location.href = url;
            });
            var inx = parseInt(offest) * parseInt(pagesize);
            jQuery("#overlay").show();
            append_list = document.getElementById('append_list1');
            append_list.innerHTML = '';
            ref.get().then(async function (snapshots) {
                html = '';
                if (snapshots.docs.length > 0) {
                    html = await buildHTML(snapshots);
                }
                jQuery("#overlay").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.push(snapshots.docs[0]);

                    if (snapshots.docs.length < pagesize) {
                        jQuery("#data-table_paginate").hide();
                    }
                }

                $('#taxTable').DataTable({
                    order: [[1, 'asc']],
                    columnDefs: [
                        {
                            targets: 6,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        {orderable: false, targets: [0, 5, 8]},

                    ],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
                    },
                    responsive: true
                });
            });

            $('#selected_search').on('change', function () {
                selected_search = $('#selected_search').val();
                if (selected_search == "type") {
                    $('#search').hide();
                    $('#search_tax_type').show();
                } else {
                    $('#search').show();
                    $('#search_tax_type').hide();
                }
            })
        });


        async function buildHTML(snapshots) {


            await Promise.all(snapshots.docs.map(async (listval) => {
                var val = listval.data();
                var getData = await getListData(val);
                html += getData;


            }));
            return html;
        }

        function getListData(val) {
            var html = '';
            html = html + '<tr>';
            newdate = '';
            var id = val.id;
            var route1 = '{{route("coupons.save",":id")}}';
            route1 = route1.replace(':id', id);
            var trroute1 = '';
            trroute1 = trroute1.replace(':id', id);
            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
            html = html + '<td><a href="' + route1 + '">' + val.title + '</a></td>';
            html = html + '<td>' + val.code + '</td>';
            var type = val.type;
            html = html + '<td>' + (type.charAt(0).toUpperCase()) + type.slice(1) + '</td>';

            if (val.type == "fix") {

                var amount = parseFloat(val.amount);
                if (symbolAtRight) {
                    html += '<td>' + amount.toFixed(decimal_degits) + currentCurrency + '</td>';

                } else {
                    html += '<td>' + currentCurrency + amount.toFixed(decimal_degits) + '</td>';

                }
            } else {
                html = html + '<td>' + val.amount + '%</td>';

            }

            if (val.enable) {
                html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
            } else {
                html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
            }
            if (val.isPublic) {
                html += '<td><span class="badge badge-success py-2 px-3">{{trans("lang.public")}}</span></td>';
            } else {
                html += '<td><span class="badge badge-danger py-2 px-3">{{trans("lang.private")}}</span></td>';
            }
            var date = new Date(val.validity.seconds * 1000);
            var dateFormat = date.toDateString() + " , " + date.toLocaleString('en-US', {
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            });
            html = html + '<td class="dt-time">' + dateFormat + '</td>';
            html = html + '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.id + '" class="do_not_delete" name="tax-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';
            html = html + '</tr>';
            return html;
        }


        $("#is_active").click(function () {
            $("#taxTable .is_open").prop('checked', $(this).prop('checked'));
        });

        $("#deleteAll").click(function () {
            if ($('#taxTable .is_open:checked').length) {
                if (confirm(deleteSelectedRecordMsg)) {
                    jQuery("#overlay").show();
                    $('#taxTable .is_open:checked').each(function () {
                        var dataId = $(this).attr('dataId');
                        database.collection('coupon').doc(dataId).delete({}).then(function () {
                            window.location.reload();
                        });
                    });
                } else {
                    return false;
                }
            } else {
                alert("{{trans('lang.select_delete_alert')}}");
            }
        });


        $(document).on("click", "input[name='isEnabled']", function (e) {

            var ischeck = $(this).is(':checked');
            var id = this.id;
            database.collection('coupon').doc(id).update({
                'enable': ischeck ? true : false
            }).then(function (result) {
            });
        });


        $(document).on("click", "a[name='tax-delete']", function (e) {
            if (confirm(deleteMsg)) {
                var id = this.id;
                jQuery("#overlay").show();
                database.collection('coupon').doc(id).delete({}).then(function (result) {
                    window.location.href = '{{ url()->current() }}';
                });
            } else {
                return false;
            }
        });
    </script>

@endsection
