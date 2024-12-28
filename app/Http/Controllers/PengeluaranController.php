<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pengeluaran = Pengeluaran::all();
        $tanggalAwal = $request->tanggalAwal;
        $tanggalAkhir = $request->tanggalAkhir;

         if($tanggalAwal && $tanggalAkhir){
            $pengeluaran = Pengeluaran::whereBetween('tanggalPengeluaran', [$tanggalAwal, $tanggalAkhir])->get();
        }

        return view ('pengeluaran.index', compact('pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                "namaPengeluaran" => "required",
                "jumlah" => "required",
                "keteranganPengeluaran" => "required",
                "tanggalPengeluaran" => "required",
                'buktiPengeluaran' => 'required|mimes:png,jpeg,jpg',
            ]);

            $filenameExt = $request->file('buktiPengeluaran')->getClientOriginalName();
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
            $extension = $request->file('buktiPengeluaran')->getClientOriginalExtension();
            $filenameSave = $filename.'_'.time().'.'.$extension;
            $request->file('buktiPengeluaran')->storeAs('public/buktiPengeluaran', $filenameSave, 'public');

            Pengeluaran::create([
                "namaPengeluaran" => $request->namaPengeluaran,
                "jumlah" => $request->jumlah,
                "keterangan" => $request->keteranganPengeluaran,
                "tanggalPengeluaran" => $request->tanggalPengeluaran,
                "buktiPengeluaran" => $filenameSave,
            ]);

            return redirect()->route('pengeluaran')->with('message', 'Berhasil menginput pengeluaran baru');
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
            $request->validate([
                "namaPengeluaran" => "required",
                "jumlah" => "required",
                "keteranganPengeluaran" => "required",
                "tanggalPengeluaran" => "required",
                'buktiPengeluaran' => 'required|mimes:png,jpeg,jpg',
            ]);

            $pengeluaran = Pengeluaran::find($id);

            if($request->file('buktiPengeluaran')){
                if(Storage::disk('public')->exists('buktiPengeluaran/'. $pengeluaran->photo1)){
                    Storage::disk('public')->delete('buktiPengeluaran/'. $pengeluaran->photo1);
                }

                $filenameExt = $request->file('buktiPengeluaran')->getClientOriginalName();
                $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
                $extension = $request->file('buktiPengeluaran')->getClientOriginalExtension();
                $filenameSave = $filename.'_'.time().'.'.$extension;
                $request->file('buktiPengeluaran')->storeAs('public/buktiPengeluaran', $filenameSave, 'public');

                $pengeluaran->update(['buktiPengeluaran' => $filenameSave]);
            }
            $pengeluaran->update([
                "namaPengeluaran" => $request->namaPengeluaran,
                "jumlah" => $request->jumlah,
                "keterangan" => $request->keteranganPengeluaran,
                "tanggalPengeluaran" => $request->tanggalPengeluaran,
            ]);

            return redirect()->route('pengeluaran')->with('message', 'Berhasil menginput pengeluaran baru');
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
            $pengeluaran = Pengeluaran::find($id);
            $pengeluaran->delete();

            return redirect()->back()->with('message', 'Berhasil menghapus pengeluaran');
        } catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
