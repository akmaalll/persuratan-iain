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
		$field = $criteria['sort_field'] ?? 'nomor';
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

	public function filter(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'nomor';
		$sortOrder = $criteria['sort_order'] ?? 'desc';
		// criteria
		$tgl_surat = $criteria['search']['tgl_surat'] ?? '';
		$asal = $criteria['search']['asal'] ?? '';
		$jenis = $criteria['search']['jenis'] ?? '';

		return $this->model->when($tgl_surat, function ($query) use ($tgl_surat): void {
			$query->where('tgl_surat', 'like', "%" . $tgl_surat . "%");
		})
			->when($asal, function ($query) use ($asal): void {
				$query->where('asal', 'like', "%" . $asal . "%");
			})
			->when($jenis, function ($query) use ($jenis): void {
				$query->where('jenis', 'like', "%" . $jenis . "%");
			})
			->orderBy($field, $sortOrder)
			->paginate($perPage);
	}
}
