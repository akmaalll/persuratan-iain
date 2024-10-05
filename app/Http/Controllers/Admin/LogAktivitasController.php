<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\LogAktivitasContract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    protected $title, $repo, $response;

    public function __construct(LogAktivitasContract $repo)
    {
        $this->title = 'log-aktivitas';
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
            $data = $this->repo->allDesc();
            $view = view('admin.' . $title . '.data', compact('data', 'title'))->render();
            return response()->json([
                "html"       => $view,
            ]);
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }
}
