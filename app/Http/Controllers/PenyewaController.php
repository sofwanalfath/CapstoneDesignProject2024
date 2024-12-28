<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewa = Penyewa::all();
        foreach($penyewa as $data){
            if($data->jenisSewaKamar == "Harian"){
                $data->sewaKamar = "Hari";
            } else if($data->jenisSewaKamar == "Mingguan"){
                $data->sewaKamar = "Minggu";
            } else if($data->jenisSewaKamar == "Bulanan"){
                $data->sewaKamar = "Bulan";
            }
        }

        return view ('penyewa.index', compact('penyewa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('penyewa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                "jenisSewaKamar" => "required",
                "noKamar" => "required",
                "nama" => "required",
                "noHP" => "required",
                "kontakDarurat" => "required",
                "jenisKelamin" => "required",
                "tanggalMasuk" => "required",
                "lamaSewa" => "required",
                "hargaSewa" => "required"
            ]);

            $kelipatan = 1;
            $totalSewa = $request->lamaSewa * $request->hargaSewa;

            if($request->jenisSewaKamar == "Harian"){
                $kelipatan = 1;
            } else if($request->jenisSewaKamar == "Mingguan"){
                $kelipatan = 7;
            } else if($request->jenisSewaKamar == "Bulanan"){
                $kelipatan = 30;
            } 

            $tanggalMasuk = Carbon::parse($request->tanggalMasuk);
            $tanggalKeluar = $tanggalMasuk->addDays($kelipatan * $request->lamaSewa);

            Penyewa::create([
                'jenisSewaKamar' => $request->jenisSewaKamar,
                "noKamar" => $request->noKamar,
                "nama" => $request->nama,
                "noHP" => $request->noHP,
                "kontakDarurat" => $request->kontakDarurat,
                "jenisKelamin" => $request->jenisKelamin,
                "tanggalMasuk" => $request->tanggalMasuk,
                "tanggalKeluar" => $tanggalKeluar,
                "lamaSewa" => $request->lamaSewa,
                "hargaSewa" => $request->hargaSewa,
                "totalSewa" => $totalSewa,
                "keterangan" => $request->keterangan,
            ]);

            return redirect()->route('penyewa')->with('message', 'Berhasil menginput penyewa baru');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $penyewa = Penyewa::find($id);

            $request->validate([
                "jenisSewaKamar" => "required",
                "noKamar" => "required",
                "nama" => "required",
                "noHP" => "required",
                "kontakDarurat" => "required",
                "jenisKelamin" => "required",
                "tanggalMasuk" => "required",
                "lamaSewa" => "required",
                "hargaSewa" => "required",
                "keterangan" => "required"
            ]);

            $kelipatan = 1;
            $totalSewa = $request->lamaSewa * $request->hargaSewa;
            if($request->jenisSewaKamar == "Harian"){
                $kelipatan = 1;
            } else if($request->jenisSewaKamar == "Mingguan"){
                $kelipatan = 7;
            } else if($request->jenisSewaKamar == "Mingguan"){
                $kelipatan = 30;
            } 

            $tanggalMasuk = Carbon::parse($request->tanggalMasuk);
            $tanggalKeluar = $tanggalMasuk->addDays($kelipatan * $request->lamaSewa);

            if($request->status){
                $penyewa->update(["status" => $request->status]);
            }

            $penyewa->update([
                'jenisSewaKamar' => $request->jenisSewaKamar,
                "noKamar" => $request->noKamar,
                "nama" => $request->nama,
                "noHP" => $request->noHP,
                "kontakDarurat" => $request->kontakDarurat,
                "jenisKelamin" => $request->jenisKelamin,
                "tanggalMasuk" => $request->tanggalMasuk,
                "tanggalKeluar" => $tanggalKeluar,
                "lamaSewa" => $request->lamaSewa,
                "hargaSewa" => $request->hargaSewa,
                "totalSewa" => $totalSewa,
                "keterangan" => $request->keterangan,
            ]);

            return redirect()->route('penyewa')->with('message', 'Berhasil mengedit penyewa');

        }catch(\Exception $e){
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $penyewa = Penyewa::find($id);
            $penyewa->delete();

            return redirect()->back()->with('message', 'Berhasil menghapus penyewa');
        } catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
