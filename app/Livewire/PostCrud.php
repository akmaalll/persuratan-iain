<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostCrud extends Component
{
    public $posts, $judul, $isi, $post_id;
    public $isOpen = 0;

    public function render()
    {
        $this->posts = Post::all();
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

        Post::updateOrCreate(['id' => $this->post_id], [
            'judul' => $this->judul,
            'isi' => $this->isi
        ]);

        session()->flash(
            'message',
            $this->post_id ? 'Data Berhasil Di Update.' : 'Data Berhasil Dibuat.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->judul = $post->judul;
        $this->isi = $post->isi;

        $this->openModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Data berhasil di hapus.');
    }
}
