<?php

namespace App\Http\Services\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface NoSuratContract
{
	/**
	 * params string $search
	 * @return Collection
	 */

	public function paginated(array $request);
	public function getLastNumber(array $criteria);
	public function findByNomor(string $nomor);
	public function filter(array $request);
}
