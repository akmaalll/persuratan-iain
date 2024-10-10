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

	public function getLastNumber(array $criteria);
}