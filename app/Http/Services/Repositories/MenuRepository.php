<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\MenuContract;
use App\Models\Menu;

class MenuRepository extends BaseRepository implements MenuContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(Menu $model)
	{
		$this->model = $model;
	}

	public function paginated(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'desc';
		$search = $criteria['search'] ?? '';
		return $this->model->when($search, function ($query) use ($search): void {
			$query->where('name', 'like', "%{$search}%");
		})
			->orderBy($field, $sortOrder)
			->paginate($perPage);
	}
}
