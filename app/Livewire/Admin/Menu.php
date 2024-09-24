<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Http\Services\Repositories\MenuRepository;

class Menu extends Component
{
    public $menu,$m_id,$parent,$name,$icon,$url,$index,$sort,$active,$main_menu,$sub_parent;
    public $isopen = 0;
    protected $title, $repo;
    public function boot(MenuRepository $repo)
    {
        $this->title = 'menus';
        $this->repo = $repo;
    }
    public function render()
    {
        $title=$this->title;
        $this->menu=$this->repo->all();
        return view('livewire.admin.menu',compact('title'));
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
        $this->parent = '';
        $this->name = '';
        $this->icon = '';
        $this->url = '';
        $this->index = '';
        $this->sort = '';
        $this->active = '';
        $this->main_menu = '';
        $this->sub_parent = '';
    }
    public function store()
    {
        $this->validate([
            'parent' => 'required',
            'name' => 'required',
            'icon' => 'required',
            'url' => 'required',
            'index' => 'required',
            'sort' => 'required',
            'active' => 'required',
            'main_menu' => 'required',
            'sub_parent' => 'required',
        ]);

        $attributes = [
            'parent' => $this->parent,
            'name' => $this->name,
            'icon' => $this->icon,
            'url' => $this->url,
            'index' => $this->index,
            'sort' => $this->sort,
            'active' => $this->active,
            'main_menu' => $this->main_menu,
            'sub_parent' => $this->sub_parent,
        ];

        if ($this->m_id) {
            $this->repo->update($attributes, $this->m_id);
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
        $this->m_id = $id;
        $this->parent = $post->parent;
        $this->name = $post->name;
        $this->icon = $post->icon;
        $this->url = $post->url;
        $this->index = $post->index;
        $this->sort = $post->sort;
        $this->active = $post->active;
        $this->main_menu = $post->main_menu;
        $this->sub_parent = $post->sub_parent;

        $this->openModal();
    }
    public function delete($id)
    {
        $this->repo->delete($id);
        session()->flash('message', 'Data berhasil di hapus.');
    }

}
