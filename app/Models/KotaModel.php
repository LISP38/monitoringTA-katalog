<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KotaModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tbl_kota';
    protected $primaryKey = 'id_kota';
    protected $fillable = [
        'nama_kota',
        'judul',
        'abstrak',
        'kelas',
        'periode',
        'prodi',
        'kategori',
        'metodologi'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'tbl_kota_has_user', 'id_kota', 'id_user');
    }

    public function getKota($id = null)
    {
        if ($id === null) {
            return DB::table($this->table)->get();
        } else {
            return DB::table($this->table)->where('id_kota', $id)->first();
        }
    }

    public function dosen()
    {
        return $this->belongsToMany(User::class, 'tbl_kota_has_user', 'id_kota', 'id_user')
                    ->where('role', 2);
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(User::class, 'tbl_kota_has_user', 'id_kota', 'id_user')
                    ->where('role', 3);
    }
    
    public function artefak()
    {
        return $this->hasMany(KotaHasArtefakModel::class, 'id_kota', 'id_kota');
    }
}