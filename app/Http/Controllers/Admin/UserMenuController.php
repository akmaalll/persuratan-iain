<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\MenuContract;
use App\Http\Services\Repositories\Contracts\RoleContract;
use App\Http\Services\Repositories\Contracts\UserMenuContract;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserMenuController extends Controller
{
    protected $title, $repo, $role, $menu, $response;

    public function __construct(UserMenuContract $repo, RoleContract $role, MenuContract $menu)
    {
        $this->title = 'user-menus';
        $this->repo = $repo;
        $this->role = $role;
        $this->menu = $menu;
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
            $data = $this->role->paginated($request->all());
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


    public function create($id)
    {
        try {
            $status = "create";
            $title = $this->title;
            return view('admin.' . $title . '.form', compact('title', 'id', 'status'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->status == 'edit') {
                $this->repo->deleteByRole($request->id_role);
            }
            $menus = $this->menu->all();
            foreach ($menus as $m) {
                $read = 'read' . $m->id;
                $create = 'create' . $m->id;
                $edit = 'edit' . $m->id;
                $delete = 'delete' . $m->id;
                $report = 'report' . $m->id;

                $req['id'] = (string) Str::uuid();
                $req['id_role'] = $request->id_role;
                $req['id_menu'] = $m->id;
                $req['read'] = isset($request->$read) ? '1' : '0';
                $req['create'] = isset($request->$create) ? '1' : '0';
                $req['edit'] = isset($request->$edit) ? '1' : '0';
                $req['delete'] = isset($request->$delete) ? '1' : '0';
                $req['report'] = isset($request->$report) ? '1' : '0';
                $data = $this->repo->store($req);
            }
            return response()->json(['data' => $data, 'success' => true]);
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $role = $this->role->find($id);
            $menu = $this->repo->findByRole($id);
            $r = json_encode($role);
            $m = json_encode($menu);
            return response()->json(['role' => $r, 'usermenu' => $m, 'id' => $id]);
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $status = "edit";
            $title = $this->title;
            return view('admin.' . $title . '.form', compact('title', 'id', 'status'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $data = $this->repo->deleteByRole($id);
            return response()->json($data);
        } catch (\Exception $e) {
            $message = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return response()->json($message);
        }
    }
}
