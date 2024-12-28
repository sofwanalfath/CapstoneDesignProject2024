<x-app-layout>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen flex flex-col gap-y-10">
        <div class="overflow-hidden sm:rounded-lg">
            <div class="p-6 text-center text-3xl font-black text-[#212C5F]">
                Laporan Keuangan Rumahku Kos
            </div>
        </div>
        <div class="flex justify-around items-center w-full">
            <div class="w-4/12 bg-white rounded-md p-3">
                <h1 class="text-center text-lg font-medium">Laporan Keuangan</h1>
                <form class="mt-4" action="{{ route('print') }}" method="post">
                    @csrf
                    <div class="mb-6 flex items-center">
                        <label for="tanggalAwal" class="block mb-2 font-medium text-gray-900 w-2/3 text-sm">Tanggal Awal</label>
                        <input type="date" id="tanggalAwal" name="tanggalAwal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <div class="mb-6 flex items-center">
                        <label for="tanggalAkhir" class="block mb-2 font-medium text-gray-900 w-2/3 text-sm">Tanggal Akhir</label>
                        <input type="date" id="tanggalAkhir" name="tanggalAkhir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="flex items-center gap-2 py-2 px-4 rounded-md bg-[#CED5FC] text-bold">Cetak <img src="{{ asset('assets/cetak.png') }}" alt="Cetak"></button>
                    </div>
                </form>
            </div>
            <div class="w-4/12 bg-white rounded-md p-3 h-full">
                <h1 class="text-center text-lg font-medium">Laporan Keuangan Tahunan</h1>
                <form class="mt-4" action="{{ route('print') }}" method="post">
                    @csrf
                    <div class="mb-6 flex items-center">
                        <label for="filterTahun" class="block mb-2 font-medium text-gray-900 w-2/3 text-sm">Tahun</label>
                        <select id="filterTahun" name="filterTahun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            @foreach($years as $data => $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="flex items-center gap-2 py-2 px-4 rounded-md bg-[#CED5FC] text-bold">Cetak <img src="{{ asset('assets/cetak.png') }}" alt="Cetak"></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-10 mx-auto w-10/12">
            <div class="border-2 rounded-lg p-4 bg-white">
                <h1 class="text-center text-xl font-bold">Laporan Bulan {{ $lastTwoMonthsName }} {{ $currentYear }}</h1>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#0EDD5F]">
                    <p class="">Pemasukan</p>
                    <p>{{ 'Rp. ' . number_format($pemasukanLastTwoMonths, 2, ',', '.') }}</p>
                </div>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#F24E1E]">
                    <p>Pengeluaran</p>
                    <p>{{ 'Rp. ' . number_format($pengeluaranLastTwoMonths, 2, ',', '.') }}</p>
                </div>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#1068EB]">
                    <p>Total</p>
                    <p>{{ 'Rp. ' . number_format($pemasukanLastTwoMonths-$pengeluaranLastTwoMonths, 2, ',', '.') }}</p>
                </div>
                <a href="{{ route('printFiltered', $lastTwoMonthsName) }}" class="flex justify-center">
                        <button class="flex items-center gap-2 py-2 px-4 rounded-md bg-[#CED5FC] text-bold">Cetak <img src="{{ asset('assets/cetak.png') }}" alt="Cetak"></button>
                </a>
            </div>
            <div class="border-2 rounded-lg p-4 bg-white">
                <h1 class="text-center text-xl font-bold">Laporan Bulan {{ $lastThreeMonthsName }} {{ $currentYear }}</h1>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#0EDD5F]">
                    <p class="">Pemasukan</p>
                    <p>{{ 'Rp. ' . number_format($pemasukanLastThreeMonth, 2, ',', '.') }}</p>
                </div>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#F24E1E]">
                    <p>Pengeluaran</p>
                    <p>{{ 'Rp. ' . number_format($pengeluaranLastThreeMonth, 2, ',', '.') }}</p>
                </div>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#1068EB]">
                    <p>Total</p>
                    <p>{{ 'Rp. ' . number_format($pemasukanLastThreeMonth-$pengeluaranLastThreeMonth, 2, ',', '.') }}</p>
                </div>
                <a href="{{ route('printFiltered', $lastThreeMonthsName) }}" class="flex justify-center">
                        <button class="flex items-center gap-2 py-2 px-4 rounded-md bg-[#CED5FC] text-bold">Cetak <img src="{{ asset('assets/cetak.png') }}" alt="Cetak"></button>
                </a>
            </div>
            <div class="border-2 rounded-lg p-4 bg-white">
                <h1 class="text-center text-xl font-bold">Laporan Bulan {{ $lastMonthName }} {{ $currentYear }}</h1>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#0EDD5F]">
                    <p class="">Pemasukan</p>
                    <p>{{ 'Rp. ' . number_format($pemasukanLastMonth, 2, ',', '.') }}</p>
                </div>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#F24E1E]">
                    <p>Pengeluaran</p>
                    <p>{{ 'Rp. ' . number_format($pengeluaranLastMonth, 2, ',', '.') }}</p>
                </div>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#1068EB]">
                    <p>Total</p>
                    <p>{{ 'Rp. ' . number_format($pemasukanLastMonth-$pengeluaranLastMonth, 2, ',', '.') }}</p>
                </div>
                <a href="{{ route('printFiltered', $lastMonthName) }}" class="flex justify-center">
                        <button class="flex items-center gap-2 py-2 px-4 rounded-md bg-[#CED5FC] text-bold">Cetak <img src="{{ asset('assets/cetak.png') }}" alt="Cetak"></button>
                </a>
            </div>
            <div class="border-2 rounded-lg p-4 bg-white">
                <h1 class="text-center text-xl font-bold">Laporan Bulan {{ $currentMonthName }} {{ $currentYear }}</h1>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#0EDD5F]">
                    <p class="">Pemasukan</p>
                    <p>{{ 'Rp. ' . number_format($pemasukanCurrentMonth, 2, ',', '.') }}</p>
                </div>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#F24E1E]">
                    <p>Pengeluaran</p>
                    <p>{{ 'Rp. ' . number_format($pengeluaranCurrentMonth, 2, ',', '.') }}</p>
                </div>
                <hr>
                <div class="flex items-center justify-between my-3 text-[#1068EB]">
                    <p>Total</p>
                    <p>{{ 'Rp. ' . number_format($pemasukanCurrentMonth-$pengeluaranCurrentMonth, 2, ',', '.') }}</p>
                </div>
                <a href="{{ route('printFiltered', $currentMonthName) }}" class="flex justify-center">
                        <button class="flex items-center gap-2 py-2 px-4 rounded-md bg-[#CED5FC] text-bold">Cetak <img src="{{ asset('assets/cetak.png') }}" alt="Cetak"></button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
