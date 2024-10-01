<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Http\Services\Repositories\SuratKeluarRepository;

class SuratKeluar extends Component
{
    public $suratkeluar, $title, $sk_id, $kd_klasifikasi_id, $tgl_surat, $nomor, $perihal, $status, $asal, $tgl_kirim, $tgl_input, $ttd, $tujuan, $kepada, $jenis, $retensi;
    public $isopen = 0;
    protected $repo;
    public function boot(SuratKeluarRepository $repo)
    {
        $this->title = 'surat-keluar';
        $this->repo = $repo;
    }
    public function render()
    {
        $title=$this->title;
        $this->suratkeluar = $this->repo->all();
        return view('livewire.admin.surat-keluar.index', compact('title'));
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
        $this->tgl_surat = '';
        $this->nomor = '';
        $this->perihal = '';
        $this->status = '';
        $this->asal = '';
        $this->tgl_kirim = '';
        $this->tgl_input = '';
        $this->ttd = '';
        $this->tujuan = '';
        $this->kepada = '';
        $this->jenis = '';
        $this->retensi = '';
        $this->sk_id = '';
    }
    public function store()
    {
        $this->validate([
            'kd_klasifikasi_id' => 'required',
            'tgl_surat' => 'required',
            'nomor' => 'required',
            'perihal' => 'required',
            'status' => 'required',
            'asal' => 'required',
            'tgl_kirim' => 'required',
            'tgl_input' => 'required',
            'ttd' => 'required',
            'tujuan' => 'required',
            'kepada' => 'required',
            'jenis' => 'required',
            'retensi' => 'required',
        ]);

        $attributes = [
            'kd_klasifikasi_id' => $this->kd_klasifikasi_id,
            'tgl_surat' => $this->tgl_surat,
            'nomor' => $this->nomor,
            'perihal' => $this->perihal,
            'status' => $this->status,
            'asal' => $this->asal,
            'tgl_kirim' => $this->tgl_kirim,
            'tgl_input' => $this->tgl_input,
            'ttd' => $this->ttd,
            'tujuan' => $this->tujuan,
            'kepada' => $this->kepada,
            'jenis' => $this->jenis,
            'retensi' => $this->retensi,
        ];

        if ($this->sk_id) {
            $this->repo->update($attributes, $this->sk_id);
            $message = 'Data Berhasil Di Update.';
        } else {
            $this->repo->store($attributes);
            $message = 'Data Berhasil Di Buat.';
        }

        session()->flash('message', $message);

        $this->closeModal();
        $this->resetInputFields();
        // dd(
        //     $this->kd_klasifikasi_id,
        //     $this->tgl_surat,
        //     $this->nomor,
        //     $this->perihal,
        //     $this->status,
        //     $this->asal,
        //     $this->tgl_kirim,
        //     $this->tgl_input,
        //     $this->ttd,
        //     $this->tujuan,
        //     $this->kepada,
        //     $this->jenis,
        //     $this->retensi,
        // );
    }
    public function edit($id)
    {
        $post = $this->repo->find($id);
        $this->sk_id = $id;
        $this->kd_klasifikasi_id=$post->kd_klasifikasi_id;
        $this->tgl_surat = $post->tgl_surat;
        $this->nomor = $post->nomor;
        $this->perihal = $post->perihal;
        $this->status = $post->status;
        $this->asal = $post->asal;
        $this->tgl_kirim = $post->tgl_kirim;
        $this->tgl_input = $post->tgl_input;
        $this->ttd = $post->ttd;
        $this->tujuan = $post->tujuan;
        $this->kepada = $post->kepada;
        $this->jenis = $post->jenis;
        $this->retensi = $post->retensi;

        $this->openModal();
    }
    public function delete($id)
    {
        $this->repo->delete($id);
        session()->flash('message', 'Data berhasil di hapus.');
    }
}
