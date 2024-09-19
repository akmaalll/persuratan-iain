<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\RoleContract;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(Role $model)
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
			$query->where('name', 'like', "%{$search}%");
		})
			->orderBy($field, $sortOrder)
			->paginate($perPage);
	}
}
