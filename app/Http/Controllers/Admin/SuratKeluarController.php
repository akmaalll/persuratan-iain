<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\SuratKeluarContract;
use App\Traits\Uploadable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratKeluarController extends Controller
{
    use Uploadable;
    protected $title, $repo, $response;
    protected $image_path = "uploads/ttd/surat-keluar";

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
            $data = $this->repo->paginated($request->all());
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
            return view('admin.' . $title . '.form', compact('title'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }


    public function store(Request $request)
    {
        try {
            $req = $request->all();
            if ($request->hasFile('ttd')) {
                $image = $request->file('ttd')->getClientOriginalName();
                $image_name = pathinfo($image, PATHINFO_FILENAME);
                $image_name = $this->uploadFile2($request->file('ttd'), $this->image_path, '');
                $req['ttd'] = $image_name;
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
            return view('admin.' . $title . '.form', compact('title', 'data'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $req = $request->all();

            if ($request->hasFile('ttd')) {
                $image = $request->file('ttd')->getClientOriginalName();
                $image_name = pathinfo($image, PATHINFO_FILENAME);
                $image_name = $this->uploadFile2($request->file('ttd'), $this->image_path, $req['ttd_old']);
                $req['ttd'] = $image_name;
            } else {
                $req['ttd'] = $req['ttd_old'];
            }
            $req['updated_by'] = Auth::user()->id;
            $data = $this->repo->update($req, $id);
            return response()->json(['data' => $data, 'success' => true]);
        } catch (\Exception $e) {
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
}
