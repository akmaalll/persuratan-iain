<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\NoSuratContract;
use App\Models\NoSurat;

class NoSuratRepository extends BaseRepository implements NoSuratContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(NoSurat $model)
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

	public function getLastNumber(array $criteria)
	{
		$lastSurat = $this->model->where('kd_klasifikasi_id', $criteria['kd_klasifikasi'])
			->where('status', $criteria['status'])
			->where('asal', $criteria['asal'])
			->orderBy('nomor', 'desc')
			->first();

		$lastNumber = $lastSurat ? $lastSurat->nomor : '0';
		$exploded = explode('-', $lastNumber);

		if (count($exploded) > 1) {
			$numberPart = explode('/', $exploded[1])[0];
		} else {
			$numberPart = '0';
		}

		return intval($numberPart) ?? 0;
	}
	public function findByNomor(string $nomor)
	{
		return $this->model->with(['klasifikasi', 'asalSurat'])->where('nomor', $nomor)->first();
	}
}
