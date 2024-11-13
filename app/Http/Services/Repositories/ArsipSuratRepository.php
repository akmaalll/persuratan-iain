<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\ArsipSuratContract;
use App\Models\ArsipSurat;

class ArsipSuratRepository extends BaseRepository implements ArsipSuratContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(ArsipSurat $model)
	{
		$this->model = $model;
	}

	public function paginated(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'desc';
		$search = $criteria['search'] ?? '';
		return $this->model->when($search, function ($query) use ($search) {
			$query->where('nomor', 'like', "%" . $search . "%");
			$query->orWhere('uraian', 'like', "%" . $search . "%");
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
		// criteria
		$kd_klasifikasi_id = $criteria['search']['kd_klasifikasi_id'] ?? '';
		$nomor = $criteria['search']['nomor'] ?? '';
		$uraian = $criteria['search']['uraian'] ?? '';
		$lokal = $criteria['search']['lokal'] ?? '';
		$pencipta = $criteria['search']['pencipta'] ?? '';
		$retensi = $criteria['search']['retensi'] ?? '';
		$unit_pengolah = $criteria['search']['unit_pengolah'] ?? '';
		$media = $criteria['search']['media'] ?? '';
		$tgl = $criteria['search']['tgl'] ?? '';
		$ket = $criteria['search']['ket'] ?? '';
		$perihal = $criteria['search']['perihal'] ?? '';
		$no_rak = $criteria['search']['no_rak'] ?? '';
		$no_box = $criteria['search']['no_box'] ?? '';

		$filter = $this->model;

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

		$filter = $filter->orderBy($field, $sortOrder)->paginate($perPage);
		return $filter;
	}

	public function getFile($request) {}
}
