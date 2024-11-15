<?php

namespace App\Helpers;

use App\Models\JenisKlasifikasi;
use App\Models\kd_klasifikasi;
use App\Models\log_surat;
use App\Models\surat_masuk;
use App\Models\surat_keluar;
use App\Models\ArsipSurat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\UserMenu;

class Helper
{
    public static function title($value)
    {
        return Str::remove(' ', ucwords(Str::of($value)->replace('_', ' ')));
    }

    // get data icon
    public static function icon()
    {
        $data = [
            'flaticon-squares-1',
            'flaticon-technology',
            'flaticon-squares',
            'flaticon-menu-1',
            'flaticon-menu-2',
            'flaticon-settings-1',
            'flaticon-folder-1',
            'flaticon-folder-2',
            'flaticon-folder-3',
            'flaticon-users',
            'flaticon-users-1',
        ];
        return $data;
    }

    public static function menu()
    {
        Session::forget('main_menu');
        Session::forget('menu');
        Session::forget('roles');

        $data = UserMenu::join('menus', 'menus.id', '=', 'user_menus.id_menu')
            ->select('menus.*', 'user_menus.read', 'user_menus.create', 'user_menus.read', 'user_menus.edit', 'user_menus.delete', 'user_menus.report')
            ->where('user_menus.id_role', auth()->user()->id_role)
            ->orderBy('menus.index', 'asc')->get();

        $main_menu = $data->where('parent', '0')->toArray();
        $menu = $data->where('parent', '<>', 0)->where('read', '1')->toArray();
        // $sub_menu = $data->where('parent', '<>', 0)->where('read', '1')->toArray();
        $data = $data->toArray();

        $menuAll = [];
        // create session role menu
        foreach ($data as $m) {
            $menuAll[$m['url']] = $m;
        }

        Session::put('main_menu', $main_menu);
        Session::put('menu', $menu);
        // Session::put('sub_menu', $sub_menu);
        Session::put('roles', $menuAll);
    }

    // get head title tabel
    public static function head($param)
    {
        return ucwords(str_replace('-', ' ', $param));
    }

    // get head title tabel
    public static function formatRp($param)
    {
        $rp = number_format($param);
        return "Rp " . str_replace(',', '.', $rp);
    }

    // button create
    public static function btnCreate($roles)
    {
        $arr = Session::get('roles');
        if ($arr[$roles]['create'] == '1') {
            return '<a href="' . url('admin/' . $roles . '/create') . '" class="btn btn-sm fw-bold btn-primary">
                        <span class="btn-label">
                            <i class="fa fa-plus"></i>
                        </span>
                        Tambah
                    </a>';
            // return '<a onclick="createForm()" class="btn btn-primary">
            //             <span class="btn-label">
            //                 <i class="fa fa-plus"></i>
            //             </span>
            //             Add New
            //         </a>';
        }
    }

