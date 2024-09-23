<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\PostContract;
use App\Models\Post;

class PostRepository extends BaseRepository implements PostContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(Post $model)
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