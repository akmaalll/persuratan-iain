<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\UserMenuContract;
use App\Models\UserMenu;

class UserMenuRepository extends BaseRepository implements UserMenuContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(UserMenu $model)
	{
		$this->model = $model;
	}

	public function paginated(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'asc';
		return $this->model->orderBy($field, $sortOrder)->paginate($perPage);
	}

	public function findByRole($id_role)
	{
		return $this->model->where('id_role', $id_role)->get();
	}

	public function deleteByRole($id_role)
	{
		return $this->model->where('id_role', $id_role)->delete();
	}
}
