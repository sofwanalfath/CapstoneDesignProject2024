<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pemasukan = Pemasukan::all();
        $tanggalAwal = $request->tanggalAwal;
        $tanggalAkhir = $request->tanggalAkhir;
        
        if($tanggalAwal && $tanggalAkhir){
            $pemasukan = Pemasukan::whereBetween('tanggalPembayaran', [$tanggalAwal, $tanggalAkhir])->get();
        }

        return view ('pemasukan.index', compact('pemasukan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('pemasukan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            if($request->status){
                $request->validate([
                    "kamar" => "required",
                    "penghuni" => "required",
                    "tanggalPembayaran" => "required",
                    "nominal" => "required",
                    "status" => "required",
                    "keterangan" => "required"
                ]);
                Pemasukan::create([
                    "kamar" => $request->kamar,
                    "penghuni" => $request->penghuni,
                    "tanggalPembayaran" => $request->tanggalPembayaran,
                    "nominal" => $request->nominal,
                    "status" => $request->status,
                    "keterangan" => $request->keterangan
                ]);
            }else{
                $request->validate([
                "kamar" => "required",
                "penghuni" => "required",
                "tanggalPembayaran" => "required",
                "nominal" => "required",
                "keterangan" => "required"
                ]);
                Pemasukan::create([
                    "kamar" => $request->kamar,
                    "penghuni" => $request->penghuni,
                    "tanggalPembayaran" => $request->tanggalPembayaran,
                    "nominal" => $request->nominal,
                    "keterangan" => $request->keterangan
                ]);
            }

            return redirect()->route('pemasukan')->with('message', 'Berhasil menginput pemasukan baru');
        }catch(\Exception $e){
            dd($e);
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
            $pemasukan = Pemasukan::find($id);
            if($request->status){
                $request->validate([
                    "kamar" => "required",
                    "penghuni" => "required",
                    "tanggalPembayaran" => "required",
                    "nominal" => "required",
                    "status" => "required",
                    "keterangan" => "required"
                ]);

                $pemasukan->update([
                    "kamar" => $request->kamar,
                    "penghuni" => $request->penghuni,
                    "tanggalPembayaran" => $request->tanggalPembayaran,
                    "nominal" => $request->nominal,
                    "status" => $request->status,
                    "keterangan" => $request->keterangan
                ]);
            }else{
                $request->validate([
                    "kamar" => "required",
                    "penghuni" => "required",
                    "tanggalPembayaran" => "required",
                    "nominal" => "required",
                    "keterangan" => "required"
                ]);

                $pemasukan->update([
                    "kamar" => $request->kamar,
                    "penghuni" => $request->penghuni,
                    "tanggalPembayaran" => $request->tanggalPembayaran,
                    "nominal" => $request->nominal,
                    "keterangan" => $request->keterangan
                ]);
            }

            return redirect()->route('pemasukan')->with('message', 'Berhasil mengedit pemasukan baru');
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
            $pemasukan = Pemasukan::find($id);
            $pemasukan->delete();

            return redirect()->back()->with('message', 'Berhasil menghapus pemasukan');
        } catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
