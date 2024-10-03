<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\ArsipSuratContract;
use App\Traits\Uploadable;
use Illuminate\Http\Request;

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
        // dd($request->all());
        try {
            $req = $request->all();
            $files_old = "";
            if ($request->hasFile('file')) {
                $files = $request->file('file')->getClientOriginalName();
                $files_name = pathinfo($files, PATHINFO_FILENAME);
                $files_name = $this->uploadFile2($request->file('file'), $this->files_path, $files_old);
                $req['file'] = $files_name;
            }
            $data = $this->repo->store($req);
            return response()->json(['data' => $data, 'success' => true]);
        } catch (\Exception $e) {
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

    public function update(Request $request)
    {
        try {
            $req = $request->all();
            // dd($req);
            $data = $this->repo->find($req['id']);
            
            if ($request->hasFile('file')) {
                $files = $request->file('file')->getClientOriginalName();
                $files_name = pathinfo($files, PATHINFO_FILENAME);
                $files_name = $this->uploadFile2($request->file('file'), $this->files_path, $data->files);
                $req['file'] = $files_name;
            } else {
                $req['file'] = $req['files_old'];
            }
            $data = $this->repo->update($req, $request->id);
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
}
