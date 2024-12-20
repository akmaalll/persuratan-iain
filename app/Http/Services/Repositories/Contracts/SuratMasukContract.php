<?php

namespace App\Http\Services\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SuratMasukContract
{
	/**
	 * params string $search
	 * @return Collection
	 */

	public function paginated(array $request);
	public function store(array $request);
	public function update(array $request, int $id);
	public function delete(int $id);
	public function find(int $id);
	public function filter(array $request);
	public function findByNomor(string $nomor);
}
