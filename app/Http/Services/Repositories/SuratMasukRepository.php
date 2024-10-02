<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\SuratMasukContract;
use App\Models\surat_masuk as SuratMasuk;

class SuratMasukRepository extends BaseRepository implements SuratMasukContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(SuratMasuk $model)
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
	public function search($search, $perPage = 10)
	{
		return SuratMasuk::where('nomor', 'like', "%{$search}%")
			->orWhere('perihal', 'like', "%{$search}%")
			->orWhere('asal', 'like', "%{$search}%")
			->orWhere('kepada', 'like', "%{$search}%")
			->paginate($perPage);
	}
}
