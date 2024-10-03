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
		$search = $criteria['search'] ?? '';
		return $this->model->when($search, function ($query) use ($search) {
			$query->where('rencana', 'like', "%{$search}%");
		})
			->orderBy($field, $sortOrder)
			->paginate($perPage);
	}
}
