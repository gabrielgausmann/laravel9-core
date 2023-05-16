@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('You are logged in!') }}

            {{-- <div id="main" style="width: 600px; height:400px; background:#333;"></div> --}}
        </div>
    </div>

@endsection

@section('scripts')

	{{-- eCharts --}}
	{{-- <script type="text/javascript">

		var chartDom = document.getElementById('main');
		var myChart = echarts.init(chartDom);
		var option;

		option = {
		xAxis: {
			type: 'category',
			data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
		},
		yAxis: {
			type: 'value'
		},
		series: [
			{
			data: [150, 230, 224, 218, 135, 147, 260],
			type: 'line'
			}
		]
		};

		option && myChart.setOption(option);

	</script> --}}
    
@endsection
