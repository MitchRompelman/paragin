@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Step 3') }}</div>

                <div class="card-body">    
                    <i>{{ __('Create student grades') }}</i>
                    <br>
                    <a class="btn" href="{{ route('step4') }}">{{ __('Create grades') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
