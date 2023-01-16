@extends('dashboard.layout.main')

@section('container')
    <?php use App\Models\Pesanan;
    // use DB;
    ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <h5>Hai, {{ ucwords(auth()->user()->nama) }}</h5>

    <h4 style="color: black">Penjualan tiket hari ini</h4>

    <div class="row mb-2">
        <div class="col-auto m-3 p-3" style="background-color: #6e79f4">
            <?php $pesanan = Pesanan::select(DB::raw('SUM(total) as pendapatan'))
            ->where('status','dibayar')
            ->whereDate('tanggal_beli',now())
            ->whereYear('tanggal_beli',now())
            ->pluck('pendapatan'); ?>
            <h4 style="color: white">Rp. {{ number_format($pesanan[0], 2, ',', '.') }}</h4>
            <p style="color: white">Pendapatan</p>
        </div>
        <div class="col-auto m-3 p-3" style="background-color: #d04e1b">
            <?php $pesan = Pesanan::select(DB::raw('count(*) as tiket'))
            ->where('status','dipesan')
            ->whereDate('tanggal_pesan',now())
            ->whereYear('tanggal_pesan',now())
            ->pluck('tiket'); ?>
            <h4 style="color: white">{{$pesan[0]}}</h4>
            <p style="color: white">Tiket yang dipesan</p>
        </div>
        <div class="col-auto m-3 p-3" style="background-color: #6c6e6f">
            <?php $bayar = Pesanan::select(DB::raw('count(*) as bayar'))
            ->where('status','dibayar')
            ->whereDate('tanggal_beli',now())
            ->whereYear('tanggal_beli',now())
            ->pluck('bayar'); ?>
            <h4 style="color: white">{{$bayar[0]}}</h4>
            <p style="color: white">Tiket yang sudah bayar</p>
        </div>
    </div>

    <div class="mb-2">
        <form action="{{ url('download-pdf') }}" method="get">
            @csrf
            <button type="submit" class="btn btn-success">Cetak Laporan</button>
        </form>
        {{-- <button class="btn btn-success" onclick="download()">Cetak Laporan</button> --}}
    </div>

    <div id="grafik" style="background-color: #adb5bd; padding: 5px"></div>
    {{-- <h5>Welcome back, {{ auth()->user()->name }}</h5> --}}
    <script src="{{ asset('js/highcharts.js') }}"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://www.highcharts.com/samples/data/usdeur.js"></script>
    <script type="text/javascript">
        var today = new Date();
        var year = today.getFullYear();
        var pendapatan = {{ json_encode($total_harga) }};
        var bulan = {!! json_encode($bulan) !!};
        const chartPen = Highcharts.chart('grafik', {
            title: {
                text: 'Penjualan Tiket Bus Go-Bis Bulanan',
                style: {
                    color: '#6e79f4',
                    fontFamily: 'Segoe UI',
                    fontWeight: 'bold',
                    fontSize: '20px'
                }
            },

            subtitle: {
                text: 'Data ini diperoleh dari pembelian tiket Go-Bis di tahun ' + year + '',
                style: {
                    color: '#6e79f4',
                    fontFamily: 'Segoe UI',
                }
            },


            xAxis: {
                categories: bulan,
                labels: {
                    style: {
                        color: '#6e79f4',
                        fontFamily: 'Segoe UI',
                    }
                }
            },

            yAxis: {
                title: {
                    text: 'Nominal Pendapatan Bulanan',
                    style: {
                        fontFamily: 'Segoe UI',
                        fontWeight: 'bold'
                    }
                },
                labels: {
                    style: {
                        fontFamily: 'Segoe UI',
                    }
                }
            },

            plotOptions: {
                series: {
                    allowPointSelect: true,
                    borderRadius: [100, 100, 100, 100],
                }
            },

            series: [{
                name: 'Nominal Pendapatan',
                data: pendapatan
            }, ],

            // exporting: {
            //     chartOptions: {
            //         chart: {
            //             width: 1024,
            //             height: 768
            //         }
            //     }
            // }
        });

        // function download() {
        //     chartPen.exportChart({
        //     });
        // }
    </script>
@endsection
