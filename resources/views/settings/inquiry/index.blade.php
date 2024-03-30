@extends('layouts.app')


@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.inquiry')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.inquiry')}}</li>
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
                            <div class="table-responsive m-t-10">
                                <table id="inquiryTable"
                                       class="display  table table-hover table-striped table-bordered table table-striped"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>{{trans('lang.user')}}</th>
                                        <th>{{trans('lang.email')}}</th>
                                        <th>{{trans('lang.phone')}}</th>
                                        <th>{{trans('lang.message')}}</th>
                                        <th>{{trans('lang.createdAt')}}</th>
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

        var ref = database.collection('inquiry');
        var append_list = '';

        $(document).ready(function () {

            jQuery("#overlay").show();

            append_list = document.getElementById('append_list1');
            append_list.innerHTML = '';

            ref.get().then(async function (snapshots) {

                var html = '';
                html = await buildHTML(snapshots);
                if (html != '') {
                    append_list.innerHTML = html;
                }
                $('#inquiryTable').DataTable({
                    order: [],
                    columnDefs: [
                        {
                            targets: 4,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        {orderable: false, targets: [1, 2, 3, 5]},
                    ],
                    order: [['4', 'desc']],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
                    }
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

        function getListData(val) {
            var html = '';

            html = html + '<tr>';
            newdate = '';
            var id = val.id;
            var route1 = '{{route("settings.inquiry.show",":id")}}';
            route1 = route1.replace(':id', id);

            html = html + '<td>' + val.name + '</td>';

            html = html + '<td>' + val.email + '</td>';
            html = html + '<td>' + val.phone + '</td>';

            html = html + '<td>' + (val.message).substr(0, 20) + '...</td>';
            var date = '';
            var time = '';
            if (val.hasOwnProperty("createdAt")) {
                date = val.createdAt.toDate().toDateString();
                time = val.createdAt.toDate().toLocaleTimeString('en-US');

            }
            html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';
            html += '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-eye"></i></a></td>';

            html = html + '</tr>';

            return html;
        }

    </script>

@endsection
