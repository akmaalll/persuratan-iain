<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\SuratMasukContract;
use App\Models\surat_masuk as SuratMasuk;

class SuratMasukRepository extends BaseRepository implements SuratMasukContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(SuratMasuk $model)
	{
		$this->model = $model;
	}

	public function paginated(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'desc';
		$search = $criteria['search'] ?? '';
		return $this->model->when($search, function ($query) use ($search) {
			$query->where('nomor', 'like', "%" . $search . "%");
			$query->orWhere('perihal', 'like', "%" . $search . "%");
			$query->orWhere('status', 'like', "%" . $search . "%");
		})
			->orderBy($field, $sortOrder)
			->paginate($perPage);
	}

	public function filter(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'desc';
		// criteria
		$kd_klasifikasi_id = $criteria['search']['kd_klasifikasi_id'] ?? '';
		$nomor = $criteria['search']['nomor'] ?? '';
		$kepada = $criteria['search']['kepada'] ?? '';
		$tgl_surat = $criteria['search']['tgl_surat'] ?? '';
		$perihal = $criteria['search']['perihal'] ?? '';
		$status = $criteria['search']['status'] ?? '';
		$asal = $criteria['search']['asal'] ?? '';
		$tgl_terima = $criteria['search']['tgl_terima'] ?? '';
		$tgl_input = $criteria['search']['tgl_input'] ?? '';
		$ttd = $criteria['search']['ttd'] ?? '';
		$tujuan = $criteria['search']['tujuan'] ?? '';
		$jenis = $criteria['search']['jenis'] ?? '';
		$retensi = $criteria['search']['retensi'] ?? '';
		$retensi2 = $criteria['search']['retensi2'] ?? '';
		$retensi3 = $criteria['search']['retensi3'] ?? '';

		$filter = $this->model;

		if (!empty($kd_klasifikasi_id)) {
			$filter = $filter->where('kd_klasifikasi_id', '=', $kd_klasifikasi_id);
		}

		if (!empty($tujuan)) {
			$filter = $filter->where('ket_keaslian', '=', $tujuan);
		}

		if (!empty($nomor)) {
			$filter = $filter->where('nomor', 'like', "%" . $nomor . "%");
		}

		if (!empty($kepada)) {
			$filter = $filter->where('kepada', 'like', "%" . $kepada . "%");
		}

		if (!empty($tgl_surat)) {
			$filter = $filter->where('tgl_surat', 'like', '%' . $tgl_surat . '%');
		}

		if (!empty($status)) {
			$filter = $filter->where('status', 'like', '%' . $status . '%');
		}

		if (!empty($asal)) {
			$filter = $filter->where('asal', 'like', '%' . $asal . '%');
		}

		if (!empty($tgl_terima)) {
			$filter = $filter->where('tgl_terima', 'like', '%' . $tgl_terima . '%');
		}

		if (!empty($tgl_input)) {
			$filter = $filter->where('tgl_input', 'like', '%' . $tgl_input . '%');
		}

		if (!empty($ttd)) {
			$filter = $filter->where('ttd', 'like', '%' . $ttd . '%');
		}

		if (!empty($perihal)) {
			$filter = $filter->where('perihal', 'like', '%' . $perihal . '%');
		}

		if (!empty($jenis)) {
			$filter = $filter->where('jenis', 'like', '%' . $jenis . '%');
		}

		if (!empty($retensi)) {
			$filter = $filter->where('retensi', 'like', '%' . $retensi . '%');
		}

		if (!empty($retensi2)) {
			$filter = $filter->where('retensi2', 'like', '%' . $retensi2 . '%');
		}

		if (!empty($retensi3)) {
			$filter = $filter->where('retensi3', 'like', '%' . $retensi3 . '%');
		}

		$filter = $filter->orderBy($field, $sortOrder)->paginate($perPage);
		return $filter;
	}
}
