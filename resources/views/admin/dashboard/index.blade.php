@extends('admin.layouts.base')

@section('style-head')
    <style>
        #js-legend li span {
            display: inline-block;
            width: 12px;
            height: 12px;
            margin-right: 5px;
        }

        #js-legend ul {
            display: inline;
            width: 12px;
            height: 12px;
            margin-right: 5px;
            list-style: none;
        }

        #js-legend2 li span {
            display: inline-block;
            width: 12px;
            height: 12px;
            margin-right: 5px;
        }

        #js-legend2 ul {
            display: inline;
            width: 12px;
            height: 12px;
            margin-right: 5px;
            list-style: none;
        }
    </style>
@endsection

@section('script-head')
    <script src="{{ asset('js/Chart.js')}}"></script>

    <script>

        var $comments = [

            @foreach($commentsData as $data)
            {!! $data . "," !!}
            @endforeach

        ];

        var $voteUp = [

            @foreach($voteUpData as $data)
            {!! $data . "," !!}
            @endforeach

        ];

        var $voteDown = [

            @foreach($voteDownData as $data)
            {!! $data . "," !!}
            @endforeach

        ];

        var lineChartData = {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "JunI", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],

            datasets: [
                {
                    fillColor: "rgba(33,133,208, 0.5)",
                    label: "Komentar",
                    strokeColor: "rgba(171,9,9,0.8)",
                    highlightFill: "rgba(171,9,9,0.75)",
                    highlightStroke: "rgba(171,9,9,0.1)",
                    pointColor: "rgba(171,9,9,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(171,9,9,1)",
                    data: $comments
                },
                {
                    fillColor: "rgba(108,154,237, 0.5)",
                    label: "Vote Up",
                    strokeColor: "rgba(108,154,237, 0.8)",
                    highlightFill: "rgba(108,154,237, 0.75)",
                    highlightStroke: "rgba(108,154,237, 0.1)",
                    pointColor: "rgba(108,154,237,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(108,154,237,1)",
                    data: $voteUp
                },
                {
                    label: "Vote Dowm",
                    fillColor: "rgba(151,228,84,0.2)",
                    strokeColor: "rgba(151,228,84,1)",
                    pointColor: "rgba(151,228,84,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,228,84,1)",
                    data: $voteDown
                }
            ]

        }

        var $faseData = [

            @foreach($faseData as $data)
            {!! $data . "," !!}
            @endforeach

        ];

        var $ujiPublikData = [

            @foreach($ujiPublikData as $data)
            {!! $data . "," !!}
            @endforeach

        ];

        var $usulanData = [

            @foreach($usulanData as $data)
            {!! $data . "," !!}
            @endforeach

        ];
        var barChartData = {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "JunI", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],

            datasets: [
                {
                    fillColor: "rgba(33,133,208, 0.5)",
                    label: "Fase Program Kerja",
                    strokeColor: "rgba(33,133,208,0.8)",
                    highlightFill: "rgba(33,133,208,0.75)",
                    highlightStroke: "rgba(33,133,208,1)",
                    data: $faseData,
                },
                {
                    fillColor: "rgba(151,228,84, 0.5)",
                    label: "Uji Publik",
                    strokeColor: "rgba(151,228,84, 0.8)",
                    highlightFill: "rgba(151,228,84, 0.75)",
                    highlightStroke: "rgba(151,228,84, 1)",
                    data: $ujiPublikData,
                },
                {
                    fillColor: "rgba(251,189,8, 0.5)",
                    label: "Usulan Program Kerja",
                    strokeColor: "rgba(251,189,8, 0.8)",
                    highlightFill: "rgba(251,189,8, 0.75)",
                    highlightStroke: "rgba(251,189,8, 1)",
                    data: $usulanData,
                }
            ]

        }

        window.onload = function () {

            var ctx = document.getElementById("canvas").getContext("2d");

            var ctx2 = document.getElementById("canvas2").getContext("2d");

            window.myBar = new Chart(ctx).Bar(barChartData, {
                tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>kb",
                responsive : true,
                scaleOverride: true,
                scaleSteps: 1,
                scaleStepWidth: {{ $max1 }} + 20
            });

            window.myLine = new Chart(ctx2).Line(lineChartData, {
                tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>kb",
                responsive: true,
                pointDot : true,
                scaleSteps: 1,
                scaleOverride: true,
                maintainAspectRatio: true,
                scaleStepWidth: {{ $max2 }} + 20
            });

            document.getElementById('js-legend').innerHTML = myBar.generateLegend();
            document.getElementById('js-legend2').innerHTML = myLine.generateLegend();

    }

    $(document).ready(function() {

        $("input[name=year]").change(function() {
           $("#formYear").submit();
        });
    });

    </script>
@endsection

@section('content')
    <div class="ui container">
        <h2>Dasbor</h2>


        @include('admin.dashboard.summary')
        @include('admin.dashboard.popular')

        <div class="ui segments">
        <div class="ui segment">
            <form id="formYear" action="{{ url('admin') }}" method="GET">
                <div class="ui selection dropdown">
                    <input type="hidden" name="year" value="{{ $yearNow }}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Gender</div>
                    <div class="menu">
                        @foreach($avaibleYears as $year)
                            <div class="item" data-value="{{ $year }}">{{ $year }}</div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
        <div class="ui segment">
        @include('admin.dashboard.chart_content')
        </div>
        <div class="ui segment"></div>
        @include('admin.dashboard.chart_interaction')
        </div>
    </div>
@endsection
