<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ArsipExport;
use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\ArsipSuratContract;
use App\Traits\Uploadable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ArsipSuratController extends Controller
{
    use Uploadable;
    protected $title, $repo, $response;
    protected $files_path = "uploads/arsip";

    public function __construct(ArsipSuratContract $repo)
    {
        $this->title = 'arsip';
        $this->repo = $repo;
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
            $data = is_array($request->search) ? $this->repo->filter($request->all()) : $this->repo->paginated($request->all());
            $perPage = $request->per_page == '' ? 5 : $request->per_page;
            $view = view('admin.' . $title . '.data', compact('data', 'title'))->with('i', ($request->input('page', 1) -
                1) * $perPage)->render();
            return response()->json([
                "total_page" => $data->lastpage(),
                "total_data" => $data->total(),
                "html"       => $view,
            ]);
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function dataDashboard(Request $request)
    {
        try {
            $title = $this->title;
            $data = is_array($request->search) ? $this->repo->filter($request->all()) : $this->repo->paginated($request->all());
            $perPage = $request->per_page == '' ? 5 : $request->per_page;
            $view = view('admin.dataArsip', compact('data', 'title'))->with('i', ($request->input('page', 1) -
                1) * $perPage)->render();
            return response()->json([
                "total_page" => $data->lastpage(),
                "total_data" => $data->total(),
                "html"       => $view,
            ]);
        } catch (\Exception $e) {
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
        // dd($request->all());
        try {
            $req = $request->all();

            // handle upload file
            $files_old = "";
            if ($request->hasFile('file')) {
                $files = $request->file('file')->getClientOriginalName();
                $files_name = pathinfo($files, PATHINFO_FILENAME);
                $files_name = $this->uploadFile2($request->file('file'), $this->files_path, $files_old);
                $req['file'] = $files_name;
            }

            // handle pencipta option
            if ($req['pencipta'] == '20') {
                $req['pencipta'] = $req['penciptaLain'];
            }
            if ($req['unit_pengolah'] == '20') {
                $req['unit_pengolah'] = $req['unitLain'];
            }
            if ($req['lokal'] == '20') {
                $req['lokal'] = $req['lokalLain'];
            }
            if ($req['jenis_media'] == '20') {
                $req['jenis_media'] = $req['mediaLain'];
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
            return view('admin.' . $title . '.form', compact('title', 'data', 'tahun'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $req = $request->all();
            // dd($req);
            $data = $this->repo->find($req['id']);

            // handle pencipta option jika "Lainnya"
            if ($req['pencipta'] == '20') {
                $req['pencipta'] = $req['penciptaLain'];
            }
            if ($req['unit_pengolah'] == '20') {
                $req['unit_pengolah'] = $req['unitLain'];
            }
            if ($req['lokal'] == '20') {
                $req['lokal'] = $req['lokalLain'];
            }
            if ($req['jenis_media'] == '20') {
                $req['jenis_media'] = $req['mediaLain'];
            }

            if ($request->hasFile('file')) {
                $files = $request->file('file')->getClientOriginalName();
                $files_name = pathinfo($files, PATHINFO_FILENAME);
                $files_name = $this->uploadFile2($request->file('file'), $this->files_path, $data->files);
                $req['file'] = $files_name;
            } else {
                $req['file'] = $req['files_old'];
            }

            $req['updated_by'] = Auth::user()->id;
            $data = $this->repo->update($req, $request->id);
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

    public function filter(Request $request)
    {
        try {
            $data = $this->repo->filter($request->all());
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

    public function cetakPdf(Request $request)
    {
        try {
            $title = $this->title;
            $data = is_array($request->search) ? $this->repo->filter($request->all()) : $this->repo->all();
            $perPage = $request->per_page == '' ? 5 : $request->per_page;

            $header = "Kearsipan Persuratan IAIN Parepare";
            $pdf = Pdf::loadView('admin.' . $title . '.pdf', compact('header', 'data'))
                ->setPaper('A4', 'landscape');

            $fileName = 'Cetak-Kearsipan-' . date('d-m-Y') . '.pdf';
            $filePath = storage_path("app/public/{$fileName}");
            $pdf->save($filePath);

            return response()->json([
                'pdf_url' => asset("storage/{$fileName}")
            ]);

        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function export(Request $request)
    {
        try {
            $search = $request->has('search') ? json_decode($request->search, true) : null;

            $data = is_array($search) ? $this->repo->filter(['search' => $search]) : $this->repo->all();
            $header = "Kearsipan Persuratan IAIN Parepare";
            $fileName = 'Export-Kearsipan-' . date('d-m-Y') . '.xlsx';

            return Excel::download(new ArsipExport($data, $header), $fileName);

        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }
}
