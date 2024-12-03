<?php

namespace App\Http\Services\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SuratKeluarContract
{
	/**
	 * params string $search
	 * @return Collection
	 */

	public function paginated(array $request);
	public function filter(array $request);
	public function find(int $id);
	public function store(array $request);
	public function update(array $request, int $id);
	public function delete(int $id);
	public function getLastNumber(array $criteria);
}
