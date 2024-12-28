<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penyewa;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index(){
        Carbon::setLocale('id');
        $penyewa = Penyewa::all();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $currentMonthName = Carbon::now()->translatedFormat('F');
        $totalPemasukanCurrentMonth = Pemasukan::whereMonth('tanggalPembayaran', $currentMonth)->whereYear('tanggalPembayaran', $currentYear)->sum('nominal');
        $totalPemasukan = Pemasukan::whereYear('tanggalPembayaran', $currentYear)->sum('nominal');
        $totalPengeluaranCurrentMonth = Pengeluaran::whereMonth('tanggalPengeluaran', $currentMonth)->whereYear('tanggalPengeluaran', $currentYear)->sum('jumlah');
        $totalPengeluaran = Pengeluaran::whereYear('tanggalPengeluaran', $currentYear)->sum('jumlah');
        $currentYear = Carbon::now()->year;

        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $pemasukanMonths = ['Januari' => 0, 'Februari' => 0, 'Maret' => 0, 'April' => 0, 'Mei' => 0, 'Juni' => 0, 'Juli' => 0, 'Agustus' => 0, 'September' => 0, 'Oktober' => 0, 'November' => 0, 'Desember' => 0];
        $pengeluaranMonths = ['Januari' => 0, 'Februari' => 0, 'Maret' => 0, 'April' => 0, 'Mei' => 0, 'Juni' => 0, 'Juli' => 0, 'Agustus' => 0, 'September' => 0, 'Oktober' => 0, 'November' => 0, 'Desember' => 0];
        $pemasukan = Pemasukan::whereYear('tanggalPembayaran', $currentYear)->get();
        $pengeluaran = Pengeluaran::whereYear('tanggalPengeluaran', $currentYear)->get();

        foreach($months as $month){
            foreach($pemasukan as $data){
                $bulan = Carbon::parse($data->tanggalPembayaran);
                $monthName = $bulan->translatedFormat('F');
                if($month == $monthName){
                    $pemasukanMonths[$month] += $data->nominal;
                }
            }
            foreach($pengeluaran as $data){
                $bulan = Carbon::parse($data->tanggalPengeluaran);
                $monthName = $bulan->translatedFormat('F');
                if($month == $monthName){
                    $pengeluaranMonths[$month] += $data->jumlah;
                }
            }
        }
        $pemasukanValues = array_values($pemasukanMonths);
        $pengeluaranValues = array_values($pengeluaranMonths);

        $lastYear = Carbon::now()->subYear()->year;
        $pemasukanLastYear = (int) Pemasukan::whereYear('tanggalPembayaran', $lastYear)->sum('nominal');
        $pemasukanThisYear = (int) Pemasukan::whereYear('tanggalPembayaran', $currentYear)->sum('nominal');
        $netBalance = $totalPemasukan - $totalPengeluaran;

        $pemasukanValuesVAT = 
        [
            'Januari' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'Februari' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'Maret' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'April' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'Mei' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'Juni' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'Juli' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'Agustus' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'September' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'Oktober' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'November' => ['pemasukan' => 0, 'pajak' => 0 ], 
            'Desember' => ['pemasukan'  => 0, 'pajak' => 0]
        ];

        foreach($pemasukanMonths as $month => $data){
            $vat = ($data * 0.1 );
            $pemasukanValuesVAT[$month] = [
                'pemasukan' => $data,
                'pajak' => $vat,
            ];
        }

        return view ('dashboard', compact('totalPengeluaranCurrentMonth', 'totalPemasukanCurrentMonth', 'pemasukanValuesVAT', 'currentYear', 'currentMonthName', 'penyewa', 'totalPemasukan', 'totalPengeluaran', 'pemasukanValues', 'pengeluaranValues', 'netBalance', 'netBalance', 'months' , 'pemasukanLastYear', 'pemasukanThisYear'));
    }

    public function laporan(){
        Carbon::setLocale('id');

        $currentYear= Carbon::now()->year;
        $lastThreeMonth = Carbon::now()->subMonth(3)->month;
        $lastTwoMonths = Carbon::now()->subMonth(2)->month;
        $lastMonth = Carbon::now()->subMonth()->month;
        $currentMonth= Carbon::now()->month;

        $currentMonthName = Carbon::now()->translatedFormat('F');
        $lastMonthName = Carbon::now()->subMonth()->translatedFormat('F');
        $lastTwoMonthsName = Carbon::now()->subMonth(2)->translatedFormat('F');
        $lastThreeMonthsName = Carbon::now()->subMonth(3)->translatedFormat('F');

        $pemasukanCurrentMonth = Pemasukan::whereMonth('tanggalPembayaran', $currentMonth)->whereYear('tanggalPembayaran', $currentYear)->sum('nominal');
        $pengeluaranCurrentMonth = Pengeluaran::whereMonth('tanggalPengeluaran', $currentMonth)->whereYear('tanggalPengeluaran', $currentYear)->sum('jumlah');
        
        $pemasukanLastMonth = Pemasukan::whereMonth('tanggalPembayaran', $lastMonth)->whereYear('tanggalPembayaran', $currentYear)->sum('nominal');
        $pengeluaranLastMonth = Pengeluaran::whereMonth('tanggalPengeluaran', $lastMonth)->whereYear('tanggalPengeluaran', $currentYear)->sum('jumlah');

        $pemasukanLastTwoMonths = Pemasukan::whereMonth('tanggalPembayaran', $lastTwoMonths)->whereYear('tanggalPembayaran', $currentYear)->sum('nominal');
        $pengeluaranLastTwoMonths = Pengeluaran::whereMonth('tanggalPengeluaran', $lastTwoMonths)->whereYear('tanggalPengeluaran', $currentYear)->sum('jumlah');

        $pemasukanLastThreeMonth = Pemasukan::whereMonth('tanggalPembayaran', $lastThreeMonth)->whereYear('tanggalPembayaran', $currentYear)->sum('nominal');
        $pengeluaranLastThreeMonth = Pengeluaran::whereMonth('tanggalPengeluaran', $lastThreeMonth)->whereYear('tanggalPengeluaran', $currentYear)->sum('jumlah');

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 10);
        
        return view('laporan.index', compact('years', 'currentYear', 'currentMonthName', 'lastMonthName', 'lastTwoMonthsName', 'lastThreeMonthsName','pemasukanCurrentMonth', 'pengeluaranCurrentMonth', 'pemasukanLastMonth', 'pengeluaranLastMonth', 'pemasukanLastTwoMonths', 'pengeluaranLastTwoMonths', 'pemasukanLastThreeMonth', 'pengeluaranLastThreeMonth'));
    }

    public function print(Request $request){
        Carbon::setLocale('id');
        
        $months = [
            'Januari' => [],
            'Februari' => [],
            'Maret' => [],
            'April' => [],
            'Mei' => [],
            'Juni' => [],
            'Juli' => [],
            'Agustus' => [],
            'September' => [],
            'Oktober' => [],
            'November' => [],
            'Desember' => [],
        ];

        if($request->filterTahun){
            $period = "Tahun $request->filterTahun";
            $startDate = Carbon::parse($request->filterTahun . '-01-01');
            $endDate = Carbon::parse($request->filterTahun . '-12-31');
        }else{
            $formattedDateTanggalAwal = Carbon::parse($request->tanggalAwal)->translatedFormat('d F Y');
            $formattedDateTanggalAkhir = Carbon::parse($request->tanggalAkhir)->translatedFormat('d F Y');
            $period = "$formattedDateTanggalAwal sampai $formattedDateTanggalAkhir";
            $startDate = Carbon::parse($request->tanggalAwal);
            $endDate = Carbon::parse($request->tanggalAkhir);
        }
        $allDates = [];

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $allDates[] = $date->toDateString();
        }

        foreach ($allDates as $date) {
            $carbonDate = Carbon::parse($date);
            $monthName = $carbonDate->translatedFormat('F');

            $pemasukan = Pemasukan::whereDate('tanggalPembayaran', $date)->get();
            foreach ($pemasukan as $entry) {
                $entry->type = 'Pemasukan';
                $months[$monthName][] = $entry;
            }

            $pengeluaran = Pengeluaran::whereDate('tanggalPengeluaran', $date)->get();
            foreach ($pengeluaran as $entry) {
                $entry->type = 'Pengeluaran';
                $months[$monthName][] = $entry;
            }
        }

        $months = array_filter($months, function ($value) {
            return !empty($value);
        });

        $tanggalAwal =$request->tanggalAwal;
        $tanggalAkhir =$request->tanggalAkhir;
        
        $monthSums = [];
        $totalPemasukan = 0;
        $totalPengeluaran = 0;
        foreach ($months as $monthName => $entries) {

            $entriesCollection = collect($entries);
            $sumPemasukan = $entriesCollection->where('type', 'Pemasukan')->sum('nominal');
            $sumPengeluaran = $entriesCollection->where('type', 'Pengeluaran')->sum('jumlah');
            $totalPemasukan += $sumPemasukan;
            $totalPengeluaran += $sumPengeluaran;
            $monthSums[$monthName] = [
                'pemasukan' => $sumPemasukan,
                'pengeluaran' => $sumPengeluaran,
                'net_balance' => $sumPemasukan - $sumPengeluaran,
            ];
        }
        
        return view('laporan.print', compact('period', 'months', 'tanggalAwal', 'tanggalAkhir', 'monthSums', 'totalPemasukan', 'totalPengeluaran'));
    }
    public function printFiltered(Request $request, String $month){
        Carbon::setLocale('id');
        $period = "Bulan $month";
        $year = Carbon::now()->year;
        $months = [
            'Januari' => [],
            'Februari' => [],
            'Maret' => [],
            'April' => [],
            'Mei' => [],
            'Juni' => [],
            'Juli' => [],
            'Agustus' => [],
            'September' => [],
            'Oktober' => [],
            'November' => [],
            'Desember' => [],
        ];

        if($month){
            $bulan = [
                'Januari' => 1,
                'Februari' => 2,
                'Maret' => 3,
                'April' => 4,
                'Mei' => 5,
                'Juni' => 6,
                'Juli' => 7,
                'Agustus' => 8,
                'September' => 9,
                'Oktober' => 10,
                'November' => 11,
                'Desember' => 12
            ];
            $monthNumber = isset($bulan[$month]) ? $bulan[$month] : null;
            Carbon::setLocale('en');
            $startDate = Carbon::createFromFormat('Y-m-d', $year . '-' . $monthNumber . '-01');
            $endDate = $startDate->copy()->endOfMonth();
        }
        $allDates = [];

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $allDates[] = $date->toDateString();
        }

        foreach ($allDates as $date) {
            $carbonDate = Carbon::parse($date);
            $monthName = $carbonDate->translatedFormat('F');

            $pemasukan = Pemasukan::whereDate('tanggalPembayaran', $date)->whereYear('tanggalPembayaran', $year)->get();
            foreach ($pemasukan as $entry) {
                $entry->type = 'Pemasukan';
                $months[$monthName][] = $entry;
            }

            $pengeluaran = Pengeluaran::whereDate('tanggalPengeluaran', $date)->whereYear('tanggalPengeluaran', $year)->get();
            foreach ($pengeluaran as $entry) {
                $entry->type = 'Pengeluaran';
                $months[$monthName][] = $entry;
            }
        }

        $months = array_filter($months, function ($value) {
            return !empty($value);
        });

        $tanggalAwal =$request->tanggalAwal;
        $tanggalAkhir =$request->tanggalAkhir;
        
        $monthSums = [];
        $totalPemasukan = 0;
        $totalPengeluaran = 0;
        foreach ($months as $monthName => $entries) {

            $entriesCollection = collect($entries);
            $sumPemasukan = $entriesCollection->where('type', 'Pemasukan')->sum('nominal');
            $sumPengeluaran = $entriesCollection->where('type', 'Pengeluaran')->sum('jumlah');
            $totalPemasukan += $sumPemasukan;
            $totalPengeluaran += $sumPengeluaran;
            $monthSums[$monthName] = [
                'pemasukan' => $sumPemasukan,
                'pengeluaran' => $sumPengeluaran,
                'net_balance' => $sumPemasukan - $sumPengeluaran,
            ];
        }
        
        return view('laporan.print', compact('period', 'months', 'tanggalAwal', 'tanggalAkhir', 'monthSums', 'totalPemasukan', 'totalPengeluaran'));
    }
}
