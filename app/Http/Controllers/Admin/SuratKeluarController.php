<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SuratKeluarExport;
use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\ArsipSuratContract;
use App\Http\Services\Repositories\Contracts\NoSuratContract;
use App\Http\Services\Repositories\Contracts\SuratKeluarContract;
use App\Models\NoSurat;
use App\Traits\Uploadable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use File;

class SuratKeluarController extends Controller
{
    use Uploadable;
    protected $title, $repo, $response, $arsip, $noSurat;
    protected $file_path = "uploads/surat-keluar";

    public function __construct(SuratKeluarContract $repo, ArsipSuratContract $arsip, NoSuratContract $noSurat)
    {
        $this->title = 'surat-keluar';
        $this->repo = $repo;
        $this->arsip = $arsip;
        $this->noSurat = $noSurat;
    }

    public function index()
    {
        try {
            $title = $this->title;
            //session()->forget('status_arsip');
            return view('admin.' . $title . '.index', compact('title'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function data(Request $request)
    {
        try {
            $title = $this->title;
            $data = is_array($request->search) ? $this->repo->filter($request->all()) : $this->repo->paginated($request->all());
            // $data = $this->repo->paginated($request->all());
            $perPage = $request->per_page == '' ? 5 : $request->per_page;
            $view = view('admin.' . $title . '.data', compact('data', 'title'))->with('i', ($request->input('page', 1) -
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

    public function create()
    {
        try {
            $title = $this->title;
            $tahun = Carbon::now();
            return view('admin.' . $title . '.form', compact('title', 'tahun'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }


    public function store(Request $request)
    {
        try {
            $req = $request->all();
            if ($request->hasFile('file')) {
                $file = $request->file('file')->getClientOriginalName();
                $file_name = pathinfo($file, PATHINFO_FILENAME);
                $file_name = $this->uploadFile2($request->file('file'), $this->file_path, '');
                $req['file'] = $file_name;
            }


            $req['created_by'] = Auth::user()->id;
            $data = $this->repo->store($req);
            return response()->json(['data' => $data, 'success' => true]);
        } catch (\Exception $e) {
            dd($e);
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $title = $this->title;
            $tahun = Carbon::now();
            $data = $this->repo->find($id);
            return view('admin.' . $title . '.form', compact('title', 'data', 'tahun'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $req = $request->all();
            if ($request->hasFile('file')) {
                $file = $request->file('file')->getClientOriginalName();
                $file_name = pathinfo($file, PATHINFO_FILENAME);
                $file_name = $this->uploadFile2($request->file('file'), $this->file_path, $req['file_old']);
                $req['file'] = $file_name;
            } else {
                $req['file'] = $req['file_old'];
            }


            $req['updated_by'] = Auth::user()->id;
            $data = $this->repo->update($req, $id);
            return response()->json(['data' => $data, 'success' => true]);
        } catch (\Exception $e) {
            dd($e);
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $data = $this->repo->delete($id);
            return response()->json($data);
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function getLastNumber(Request $request)
    {
        try {
            $criteria = [
                'kd_klasifikasi' => $request->input('kd_klasifikasi'),
                'status' => $request->input('status'),
                'asal' => $request->input('asal'),
            ];

            $lastNumber = $this->repo->getLastNumber($criteria);

            return response()->json(['last_number' => $lastNumber]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function detail($id)
    {
        try {
            $title = $this->title;
            $data = $this->repo->find($id);
            return view('admin.' . $title . '.detail', compact('title', 'data'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function export(Request $request)
    {
        try {
            $search = $request->has('search') ? json_decode($request->search, true) : null;

            $data = is_array($search) ? $this->repo->filter(['search' => $search]) : $this->repo->all();
            $header = "Surat Keluar Persuratan IAIN Parepare";
            $fileName = 'Export-Surat-Keluar-' . date('d-m-Y') . '.xlsx';

            return Excel::download(new SuratKeluarExport($data, $header), $fileName);
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function cetakPdf(Request $request)
    {
        try {
            // Mendapatkan data
            $title = $this->title;
            $data = is_array($request->search) ? $this->repo->filter($request->all()) : $this->repo->all();
            $header = "Surat Keluar Persuratan IAIN Parepare";

            // Membuat file PDF
            $pdf = Pdf::loadView('admin.' . $title . '.pdf', compact('header', 'data'));
            $pdf->setPaper('A4', 'landscape');

            // Nama dan path file
            $fileName = 'Cetak-Surat Masuk-' . date('d-m-Y') . '.pdf';
            $filePath = storage_path("app/public/{$fileName}");

            // Menyimpan file PDF ke storage
            $pdf->save($filePath);

            // Mengembalikan URL file PDF
            return response()->json([
                'pdf_url' => asset("storage/{$fileName}") // Pastikan file dapat diakses dari public path
            ]);
        } catch (\Exception $e) {
            // Menangani error jika ada
            return response()->json([
                'error' => 'Terjadi kesalahan saat membuat PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeArsip($id)
    {
        try {
            $title = $this->title;
            // dd($data);
            $data = $this->repo->find($id);
            $req = array(
                'kd_klasifikasi_id'    => $data->kd_klasifikasi_id,
                'tgl'                        => $data->tgl_surat,
                'nomor'                    => $data->nomor,
                'perihal'                => $data->perihal,
                'status'                    => $data->status,
                'pencipta'                => $data->asal,
                'unit_pengolah'        => $data->asal,
                'tgl_kirim'                => $data->tgl_kirim,
                'tgl_input'                => $data->tgl_input,
                'ttd'                        => $data->ttd,
                'tujuan'                    => $data->tujuan,
                'kepada'                    => $data->kepada,
                'jenis'                    => $data->jenis,
                'retensi'                => $data->retensi,
                'retensi2'                => $data->retensi2,
                'retensi3'                => $data->retensi3,
                'file'                    => $data->file,
                'uraian'                    => $data->uraian,
                'created_by'            => $data->created_by,
                'jenis_media'            => '-',
                'lokal'                    => '-',
                'ket_keaslian'            => '-',
                'jumlah'                    => '0',
                'no_rak'                    => '-',
                'no_box'                    => '-',
            );

            //$req['updated_by'] = Auth::user()->id;

            if (!File::exists(public_path('uploads/surat-keluar/' . $data->file))) {
                return dd('file tidak ada');
            }
            $copy = File::copy(public_path('uploads/surat-keluar/' . $data->file), public_path('uploads/arsip/' . $data->file));
            try {
                $update_data = $this->repo->update(['status_arsip' => 'arsip', 'updated_by' => Auth::user()->id], $id);
                $store = $this->arsip->store($req);
            } catch (\Exception $e) {
                dd($e);
            }
            //Session::put('status_arsip', true);
            return redirect()->route('surat-keluar.index', ['status_arsip' => true]);
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function getNoSuratData(Request $request)
    {
        try {
            $request->validate([
                'nomor' => 'required|string',
            ]);

            $noSurat = $this->noSurat->findByNomor($request->nomor);
            // dd($noSurat);

            if ($noSurat) {
                return response()->json([
                    'success' => true,
                    'data' => $noSurat,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Nomor Surat tidak ditemukan.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }
}
