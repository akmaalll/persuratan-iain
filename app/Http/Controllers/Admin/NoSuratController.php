<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\NoSuratContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoSuratController extends Controller
{
    protected $title, $repo, $response;

    public function __construct(NoSuratContract $repo)
    {
        $this->title = 'no-surat';
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
            // dd($data);
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

    public function create(Request $request)
    {
        try {
            $title = $this->title;
            $formTitle = $request->input('type') == "sisip" ? "Tambah Nomor Sisipan" : 'Tambah Nomor';
            return view('admin.' . $title . '.form', compact('title', 'formTitle'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $req = $request->all();

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

    public function getLastNumber(Request $request)
    {
        try {
            // $criteria = [
            //     'kd_klasifikasi' => $request->input('kd_klasifikasi'),
            //     'status' => $request->input('status'),
            //     'asal' => $request->input('asal'),
            // ];

            // $lastNumber = $this->repo->getLastNumber($criteria);
            $jenis = $request->input('jenis');
            $lastNumber = DB::table('no_surats')
                ->where('jenis', $jenis)
                ->orderBy('created_at', 'desc')
                ->value('nomor');

            // Jika tidak ada nomor, mulai dari 001
            $nextNumber = $lastNumber ? intval($lastNumber) + 1 : 1;

            // Format menjadi 3 digit (001, 002, dst.)
            $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            return response()->json(['last_number' => $formattedNumber]);
            // return response()->json(['last_number' => $lastNumber]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
