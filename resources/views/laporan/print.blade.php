<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Rumahku Kost Puragabaya</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="p-20 bg-white min-h-screen">
        <div>
            <h1 class="text-center text-2xl font-bold">Laporan Keuangan Rumahku Kost Periode {{ $period }}</h1>
            <div class="flex flex-col gap-5 mt-10">
                @foreach($months as $month => $entries)
                <div>
                    <h1 class="text-center my-5">{{ $month }}</h1>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 border">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Keterangan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pemasukan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pengeluaran
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1 @endphp
                                @foreach($entries as $data)
                                <tr class="bg-white border">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $count++ }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $data->keterangan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($data->type == "Pengeluaran")
                                        {{ $data->tanggalPengeluaran }}
                                        @elseif($data->type == "Pemasukan")
                                        {{ $data->tanggalPembayaran }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($data->type == "Pemasukan")
                                        {{ 'Rp. ' . number_format($data->nominal, 2, ',', '.') }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($data->type == "Pengeluaran")
                                        {{ 'Rp. ' . number_format($data->jumlah, 2, ',', '.') }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center justify-end gap-5 mt-5 text-[#1068EB] font-bold">
                        <p>Total bersih {{ $month }}:  {{ 'Rp. ' . number_format($monthSums[$month]['net_balance'], 2, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="w-1/2">
                <h1 class="text-center text-2xl font-bold">Total Hasil Periode {{ $period }}</h1>
                <div class="text-xl font-bold text-[#0EDD5F] flex items-center justify-around border py-1 px-4 my-4 rounded-md">
                    <p>Total Pemasukan</p>
                    <p>{{ 'Rp. ' . number_format($totalPemasukan, 2, ',', '.') }}</p>
            </div>
                <div class="text-xl font-bold text-[#F61717] flex items-center justify-around border py-1 px-4 my-4 rounded-md">
                    <p>Total Pengeluaran</p>
                    <p>{{ 'Rp. ' . number_format($totalPengeluaran, 2, ',', '.') }}</p>
            </div>
                <div class="text-xl font-bold text-white bg-[#1068EB] flex items-center justify-around border py-1 px-4 my-4 rounded-md">
                    <p>Total Bersih</p>
                    <p>{{ 'Rp. ' . number_format($totalPemasukan - $totalPengeluaran, 2, ',', '.') }}</p>
            </div>
            </div>
        </div>
    </div>
    </body>
</html>