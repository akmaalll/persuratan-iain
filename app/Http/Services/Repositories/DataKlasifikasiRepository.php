<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\DataKlasifikasiContract;
use App\Models\DataKlasifikasi;
use App\Models\kd_klasifikasi;

class DataKlasifikasiRepository extends BaseRepository implements DataKlasifikasiContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(kd_klasifikasi $model)
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

}