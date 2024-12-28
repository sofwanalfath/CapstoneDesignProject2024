<x-app-layout>
    <div class="flex flex-col gap-y-4">    
        <h1 class="text-center font-bold text-2xl">Daftar Pengeluaran</h1>
        <div class="flex items-end justify-between">
            <form action="{{ route('pengeluaran.filter') }}" method="post" class="w-4/12 bg-white rounded-md p-3">
                @csrf
                <h1 class="text-center text-lg font-medium">Lihat Pengeluaran</h1>
                <div class="mt-4">
                    <div class="mb-6 flex items-center">
                        <label for="tanggalAwal" class="block mb-2 font-medium text-gray-900 w-2/3 text-sm">Tanggal Awal</label>
                        <input type="date" id="tanggalAwal" name="tanggalAwal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <div class="mb-6 flex items-center">
                        <label for="tanggalAkhir" class="block mb-2 font-medium text-gray-900 w-2/3 text-sm">Tanggal Akhir</label>
                        <input type="date" id="tanggalAkhir" name="tanggalAkhir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <div class="flex w-full justify-center">
                        <button type="submit" class="rounded-md py-1 px-4 bg-[#CED5FC]">Filter</button>
                    </div>
                </div>
            </form>
            <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="bg-[#CED5FC] rounded-md px-5 py-3 font-bold" type="submit">+ Tambah Pengeluaran</button>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Pengeluaran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Opsi
                        </th>
                    </tr>
                </thead>
                <tbody>
                @php $counter = 1; @endphp
                @foreach($pengeluaran as $data)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $counter++ }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $data->namaPengeluaran }}
                    </td>
                    <td class="px-6 py-4">
                        {{ 'Rp. ' . number_format($data->jumlah, 2, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $data->keterangan }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $data->tanggalPengeluaran }}
                    </td>
                    </td>
                    <td class="px-6 py-4 flex items-center gap-2">
                        <button data-modal-target="edit-modal{{$data->id}}" data-modal-toggle="edit-modal{{$data->id}}" class="text-black text-xs font-semibold w-fit rounded-md py-1 px-2 bg-[#CED5FC]">Ubah</button>
                        <button data-modal-target="delete-modal{{$data->id}}" data-modal-toggle="delete-modal{{$data->id}}" class="text-black text-xs font-semibold w-fit rounded-md py-1 px-2 bg-[#FA6C6C]">Hapus</button>
                        <button data-modal-target="show-modal{{$data->id}}" data-modal-toggle="show-modal{{$data->id}}" class="text-black text-xs font-semibold w-fit rounded-md py-1 px-2 bg-[#8BDF80]">Lihat</button>
                    </td>
                </tr>

                <!-- Edit modal -->
                <div id="edit-modal{{$data->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900 text-center">
                                    Ubah Data Pengeluaran
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal{{$data->id}}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <form action="{{ route('pengeluaran.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf
                                    <div class="mb-6">
                                        <label for="namaPengeluaran" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Nama Pengeluaran</label>
                                        <input type="text" value="{{ $data->namaPengeluaran }}" id="namaPengeluaran" name="namaPengeluaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    </div>
                                    <div class="mb-6">
                                        <label for="jumlah" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Jumlah</label>
                                        <input type="tel" value="{{ $data->jumlah }}" id="jumlah" name="jumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    </div>
                                    <div class="mb-6">
                                        <label for="keteranganPengeluaran" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Keterangan Pengeluaran</label>
                                        <textarea id="keteranganPengeluaran" name="keteranganPengeluaran" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Keterangan..." required>{{ $data->keterangan }}</textarea>
                                    </div>
                                    <div class="mb-6">
                                        <label for="tanggalPengeluaran" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Tanggal Pengeluaran</label>
                                        <input type="date" value="{{ $data->tanggalPengeluaran }}" id="tanggalPengeluaran" name="tanggalPengeluaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    </div>
                                    <div class="mb-6">
                                        <label for="buktiPengeluaran" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Bukti Pengeluaran</label>
                                        <div class="w-full">
                                            <input id="buktiPengeluaran" value="{{ $data->buktiPengeluaran }}" name="buktiPengeluaran" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="file_input_help" type="file" required>
                                            <p class="mt-1 text-xs" id="file_input_help">PNG, JPG or JPEG (MAX. 800x400px).</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <button class="bg-[#CED5FC] rounded-md px-5 py-3" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Show modal -->
                <div id="show-modal{{$data->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900 text-center">
                                    Detail Pengeluaran Kost
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="show-modal{{$data->id}}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <div class="flex justify-center w-full">
                                    <img class="w-1/2" src="{{ asset('storage/public/buktiPengeluaran/'. $data->buktiPengeluaran) }}" alt="">
                                </div>
                                <div>
                                    <div class="mb-6 flex items-center">
                                        <label for="kamar" class="block font-medium text-gray-900 w-1/2 text-lg">Nama Pengeluaran</label>
                                        <div id="kamar" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->namaPengeluaran }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="penghuni" class="block font-medium text-gray-900 w-1/2 text-lg">Jumlah</label>
                                        <div id="penghuni" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ 'Rp. ' . number_format($data->jumlah, 2, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="tanggalPembayaran" class="block font-medium text-gray-900 w-1/2 text-lg">Keterangan Pengeluaran</label>
                                        <div id="tanggalPembayaran" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->keterangan }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="nominal" class="block font-medium text-gray-900 w-1/2 text-lg">Tanggal Pengeluaran</label>
                                        <div id="nominal" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->tanggalPengeluaran }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div id="delete-modal{{$data->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="delete-modal{{$data->id}}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500">Hapus Data Pengeluaran?</h3>
                                <form action="{{ route('pengeluaran.destroy', $data->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button data-modal-hide="delete-modal{{$data->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                                    <button data-modal-hide="delete-modal{{$data->id}}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

    <!-- Create modal -->
    <div id="create-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 text-center">
                        Tambah Pengeluaran Kost
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="create-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form action="{{ route('pengeluaran.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="namaPengeluaran" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Nama Pengeluaran</label>
                            <input type="text" id="namaPengeluaran" name="namaPengeluaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="mb-6">
                            <label for="jumlah" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Jumlah</label>
                            <input type="tel" id="jumlah" name="jumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="mb-6">
                            <label for="keteranganPengeluaran" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Keterangan Pengeluaran</label>
                            <textarea id="keteranganPengeluaran" name="keteranganPengeluaran" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Keterangan..." required></textarea>
                        </div>
                        <div class="mb-6">
                            <label for="tanggalPengeluaran" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Tanggal Pengeluaran</label>
                            <input type="date" id="tanggalPengeluaran" name="tanggalPengeluaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="mb-6">
                            <label for="buktiPengeluaran" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Bukti Pengeluaran</label>
                            <div class="w-full">
                                <input id="buktiPengeluaran" name="buktiPengeluaran" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="file_input_help" type="file" required>
                                <p class="mt-1 text-xs" id="file_input_help">PNG, JPG or JPEG (MAX. 800x400px).</p>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <button class="bg-[#CED5FC] rounded-md px-5 py-3" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>