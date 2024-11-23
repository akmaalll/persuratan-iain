<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\SuratKeluarContract;
use App\Traits\Uploadable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratKeluarController extends Controller
{
    use Uploadable;
    protected $title, $repo, $response;
    protected $file_path = "uploads/surat-keluar";

    public function __construct(SuratKeluarContract $repo)
    {
        $this->title = 'surat-keluar';
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

            if ($req['asal'] == '20') {
                $req['asal'] = $req['asalLain'];
            }

            if ($req['tujuan'] == '20') {
                $req['tujuan'] = $req['tujuanLain'];
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

            if ($req['asal'] == '20') {
                $req['asal'] = $req['asalLain'];
            }
            if ($req['tujuan'] == '20') {
                $req['tujuan'] = $req['tujuanLain'];
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
}