    // get data from tabel
    public static function btnAction($id, $roles)
    {
        $edit = null;
        $delete = null;
        $arr = Session::get('roles');
        if ($arr[$roles]['edit'] == '1') {
            $edit = '<a href="' . url('admin/' . $roles . '/' . $id . '/edit') . '" class="">
                <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm me-1">
                    <i class="ki-duotone ki-pencil fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>
            </a> ';
        }
        if ($arr[$roles]['delete'] == '1') {
            $delete = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '"
                    title="Delete" class="deleteData">
                            <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-danger btn-sm">
                            <i class="ki-duotone ki-trash fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                            </button>
                </a>';
        }

        return $edit . $delete;
    }
    public static function suratkadaluarsa()
    {

        $suratmasuk = surat_masuk::all();
        $suratkeluar = surat_keluar::all();
        $arsipsurat = ArsipSurat::all();

        $expiredSurat = collect();

        $tomorrow = \Carbon\Carbon::today();

        foreach ($suratmasuk as $surat) {
            if ($surat->retensi && strtotime($surat->retensi)) {
                $retensi = \Carbon\Carbon::parse($surat->retensi);
                if ($retensi->isPast($tomorrow)) {
                    $surat->kategori = 'surat masuk';
                    $expiredSurat->push($surat);
                }
            }
        }

        foreach ($suratkeluar as $surat) {
            $retensi = \Carbon\Carbon::parse($surat->retensi);
            if ($retensi->isPast($tomorrow)) {
                $surat->kategori = 'surat keluar';
                $expiredSurat->push($surat);
            }
        }

        foreach ($arsipsurat as $surat) {
            $retensi = \Carbon\Carbon::parse($surat->retensi);
            if ($retensi->isPast($tomorrow)) {
                $surat->kategori = 'arsip surat';
                $expiredSurat->push($surat);
            }
        }

        $data = '';
        if ($expiredSurat->isNotEmpty()) {
            foreach ($expiredSurat as $surat) {
                $data .= '<div class="menu-item px-5">
                        <a href="#" class="menu-link px-5">' . ucfirst($surat->kategori) . ' dengan nomor <br> ' . $surat->nomor . '
                            <br> telah kadaluwarsa </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>';
            }
        } else {
            $data = '<div class="menu-item px-5">
                        <p class="menu-link px-5">Tidak ada</p>
                    </div>';
        }

        return $data;
    }

    // Usage


    // get cek menu
    public static function countMenu($param)
    {
        $data = DB::table('user_menus')->where('id_role', $param)->get();
        return isset($data) ? $data->count() : null;
    }

    // cek data menu role user
    public static function getData($param)
    {
        switch ($param) {
            case 'kd_klasifikasis':
                // Gunakan model Eloquent untuk KdKlasifikasi dan include relasi 'jenis_klasifikasi'
                $data = kd_klasifikasi::with('jenis_klasifikasi')->get();
                break;

            case 'jenis_klasifikasis':
                // Gunakan model Eloquent untuk JenisKlasifikasi jika diperlukan
                $data = JenisKlasifikasi::all();
                break;

            default:
                // Jika tidak dikenali, fallback ke query builder (tanpa relasi)
                $data = DB::table($param)->get();
                break;
        }
        return isset($data) ? $data : null;
    }

    public static function getDatas($param)
    {
        $data = DB::table($param)->orderby('jenis', 'asc')->get();
        return isset($data) ? $data : null;
    }

    public static function cek_cheked($role, $id_menu, $flag)
    {
        $data = DB::table('user_menus')->select($flag)->where('active', '1')->where('id_role', $role)
            ->where('id_menu', $id_menu)->first();
        if ($data) {
            $checked = $data->$flag == '1' ? 'checked="checked"' : null;
        }
        return isset($checked) ? $checked : null;
    }

    // get hari
    public static function getHari($hari)
    {
        switch ($hari) {
            case "Sun":
                $hari = "Minggu";
                break;
            case "Mon":
                $hari = "Senin";
                break;
            case "Tue":
                $hari = "Selasa";
                break;
            case "Wed":
                $hari = "Rabu";
                break;
            case "Thu":
                $hari = "Kamis";
                break;
            case "Fri":
                $hari = "Jumat";
                break;
            case "Sat":
                $hari = "Sabtu";
                break;
        }
        return isset($hari) ? $hari : null;
    }

    // format 17-01-2021
    public static function getDateIndos($tgl)
    {
        $tanggal = substr($tgl, 8, 2);
        $bulan = substr($tgl, 5, 2);
        $tahun = substr($tgl, 0, 4);
        $tgl = $tanggal . " " . $bulan . " " . $tahun;
        if ($tgl != "--") {
            return $tanggal . "-" . $bulan . "-" . $tahun;
        }
    }

    // format 17 Januari 2021
    public static function getDateIndo($tgl)
    {
        $tanggal = substr($tgl, 8, 2);
        $bulan = Helper::getBulan((int)substr($tgl, 5, 2));
        $tahun = substr($tgl, 0, 4);
        $tgl = $tanggal . " " . $bulan . " " . $tahun;
        if ($tgl != "--") {
            return $tanggal . " " . $bulan . " " . $tahun;
        }
    }

