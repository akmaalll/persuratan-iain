<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\CariArsipContract;
use App\Models\ArsipSurat;
use App\Models\surat_keluar;
use App\Models\surat_masuk;

class CariArsipRepository extends BaseRepository implements CariArsipContract
{
	/**
	 * @var
	 */
	protected $model, $suratMasuk, $suratKeluar;

	public function __construct(ArsipSurat $model, surat_masuk $suratMasuk, surat_keluar $suratKeluar)
	{
		$this->model = $model;
		$this->suratKeluar = $suratKeluar;
		$this->suratMasuk = $suratMasuk;
	}

	public function paginated(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'desc';
		$search = $criteria['search'] ?? '';

		// $type = $criteria['type_surat'] ?? 'Arsip';

		// if ($type === 'Surat Masuk') {
		// 	$filter = $this->suratMasuk;
		// } elseif ($type === 'Surat Keluar') {
		// 	$filter = $this->suratKeluar;
		// } else {
		// 	$filter = $this->model;
		// }


		return $this->model->when($search, function ($query) use ($search) {
			$query->where(function ($q) use ($search) {
				$q->where('nomor', 'like', "%" . $search . "%")
					->orWhere('jumlah', 'like', "%" . $search . "%")
					->orWhere('uraian', 'like', "%" . $search . "%")
					->orWhere('lokal', 'like', "%" . $search . "%")
					->orWhere('pencipta', 'like', "%" . $search . "%")
					->orWhere('retensi', 'like', "%" . $search . "%")
					->orWhere('retensi2', 'like', "%" . $search . "%")
					->orWhere('retensi3', 'like', "%" . $search . "%")
					->orWhere('unit_pengolah', 'like', "%" . $search . "%")
					->orWhere('media', 'like', "%" . $search . "%")
					->orWhere('tgl', 'like', "%" . $search . "%")
					->orWhere('ket', 'like', "%" . $search . "%")
					->orWhere('perihal', 'like', "%" . $search . "%")
					->orWhere('no_rak', 'like', "%" . $search . "%")
					->orWhere('no_box', 'like', "%" . $search . "%")
					->orWhere('upload', 'like', "%" . $search . "%");
			});
		})
			->orderBy($field, $sortOrder)
			->paginate($perPage);
	}

	public function paginate($criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'desc';
		return $this->model->orderBy($field, $sortOrder)->paginate($perPage);
	}

	public function filter(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'desc';

		$type = $criteria['search']['type_surat'] ?? 'Arsip';

		if ($type === 'Surat Masuk') {
			$filter = $this->suratMasuk;
		} elseif ($type === 'Surat Keluar') {
			$filter = $this->suratKeluar;
		} else if ($type == 'Arsip') {
			$filter = $this->model;
		} else {
			$filter = '';
		}
		// Proses filtering
		$kd_klasifikasi_id = $criteria['search']['kd_klasifikasi_id'] ?? '';
		$nomor = $criteria['search']['nomor'] ?? '';
		$jumlah = $criteria['search']['jumlah'] ?? '';
		$uraian = $criteria['search']['uraian'] ?? '';
		$lokal = $criteria['search']['lokal'] ?? '';
		$pencipta = $criteria['search']['pencipta'] ?? '';
		$retensi = $criteria['search']['retensi'] ?? '';
		$retensi2 = $criteria['search']['retensi2'] ?? '';
		$retensi3 = $criteria['search']['retensi3'] ?? '';
		$unit_pengolah = $criteria['search']['unit_pengolah'] ?? '';
		$media = $criteria['search']['media'] ?? '';
		$tgl = $criteria['search']['tgl'] ?? '';
		$ket = $criteria['search']['ket'] ?? '';
		$perihal = $criteria['search']['perihal'] ?? '';
		$no_rak = $criteria['search']['no_rak'] ?? '';
		$no_box = $criteria['search']['no_box'] ?? '';
		$upload = $criteria['search']['upload'] ?? '';
		$dari_tanggal = $criteria['search']['dari_tanggal'] ?? '';
		$sampai_tanggal = $criteria['search']['sampai_tanggal'] ?? '';

		// Terapkan filter
		if (!empty($kd_klasifikasi_id)) {
			$filter = $filter->where('kd_klasifikasi_id', '=', $kd_klasifikasi_id);
		}

		if (!empty($ket)) {
			$filter = $filter->where('ket_keaslian', '=', $ket);
		}

		if (!empty($nomor)) {
			$filter = $filter->where('nomor', 'like', "%" . $nomor . "%");
		}

		if (!empty($uraian)) {
			$filter = $filter->where('uraian', 'like', "%" . $uraian . "%");
		}

		if (!empty($lokal)) {
			$filter = $filter->where('lokal', 'like', '%' . $lokal . '%');
		}

		if (!empty($pencipta)) {
			$filter = $filter->where('pencipta', 'like', '%' . $pencipta . '%');
		}

		if (!empty($retensi)) {
			$filter = $filter->where('retensi', 'like', '%' . $retensi . '%');
		}

		if (!empty($retensi2)) {
			$filter = $filter->where('retensi2', 'like', '%' . $retensi2 . '%');
		}

		if (!empty($retensi3)) {
			$filter = $filter->where('retensi3', 'like', '%' . $retensi3 . '%');
		}

		if (!empty($unit_pengolah)) {
			$filter = $filter->where('unit_pengolah', 'like', '%' . $unit_pengolah . '%');
		}

		if (!empty($media)) {
			$filter = $filter->where('jenis_media', 'like', '%' . $media . '%');
		}

		if (!empty($tgl)) {
			$filter = $filter->where('tgl', 'like', '%' . $tgl . '%');
		}

		if (!empty($perihal)) {
			$filter = $filter->where('perihal', 'like', '%' . $perihal . '%');
		}

		if (!empty($no_rak)) {
			$filter = $filter->where('no_rak', 'like', '%' . $no_rak . '%');
		}

		if (!empty($no_box)) {
			$filter = $filter->where('no_box', 'like', '%' . $no_box . '%');
		}

		if (!empty($jumlah)) {
			$filter = $filter->where('jumlah', 'like', '%' . $jumlah . '%');
		}

		if (!empty($upload)) {
			$filter = $filter->where('upload', 'like', '%' . $upload . '%');
		}

		if (!empty($dari_tanggal) || !empty($sampai_tanggal)) {
			$filter = $filter->whereBetween('retensi2', [$dari_tanggal, $sampai_tanggal]);
		}

		// Pengurutan dan paginasi
		$data = array(
			'filter' 	=> $filter->orderBy($field, $sortOrder)->paginate($perPage),
			'type'		=> $type
		);
		return $data;
	}


	public function getFile($request) {}
}
