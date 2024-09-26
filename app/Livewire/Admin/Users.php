<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Http\Services\Repositories\UsersRepository;

class Users extends Component
{
    public $user,$user_id,$name,$username,$email,$password,$id_role;
    public $isopen = 0;
    protected $title, $repo;
    public function boot(UsersRepository $repo)
    {
        $this->title = 'users';
        $this->repo = $repo;
    }
    public function render()
    {
        $title = $this->title;
        $this->user = $this->repo->all();
        return view('livewire.admin.users',compact('title'));
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
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->id_role = '';
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'id_role' => 'required',
        ]);

        $attributes = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'id_role' => $this->id_role,
        ];

        if ($this->user_id) {
            $this->repo->update($attributes, $this->user_id);
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
        $this->user_id = $id;
        $this->name = $post->name;
        $this->username = $post->username;
        $this->email = $post->email;
        $this->password = $post->password;
        $this->id_role = $post->id_role;
        

        $this->openModal();
    }
    public function delete($id)
    {
        $this->repo->delete($id);
        session()->flash('message', 'Data berhasil di hapus.');
    }
}
