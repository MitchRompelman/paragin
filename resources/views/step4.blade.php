@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Step 4') }}</div>

                <div class="card-body">    
                    <i>{{ __('Create student pValues') }}</i>
                    <br>
                    <a class="btn" href="{{ route('step5') }}">{{ __('Create pValues') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection