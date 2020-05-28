@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Step 3') }}</div>

                <div class="card-body">    
                    <i>{{ __('Create grade calculations') }}</i>

                    <form method="post"  action="{{ route('step3') }}">
                        @csrf
                        <label>{{ __('Precentage 1') }}:</label>
                        <input type="number" name="percentage1" required="required">
                        <label>{{ __('Grade 1') }}:</label>
                        <input type="number" name="grade1" step="0.5" max="9" required="required">
                        <br>
                        <label>{{ __('Precentage 2') }}:</label>
                        <input type="number" name="percentage2" required="required">
                        <label>{{ __('Grade 2') }}:</label>
                        <input type="number" name="grade2" step="0.5" max="9.5" required="required">
                        <br>
                        <label>{{ __('Precentage 3') }}:</label>
                        <input type="number" name="percentage3" required="required">
                        <label>{{ __('Grade 3') }}:</label>
                        <input type="number" name="grade3" step="0.5" max="10" required="required">
                        <br>         
                        <input type="submit" value="{{ __('Save') }}">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
