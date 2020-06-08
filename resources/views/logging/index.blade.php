@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form class="form-inline" action="{{url('activity_log')}}" method="get">
                            <span>Activity Log</span>
                            <div class="form-group col-md-8">
                                <select class="form-control col-md-4" name="user_id">
                                    <option value="all">All users</option>
                                    @foreach($users_info as $user_id => $user_name)
                                        @if($user_id == $selected_user)
                                            @php($selected = "selected")
                                        @else
                                            @php($selected = "")
                                        @endif
                                        <option value="{{$user_id}}" {{$selected}}>{{$user_name}}</option>
                                    @endforeach
                                </select>
                                <select class="form-control col-md-4" name="date">
                                    <option value="all">All dates</option>
                                    @foreach($dates as $date => $date_details)
                                        @if($selected_date == $date)
                                            @php($selected = "selected")
                                        @else
                                            @php($selected = "")
                                        @endif
                                        <option value="{{$date}}" {{$selected}}>{{$date}}</option>
                                    @endforeach
                                </select>
                                <input type="submit" class="btn btn-success" value="Go">
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>log name</th>
                                <th>Description</th>
                                <th>User ID</th>
                                <th>Created at</th>
                                <th>Details</th>
                            </tr>
                            @foreach($activities as $key => $activity)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $activity->log_name }}</td>
                                    <td>{!! $activity->description !!}</td>
                                    <td>{{ $activity->causer_id }}</td>
                                    <td>{{ $activity->created_at }}</td>
                                    <td><a href="javascript:;" data-id="{{$activity->id}}"
                                           class="view-link btn btn-info">View</a></td>
                                </tr>
                            @endforeach
                        </table>
                        {{$activities->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="view-data-modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Log name</th>
                            <td id="log_name"></td>
                        </tr>
                        <tr>
                            <th>User id</th>
                            <td id="causer_id"></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td id="created_at"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td id='description'></td>
                        </tr>
                        <tr>
                            <th>Subject type</th>
                            <td id="subject_type"></td>
                        </tr>
                        <tr>
                            <th>Attributes</th>
                            <td id="properties"></td>
                        </tr>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
@section("scripts")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script type="text/javascript">
        var config = {
            base_url: "{{url('/')}}"
        };
        $(document).on("click", ".view-link", function () {
            var id = $(this).data("id");
            $.ajax({
                url: config.base_url + "/activity_log/" + id,
                type: "get",
                success: function (response) {
                    for (var i in response) {
                        $("#view-data-modal #" + i).html(response[i]);
                        if (i == "properties") {
                            var html = "";
                            for (var j in response[i]) {
                                html += `<p>${j}</p>`;
                                var inner = "";
                                for (var m in response[i][j]) {
                                    inner += `<span>${m}</span><span>${response[i][j][m]}</span><br />`;
                                }
                                html += `<p>${inner}</p>`;
                            }
                            $("#properties").html(html);
                        }
                    }
                    $("#view-data-modal").modal("show");
                }
            })
        });
    </script>
@stop