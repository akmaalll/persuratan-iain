<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Services\Repositories\PostRepository;

class PostCrud extends Component
{
    public $posts, $judul, $isi, $post_id;
    public $isOpen = 0;

    protected $postRepository;

    public function boot(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function render()
    {
        $this->posts = $this->postRepository->all();
        return view('livewire.post-crud');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->judul = '';
        $this->isi = '';
        $this->post_id = '';
    }

    public function store()
    {
        $this->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $attributes = [
            'judul' => $this->judul,
            'isi' => $this->isi
        ];

        if ($this->post_id) {
            $this->postRepository->update($attributes, $this->post_id);
            $message = 'Data Berhasil Di Update.';
        } else {
            $this->postRepository->store($attributes);
            $message = 'Data Berhasil Dibuat.';
        }

        session()->flash('message', $message);

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        $this->post_id = $id;
        $this->judul = $post->judul;
        $this->isi = $post->isi;

        $this->openModal();
    }

    public function delete($id)
    {
        $this->postRepository->delete($id);
        session()->flash('message', 'Data berhasil di hapus.');
    }
}