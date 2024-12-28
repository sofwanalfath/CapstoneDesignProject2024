<x-app-layout>
    <h1 class="text-center font-bold text-2xl">Tambah Penyewa</h1>
    <form action="{{ route('penyewa.store') }}" method="post" class="mt-5 rounded-md p-10 bg-white">
        @csrf
        <div class="mb-6 flex items-center">
            <label for="jenisSewaKamar" class="block mb-2 font-medium text-gray-900 w-3/12 text-lg">Jenis Sewa Kamar</label>
            <select id="jenisSewaKamar" name="jenisSewaKamar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <option selected value="">Jenis Sewa Kamar</option>
                <option value="Harian">Harian</option>
                <option value="Mingguan">Mingguan</option>
                <option value="Bulanan">Bulanan</option>
            </select>
        </div>
        <div class="mb-6 flex items-center">
            <label for="noKamar" class="block mb-2 font-medium text-gray-900 w-3/12 text-lg">No Kamar</label>
            <input type="text" id="noKamar" name="noKamar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div class="mb-6 flex items-center">
            <label for="nama" class="block mb-2 font-medium text-gray-900 w-3/12 text-lg">Nama</label>
            <input type="tel" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div class="mb-6 flex items-center">
            <label for="noHP" class="block mb-2 font-medium text-gray-900 w-3/12 text-lg">No HP</label>
            <input type="tel" id="noHP" name="noHP" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div class="mb-6 flex items-center">
            <label for="kontakDarurat" class="block mb-2 font-medium text-gray-900 w-3/12 text-lg">Kontak Darurat</label>
            <input type="text" id="kontakDarurat" name="kontakDarurat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div class="mb-6 flex items-center">
            <label for="jenisKelamin" class="block mb-2 font-medium text-gray-900 w-3/12 text-lg">Jenis Kelamin</label>
            <select id="jenisKelamin" name="jenisKelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <option selected value="">Jenis Kelamin</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-6 flex items-center">
            <label for="tanggalMasuk" class="block mb-2 font-medium text-gray-900 w-3/12 text-lg">Tanggal Masuk</label>
            <input type="date" id="tanggalMasuk" name="tanggalMasuk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div class="mb-6 flex items-center">
            <label for="lamaSewa" class="block mb-2 font-medium text-gray-900 w-3/12 text-lg">Lama Sewa</label>
            <input type="number" id="lamaSewa" name="lamaSewa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div class="mb-6 flex items-center">
            <label for="hargaSewa" class="block mb-2 font-medium text-gray-900 w-3/12 text-lg">Harga Sewa</label>
            <input type="number" id="hargaSewa" name="hargaSewa"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>
        <div class="flex justify-end">
            <button class="bg-[#CED5FC] rounded-md px-5 py-3" type="submit">Simpan</button>
        </div>
    </form>
</x-app-layout>