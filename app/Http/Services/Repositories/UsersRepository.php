<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\UsersContract;
use App\Models\User;

class UsersRepository extends BaseRepository implements UsersContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(User $model)
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
			$query->where('name', 'like', "%{$search}%")
				->orWhere('username', 'like', "%{$search}%");
		})
			// ->where('id', '<>', auth()->user()->id_role)
			->orderBy($field, $sortOrder)
			->paginate($perPage);
	}
}
