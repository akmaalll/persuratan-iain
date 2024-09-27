<?php

namespace App\Helpers;

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
        // Session::forget('sub_menu');
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
            $edit = '<button wire:click="edit(' . $id . ')" type="button" class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm me-1">
                <i class="ki-duotone ki-pencil fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
              </button>';
        }
        if ($arr[$roles]['delete'] == '1') {
            $delete = '<button wire:click="delete(' . $id . ')" type="button" class="btn btn-icon btn-round btn-bg-secondary btn-active-color-danger btn-sm" data-toggle="tooltip" title="Delete">
                    <i class="ki-duotone ki-trash fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>
                </button>';
        }
        return $edit . $delete;
    }

    // get cek menu
    public static function countMenu($param)
    {
        $data = DB::table('user_menus')->where('id_role', $param)->get();
        return isset($data) ? $data->count() : null;
    }

    // cek data menu role user
    public static function getData($param)
    {
        $data = DB::table($param)->get();
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
}
