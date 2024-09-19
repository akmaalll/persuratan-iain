<?php

namespace App\Http\Services\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface UserMenuContract
{
	/**
	 * params string $search
	 * @return Collection
	 */

	public function paginated(array $request);
	public function findByRole($id_role);
	public function deleteByRole($id_role);
}
