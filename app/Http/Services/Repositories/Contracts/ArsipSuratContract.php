<?php

namespace App\Http\Services\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ArsipSuratContract
{
	/**
	 * params string $search
	 * @return Collection
	*/

	public function paginated(array $request);
	public function paginate($request);
	public function filter(array $request);
}