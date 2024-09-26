<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Http\Services\Repositories\RoleRepository;

class Role extends Component
{
    public $role,$role_id,$code,$name;
    public $isopen = 0;
    protected $title, $repo;
    public function boot(RoleRepository $repo)
    {
        $this->title = 'roles';
        $this->repo = $repo;
    }
    public function render()
    {
        $title = $this->title;
        $this->role = $this->repo->all();
        return view('livewire.admin.role',compact('title'));
    }
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
    public function openModal()
    {
        $this->isopen = true;
    }
    public function closeModal()
    {
        $this->isopen = false;
    }
    private function resetInputFields()
    {
        $this->code = '';
        $this->name = '';
    }
    public function store()
    {
        $this->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        $attributes = [
            'code' => $this->code,
            'name' => $this->name,
        ];

        if ($this->role_id) {
            $this->repo->update($attributes, $this->role_id);
            $message = 'Data Berhasil Di Update.';
        } else {
            $this->repo->store($attributes);
            $message = 'Data Berhasil Di Buat.';
        }

        session()->flash('message', $message);

        $this->closeModal();
        $this->resetInputFields();
    }
    public function edit($id)
    {
        $post = $this->repo->find($id);
        $this->role_id = $id;
        $this->code = $post->code;
        $this->name = $post->name;

        $this->openModal();
    }
    public function delete($id)
    {
        $this->repo->delete($id);
        session()->flash('message', 'Data berhasil di hapus.');
    }

}
