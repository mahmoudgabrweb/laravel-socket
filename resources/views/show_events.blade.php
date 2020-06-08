@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Fired events</div>

                <div class="card-body">
                    <ul id="socket">
                        <li>new row</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        Echo.channel('webinar-questions')
            .listen('.test.event', (e) => {
                let message = `<li>${e.message}</li>`;
                $("#socket").append(message)
            });
    </script>
@endsection
