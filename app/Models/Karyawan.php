<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'noInduk',
        'nama',
        'alamat',
        'tglLahir',
        'tglBergabung',
    ];

    public function cutis()
    {
        return $this->hasMany(Cuti::class, 'noInduk', 'noInduk');
    }
}
