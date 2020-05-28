@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    @php
                        $tablehead = 0;
                    @endphp

                    <table id="scores">

                    @if($tablehead == 0)
                    <thead>
                        <th>{{__('Question')}}</th>
                        <th>{{__('Score')}}</th>
                    </thead>
                    @endif

                    @foreach ($scores as $key => $value)
                        @if($key !== 'id')
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                        @endif
                    @endforeach

                    </table>


                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready( function () {
    $('#scores').DataTable({
        "order": false
    });
});
</script>

@endsection
