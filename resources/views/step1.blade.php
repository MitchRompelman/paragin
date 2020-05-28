@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Step 2') }}</div>

                <div class="card-body">    
                    <i>{{ __('Create test scores') }}</i>
                    <br>
                    <a class="btn" href="{{ route('step2') }}">{{ __('Create scores') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
