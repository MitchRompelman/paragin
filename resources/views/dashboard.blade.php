@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Step 1') }}</div>

                <div class="card-body">
                    

                    @if($test)
                        <a href="{{ route('results') }}" class="btn">
                            {{ __('Jump to the latest resulst') }}
                        </a>
                        <br>
                    @endif
                    

                    <i>{{ __('Create your test') }}</i>

                    <form method="post"  action="{{ route('step1') }}">
                        @csrf
                        <label>{{ __('Test name') }}:</label>
                        <input type="text" name="test" required="required">
                        <input type="submit" value="{{ __('Save') }}">
                    </form>

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
