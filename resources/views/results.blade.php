@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $testName }} {{ __('Results') }}</div>

                <div class="card-body">

                    <a href="{{ route('home') }}" class="btn">
                        {{ __('Start a new test') }}
                    </a>
                    <br>

                    <h4>{{ __('Test Calculations') }}</h4>

                    <table id="calculations">

                    <thead>
                        <th>{{__('Percentage')}}</th>
                        <th>{{__('Grade')}}</th>
                    </thead>

                    @foreach ($calculations as $key => $value)
                        @if($key !== 'id')
                        <tr>
                            <td>{{ $value->percentage }}</td>
                            <td>{{ $value->grade }}</td>
                        </tr>
                        @endif
                    @endforeach

                    </table>

                    <h4>{{ __('Test Scores') }}</h4>

                    <table id="scores">

                    <thead>
                        <th>{{__('Question')}}</th>
                        <th>{{__('Score')}}</th>
                    </thead>

                    @foreach ($scores as $key => $value)
                        @if($key !== 'id')
                        <tr>
                            <td>{{ $value->question }}</td>
                            <td>{{ $value->score }}</td>
                        </tr>
                        @endif
                    @endforeach

                    </table>

                    </table>

                    <h4>{{ __('Student Grades') }}</h4>

                    <table id="grades">

                    <thead>
                        <th>{{__('Student')}}</th>
                        <th>{{__('Grade')}}</th>
                    </thead>

                    @foreach ($grades as $key => $value)
                        @if($key !== 'id')
                        <tr>
                            <td>{{ $value->student }}</td>
                            <td>{{ $value->grade }}</td>
                        </tr>
                        @endif
                    @endforeach

                    </table>

                    <h4>{{ __('PValues') }}</h4>

                    <table id="pvalues">

                    <thead>
                        <th>{{__('Question')}}</th>
                        <th>{{__('PValue')}}</th>
                    </thead>

                    @php 
                        $pValueIndex = 1;
                    @endphp

                    @foreach ($pValues as $key => $value)
                        @if($key !== 'id')
                        <tr>
                            <td>{{ $pValueIndex }}</td>
                            <td>{{ $value->pvalue }}</td>
                        </tr>

                        @php 
                            $pValueIndex++;
                        @endphp

                        @endif
                    @endforeach

                    </table>

                    <h4>{{ __('RitValues') }}</h4>

                    <table id="ritvalues">

                    <thead>
                        <th>{{__('Question')}}</th>
                        <th>{{__('RitValue')}}</th>
                    </thead>

                    @php 
                        $ritValueIndex = 1;
                    @endphp

                    @foreach ($ritValues as $key => $value)
                        @if($key !== 'id')
                        <tr>
                            <td>{{ $ritValueIndex }}</td>
                            <td>{{ $value->ritvalue }}</td>
                        </tr>

                        @php 
                            $ritValueIndex++;
                        @endphp

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
    $('#calculations').DataTable({
        //"order": true,
        "searching": false,
        "bPaginate": false,
        "bInfo": false,
    });
    $('#scores, #grades, #pvalues, #ritvalues').DataTable({
        //"order": true,
        "searching": true,
        "bPaginate": true,
        "bInfo": false,
    });
});
</script>

@endsection
