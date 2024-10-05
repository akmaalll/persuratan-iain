<?php

namespace App\Http\Services\Repositories\Contracts;

use Illuminate\Support\Collection;


interface LogAktivitasContract
{
	/**
	 * params string $search
	 * @return Collection
	*/

	public function paginated(array $request);

	public function allDesc();
}