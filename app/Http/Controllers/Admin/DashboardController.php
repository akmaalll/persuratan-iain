<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArsipSurat;
use App\Models\surat_keluar;
use App\Models\surat_masuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $indikator, $rk;

    // public function __construct(IndikatorKinerjaContract $indikator, RencanaHasilKerjaContract $rk)
    // {
    //     $this->indikator = $indikator;
    //     $this->rk = $rk;
    // }

    public function index()
    {
        try {
            $data = array(
                'countMasuk' => surat_masuk::get()->count(),
                'countKeluar' => surat_keluar::get()->count(),
                'countArsip' => ArsipSurat::get()->count(),
            );
            return view('admin.dashboard', compact('data'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function getIndikatorKinerja($id)
    {
        $data = $this->indikator->getByIdRencana($id);
        return response()->json($data);
    }

    public function home()
    {
        try {
            return view('app.welcome');
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }
    public function data(Request $request)
    {
        try {
            $data = $this->rk->paginated($request->all());
            // dd($data);
            $perPage = $request->per_page == '' ? 5 : $request->per_page;
            $view = view('app.data', compact('data'))->with('i', ($request->input('page', 1) -
                1) * $perPage)->render();
            return response()->json([
                "total_page" => $data->lastpage(),
                "total_data" => $data->total(),
                "html"       => $view,
            ]);
        } catch (\Exception $e) {
            dd($e);
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }
}
