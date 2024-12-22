<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SuratMasukExport;
use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\SuratMasukContract;
use App\Http\Services\Repositories\Contracts\ArsipSuratContract;
use App\Traits\Uploadable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use File;

class SuratMasukController extends Controller
{
    use Uploadable;
    protected $title, $repo, $response, $arsip;
    protected $image_path = "uploads/ttd/surat-masuk";


    public function __construct(SuratMasukContract $repo, ArsipSuratContract  $arsip)
    {
        $this->title = 'surat-masuk';
        $this->repo = $repo;
		  $this->arsip = $arsip;
    }

    public function index()
    {
        try {
            $title = $this->title;
            return view('admin.' . $title . '.index', compact('title'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function data(Request $request)
    {
        try {
            $title = $this->title;
            // $data = $this->repo->paginated($request->all());
            $data = is_array($request->search) ? $this->repo->filter($request->all()) : $this->repo->paginated($request->all());
            // dd($request->all());
            $perPage = $request->per_page == '' ? 5 : $request->per_page;
            // dd($data);
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

	
            if ($request->hasFile('upload_file')) {
                $image = $request->file('upload_file')->getClientOriginalName();
                $image_name = pathinfo($image, PATHINFO_FILENAME);
                $image_name = $this->uploadFile2($request->file('upload_file'), $this->image_path, '');
                $req['upload_file'] = $image_name;
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
            $data = $this->repo->find($id);
            $tahun = Carbon::now();
            // dd($data->tujuan);
            return view('admin.' . $title . '.form', compact('title', 'data', 'tahun'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $req = $request->all();


            if ($request->hasFile('upload_file')) {
                $image = $request->file('upload_file');
                $imageName = pathinfo($image, PATHINFO_FILENAME);
                $imageName = $this->uploadFile2($image, $this->image_path, $req['upload_file_old']);
                $req['upload_file'] = $imageName;
            } else {
                $req['upload_file'] = $req['upload_file_old'];
            }
            $req['updated_by'] = Auth::user()->id;
            $data = $this->repo->update($req, $id);
				//dd($data);

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
            $header = "Surat Masuk Persuratan IAIN Parepare";
            $fileName = 'Export-Surat-Masuk-' . date('d-m-Y') . '.xlsx';

            return Excel::download(new SuratMasukExport($data, $header), $fileName);
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
            $header = "Surat Masuk Persuratan IAIN Parepare";

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
				$data = $this->repo->find($id);
				//dd($data);
				$req = array(
					'kd_klasifikasi_id'	=> $data->kd_klasifikasi_id ?? '0',
					'tgl'						=> $data->tgl_surat,
					'nomor'					=> $data->nomor,
					'perihal'				=> $data->perihal,
					'status'					=> $data->status,
					'pencipta'				=> $data->asal,
					'unit_pengolah'		=> $data->asal,
					'tgl_terima'			=> $data->tgl_terima,
					'tgl_input'				=> $data->tgl_input,
					'ttd'						=> $data->ttd,
					'tujuan'					=> $data->tujuan,
					'kepada'					=> $data->kepada,
					'jenis'					=> $data->jenis,
					'retensi'				=> $data->retensi,
					'retensi2'				=> $data->retensi2,
					'retensi3'				=> $data->retensi3,
					'file'					=> $data->upload_file,
					'uraian'					=> $data->uraian,
					'created_by'			=> $data->created_by,
					'jenis_media'			=> '-',
					'lokal'					=> '-',
					'ket_keaslian'			=> '-',
					'jumlah'					=> '0',
					'no_rak'					=> '-',
					'no_box'					=> '-',
				);

				//$req['updated_by'] = Auth::user()->id;

				if (!File::exists(public_path('uploads/ttd/surat-masuk/'.$data->upload_file))) {
					return dd('file tidak ada');
				}
				$copy = File::copy(public_path('uploads/ttd/surat-masuk/' . $data->upload_file), public_path('uploads/arsip/' . $data->upload_file));
				try {
					$update_data = $this->repo->update(['status_arsip' => 'arsip', 'updated_by' => Auth::user()->id], $id);
					$store = $this->arsip->store($req);
				}
				catch(\Exception $e) {
					dd($e);
				}
				//Session::put('status_arsip', true);
				return redirect()->route('surat-masuk.index', ['status_arsip' => true]);
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }

    }

    public function getNoSuratData(Request $request)
    {
        try {
            $request->validate([
                'nomor' => 'required|string',
                'jenis_nosurat' => 'required|string',
            ]);

            $noSurat = $this->repo->findByNomor($request->nomor);

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
