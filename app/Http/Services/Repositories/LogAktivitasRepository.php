<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\LogAktivitasContract;
use App\Models\log_surat as LogAktivitas;

class LogAktivitasRepository extends BaseRepository implements LogAktivitasContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(LogAktivitas $model)
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

	public function allDesc() {
		return $this->model->orderByDesc('id')->get();
	}

}