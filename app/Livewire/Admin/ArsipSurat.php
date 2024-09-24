<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Http\Services\Repositories\ArsipSuratRepository;

class ArsipSurat extends Component
{
    public $arsip,$arsip_id,$kd_klasifikasi_id, $nomor, $tgl, $perihal, $pencipta, $unit_pengolah, $uraian, $lokal, $jenis_media, $ket_keaslian, $jumlah, $no_rak, $no_box, $retensi, $file;
    public $isopen = 0;
    protected $repo, $title;
    public function boot(ArsipSuratRepository $repo)
    {
        $this->title = 'arsip-surat';
        $this->repo = $repo;
    }
    public function render()
    {
        $title = $this->title;
        $this->arsip = $this->repo->all();
        return view('livewire.admin.arsip-surat',compact('title'));
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
        $this->kd_klasifikasi_id = '';
        $this->nomor = '';
        $this->tgl = '';
        $this->perihal = '';
        $this->pencipta = '';
        $this->unit_pengolah = '';
        $this->uraian = '';
        $this->lokal = '';
        $this->jenis_media = '';
        $this->ket_keaslian = '';
        $this->jumlah = '';
        $this->no_rak = '';
        $this->no_box = '';
        $this->retensi = '';
        $this->file = '';
    }
    public function store()
    {
        $this->validate([
            'kd_klasifikasi_id' => 'required',
            'nomor' => 'required',
            'tgl' => 'required',
            'perihal' => 'required',
            'pencipta' => 'required',
            'unit_pengolah' => 'required',
            'uraian' => 'required',
            'lokal' => 'required',
            'jenis_media' => 'required',
            'ket_keaslian' => 'required',
            'jumlah' => 'required',
            'no_rak' => 'required',
            'no_box' => 'required',
            'retensi' => 'required',
            'file' => 'required',
        ]);

        $attributes = [
            'kd_klasifikasi_id' => $this->kd_klasifikasi_id,
            'nomor' => $this->nomor,
            'tgl' => $this->tgl,
            'perihal' => $this->perihal,
            'pencipta' => $this->pencipta,
            'unit_pengolah' => $this->unit_pengolah,
            'uraian' => $this->uraian,
            'lokal' => $this->lokal,
            'jenis_media' => $this->jenis_media,
            'ket_keaslian' => $this->ket_keaslian,
            'jumlah' => $this->jumlah,
            'no_rak' => $this->no_rak,
            'no_box' => $this->no_box,
            'retensi' => $this->retensi,
            'file' => $this->file,
        ];

        if ($this->arsip_id) {
            $this->repo->update($attributes, $this->arsip_id);
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
        $this->arsip_id = $id;
        $this->kd_klasifikasi_id = $post->kd_klasifikasi_id;
        $this->nomor = $post->nomor;
        $this->tgl = $post->tgl;
        $this->perihal = $post->perihal;
        $this->pencipta = $post->pencipta;
        $this->unit_pengolah = $post->unit_pengolah;
        $this->uraian = $post->uraian;
        $this->lokal = $post->lokal;
        $this->jenis_media = $post->jenis_media;
        $this->ket_keaslian = $post->ket_keaslian;
        $this->jumlah = $post->jumlah;
        $this->no_rak = $post->no_rak;
        $this->no_box = $post->no_box;
        $this->retensi = $post->retensi;
        $this->file = $post->file;
        $this->openModal();
    }
    public function delete($id)
    {
        $this->repo->delete($id);
        session()->flash('message', 'Data berhasil di hapus.');
    }

}
