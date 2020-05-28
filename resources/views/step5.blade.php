@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Step 5') }}</div>

                <div class="card-body">    
                    <i>{{ __('Create student ritValues') }}</i>
                    <br>
                    <a class="btn" href="{{ route('step6') }}">{{ __('Create ritValues') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection