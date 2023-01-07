@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div id="grafik"></div>
    {{-- <h5>Welcome back, {{ auth()->user()->name }}</h5> --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var today = new Date();
        var year = today.getFullYear();
        var pendapatan = {{ json_encode($total_harga) }};
        var bulan = {!! json_encode($bulan) !!};
        Highcharts.chart('grafik', {
            title: {
                text: 'Penjualan Tiket Bus Go-Bis Bulanan'
            },

            subtitle: {
                text: 'Data ini diperoleh dari pembelian tiket Go-Bis di tahun ' + year
            },


            xAxis: {
                categories: bulan
            },

            yAxis: {
                title: {
                    text: 'Nominal Pendapatan Bulanan'
                }
            },

            // plotOptions: {
            //     series: {
            //         allowPointSelect: true
            //     }
            // }

            series: [{
                    name: 'Nominal Pendapatan',
                    data: pendapatan
                },
            ]
        });
    </script>
@endsection