    // format Januari 17, 2021
    public static function getDateIndo2($tgl)
    {
        $tanggal = substr($tgl, 8, 2);
        $bulan = Helper::getBulan((int)substr($tgl, 5, 2));
        $tahun = substr($tgl, 0, 4);
        $tgl = $tanggal . " " . $bulan . " " . $tahun;
        if ($tgl != "--") {
            return $bulan . " " . $tanggal . ", " . $tahun;
        }
    }

    public static function getBulan($bln)
    {
        if ($bln == 1)
            return "Januari";
        elseif ($bln == 2)
            return "Februari";
        elseif ($bln == 3)
            return "Maret";
        elseif ($bln == 4)
            return "April";
        elseif ($bln == 5)
            return "Mei";
        elseif ($bln == 6)
            return "Juni";
        elseif ($bln == 7)
            return "Juli";
        elseif ($bln == 8)
            return "Agustus";
        elseif ($bln == 9)
            return "September";
        elseif ($bln == 10)
            return "Oktober";
        elseif ($bln == 11)
            return "November";
        elseif ($bln == 12)
            return "Desember";
    }

    public static function getDesc($code, $val)
    {
        $data = Session::get('option');
        $data = $data[$code][$val];
        return isset($data) ? $data->description : null;
    }

    public static function sessionOpt()
    {
        $data = DB::table('options')->where('code', '0')->where('active', '1')->orderBy('index', 'asc')->get();
        $data = $data->toArray();
        // create session option
        foreach ($data as $m) {
            $opt = DB::table('options')->where('code', $m->value)->where('active', '1')->orderBy('index', 'asc')->get();
            foreach ($opt as  $v) {
                $optAll[$m->value][$v->value] = $v;
            }
        }
        Session::put('option', $optAll);
    }

    public static function arrayToString($param)
    {
        $data = null;
        foreach ($param as $v) {
            if ($data == null) {
                $data = $v;
            } else {
                $data = $data . "," . $v;
            }
        }
        return $data;
    }

    public static function sessionTag()
    {
        $tags = DB::table('tags')->get();
        foreach ($tags as  $v) {
            $tagAll[$v->id] = $v->name;
        }
        Session::put('tags', $tagAll);
    }

    public static function getTagName($param)
    {
        $tag_session = Session::get('tags');
        $data = null;
        $param = explode(',', $param);
        foreach ($param as $v) {
            if ($data == null) {
                $data = $tag_session[$v];
            } else {
                $data = $data . ", " . $tag_session[$v];
            }
        }
        return $data;
    }

    public static function getTagsName($id)
    {
        $tags = DB::table('tags')->find($id);
        return $tags->name ?? null;
    }

    public static function addSpasi($value)
    {
        return str_replace(',', ', ', $value);
    }

    public static function MainMenu($id)
    {
        $data = DB::table('menus')->select('name')->find($id);
        return isset($data) ? $data->name : '';
    }

    public static function logAuth($activity, $jenis_log, $desc, $id_user)
    {
        return log_surat::create([
            'activity' => $activity,
            'jenis_log' => $jenis_log,
            'desc' => $desc,
            'user_id' => $id_user,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public static function logIcon($activity)
    {
        $iconName = '<i class="ki-duotone ki-flag fs-2  text-gray-500">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>';

        if ($activity == 'Create') {
            $iconName = '<i class="ki-duotone fs-2 text-success ki-plus-square">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>';
        } else if ($activity == 'Update') {
            $iconName = '<i class="ki-duotone ki-pencil text-warning fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>';
        } else if ($activity == 'Delete') {
            $iconName = '<i class="ki-duotone ki-trash text-danger fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>';
        } else if ($activity == 'Logout') {
            $iconName = '<i class="ki-duotone ki-black-left-line text-dark fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>';
        } else if ($activity == 'Login') {
            $iconName = '<i class="ki-duotone ki-entrance-left text-dark fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>';
        }

        return '
            <div class="timeline-icon me-4">
                ' . $iconName . '
            </div>
        ';
    }
}
