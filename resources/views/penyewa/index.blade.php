<x-app-layout>
    <div class="flex flex-col gap-y-4">
        
    <h1 class="text-center font-bold text-2xl">Manajemen Penyewa Rumahku Kost</h1>
    <div>
        <a href="{{ route('penyewa.create') }}" class="bg-[#CED5FC] rounded-md px-5 py-3 font-bold" type="submit">Tambah Penyewa</a>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No Kmr
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        No HP
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tgl Masuk
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga Sewa
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lm Sewa
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status Bayar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($penyewa as $data)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $data->noKamar }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $data->nama }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $data->noHP }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $data->tanggalMasuk }}
                    </td>
                    <td class="px-6 py-4">
                        {{ 'Rp. ' . number_format($data->hargaSewa, 2, ',', '.') }}/{{ $data->sewaKamar }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $data->lamaSewa }} {{ $data->sewaKamar }}
                    </td>
                    <td class="px-6 py-4">
                        @if($data->status == "Belum Lunas")
                        <button class="py-1 px-2 text-white text-xs font-semibold bg-[#F82929] rounded-md">Belum Lunas</button>
                        @else
                        <button class="py-1 px-2 text-white text-xs font-semibold bg-[#08C552] rounded-md">Lunas</button>
                        @endif
                    </td>
                    <td class="px-6 py-4 flex items-center">
                        <button data-modal-target="edit-modal{{$data->id}}" data-modal-toggle="edit-modal{{$data->id}}" class="w-fit"><img src="{{ asset('assets/edit.png') }}" alt="" class="w-2/3"></button>
                        <button data-modal-target="delete-modal{{$data->id}}" data-modal-toggle="delete-modal{{$data->id}}" class="w-fit"><img src="{{ asset('assets/delete.png') }}" alt="" class="w-2/3"></button>
                        <button data-modal-target="show-modal{{$data->id}}" data-modal-toggle="show-modal{{$data->id}}" class="w-fit"><img src="{{ asset('assets/show.png') }}" alt="" class="w-2/3"></button>
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
                                    Ubah Data Penyewa
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
                                <form action="{{ route('penyewa.update', $data->id) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="mb-6 flex items-center">
                                        <label for="jenisSewaKamar" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Jenis Sewa Kamar</label>
                                        <select id="jenisSewaKamar" name="jenisSewaKamar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                            <option selected value="">Jenis Sewa Kamar</option>
                                            <option value="Harian" {{ $data->jenisSewaKamar == "Harian" ? 'selected' : '' }} >Harian</option>
                                            <option value="Mingguan" {{ $data->jenisSewaKamar == "Mingguan" ? 'selected' : '' }} >Mingguan</option>
                                            <option value="Bulanan" {{ $data->jenisSewaKamar == "Bulanan" ? 'selected' : '' }} >Bulanan</option>
                                        </select>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="noKamar" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">No Kamar</label>
                                        <input type="text" id="noKamar" name="noKamar" value="{{ $data->noKamar }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="nama" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Nama</label>
                                        <input type="tel" id="nama" name="nama" value="{{ $data->nama }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="noHP" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">No HP</label>
                                        <input type="tel" id="noHP" name="noHP" value="{{ $data->noHP }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="kontakDarurat" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Kontak Darurat</label>
                                        <input type="text" id="kontakDarurat" name="kontakDarurat" value="{{ $data->kontakDarurat }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="jenisKelamin" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Jenis Kelamin</label>
                                        <select id="jenisKelamin" name="jenisKelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                            <option selected value="">Jenis Kelamin</option>
                                            <option value="Laki-Laki" {{ $data->jenisKelamin == "Laki-Laki" ? 'selected' : '' }} >Laki-Laki</option>
                                            <option value="Perempuan" {{ $data->jenisKelamin == "Perempuan" ? 'selected' : '' }} >Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="tanggalMasuk" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Tanggal Masuk</label>
                                        <input type="date" id="tanggalMasuk" name="tanggalMasuk" value="{{ $data->tanggalMasuk }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="lamaSewa" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Lama Sewa</label>
                                        <input type="number" id="lamaSewa" name="lamaSewa" value="{{ $data->lamaSewa }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="hargaSewa" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Harga Sewa</label>
                                        <input type="number" id="hargaSewa" name="hargaSewa" value="{{ $data->hargaSewa }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="keterangan" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Keterangan</label>
                                       <textarea id="keterangan" name="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Keterangan..." required>{{ $data->keterangan }}</textarea>
                                    </div>
                                    @if(Auth::user()->is_pemilik_kost == True)
                                    <div class="mb-6 flex items-center">
                                        <label for="hargaSewa" class="block mb-2 font-medium text-gray-900 w-4/12 text-sm">Status</label>                       
                                        <div class="w-full">
                                            <div class="flex items-center mb-4">
                                                <input {{ $data->status == "Lunas" ? 'checked' : '' }} value="Lunas" id="status" type="radio" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" required>
                                                <label for="status" class="ms-2 text-sm font-medium text-gray-900">Lunas</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input {{ $data->status == "Belum Lunas" ? 'checked' : '' }} value="Belum Lunas"  id="status" type="radio" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" required>
                                                <label for="status" class="ms-2 text-sm font-medium text-gray-900" >Belum Lunas</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
                                    Detail Penyewa
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
                                <div>
                                    <div class="mb-6 flex items-center">
                                        <label for="jenisSewaKamar" class="block font-medium text-gray-900 w-1/2 text-lg">Jenis Sewa Kamar</label>
                                        <div id="jenisSewaKamar" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->jenisSewaKamar }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="noKamar" class="block font-medium text-gray-900 w-1/2 text-lg">No Kamar</label>
                                        <div id="noKamar" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->noKamar }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="nama" class="block font-medium text-gray-900 w-1/2 text-lg">Nama</label>
                                        <div id="nama" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->nama }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="noHP" class="block font-medium text-gray-900 w-1/2 text-lg">No HP</label>
                                        <div id="noHP" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->noHP }}
                                        </div></div>
                                    <div class="mb-6 flex items-center">
                                        <label for="kontakDarurat" class="block font-medium text-gray-900 w-1/2 text-lg">Kontak Darurat</label>
                                        <div id="noKamar" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->kontakDarurat }}
                                        </div></div>
                                    <div class="mb-6 flex items-center">
                                        <label for="jenisKelamin" class="block font-medium text-gray-900 w-1/2 text-lg">Jenis Kelamin</label>
                                       <div id="jenisKelamin" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->jenisKelamin }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="tanggalMasuk" class="block font-medium text-gray-900 w-1/2 text-lg">Tanggal Masuk</label>
                                        <div id="tanggalMasuk" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->tanggalMasuk }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="tanggalKeluar" class="block font-medium text-gray-900 w-1/2 text-lg">Tanggal Keluar</label>
                                       <div id="tanggalKeluar" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->tanggalKeluar }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="lamaSewa" class="block font-medium text-gray-900 w-1/2 text-lg">Lama Sewa</label>
                                        <div id="lamaSewa" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->lamaSewa }} {{ $data->sewaKamar }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="hargaSewa" class="block font-medium text-gray-900 w-1/2 text-lg">Harga Sewa</label>
                                        <div id="hargaSewa" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ 'Rp. ' . number_format($data->hargaSewa, 2, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="totalSewa" class="block font-medium text-gray-900 w-1/2 text-lg">Total Sewa</label>
                                        <div id="totalSewa" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ 'Rp. ' . number_format($data->totalSewa, 2, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="totalSewa" class="block font-medium text-gray-900 w-1/2 text-lg">Keterangan</label>
                                        <div id="totalSewa" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->keterangan }}
                                        </div>
                                    </div>
                                    <div class="mb-6 flex items-center">
                                        <label for="totalSewa" class="block font-medium text-gray-900 w-1/2 text-lg">Status</label>
                                        <div id="totalSewa" class="w-1/2 text-gray-900 text-lg block p-2.5">
                                            {{ $data->status }}
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <button data-modal-hide="show-modal{{$data->id}}" class="bg-[#CED5FC] rounded-md px-5 py-3" type="submit">Tutup</button>
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
                                <h3 class="mb-5 text-lg font-normal text-gray-500">Hapus Data Penyewa?</h3>
                                <form action="{{ route('penyewa.destroy', $data->id) }}" method="post">
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
</x-app-layout>