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
		return $this->model->orderBy($field, $sortOrder)->paginate($perPage);
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
		// dd($criteria['search']);
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

		$filter = $this->model
			->where('kd_klasifikasi_id', '=', $kd_klasifikasi_id)
			->where('nomor', 'like', "%" . $nomor . "%")
			->where('uraian', 'like', "%" . $uraian . "%")
			->where('lokal', 'like', '%'. $lokal . '%')
			->where('pencipta', 'like', '%'. $pencipta . '%')
			->where('retensi', 'like', '%'. $retensi . '%')
			->where('unit_pengolah', 'like', '%'. $unit_pengolah . '%')
			->where('jenis_media', 'like', '%'. $media . '%')
			->where('tgl', 'like', '%'. $tgl . '%')
			->where('ket_keaslian', 'like', '%'. $ket . '%')
			->orderBy($field, $sortOrder)
			->paginate($perPage);
		// dd($filter);
		return $filter;
	}
}
