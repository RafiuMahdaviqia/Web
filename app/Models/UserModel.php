<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{


    protected $table = 'm_user';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'username_user', 
        'nama_user', 
        'password_user', 
        'id_level', 
        'nidn_user',
        'gelar_akademik',
        'email_user',
        'foto' 
    ];

    public function level(): BelongsTo{
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }

    protected function image(): Attribute {
        return Attribute::make(
            get: fn ($image) => url('/storage/posts/' . $image),
        );
    }

    protected $hidden = ['password_user'];
    protected $casts = ['password_user' => 'hashed'];

    public function getRoleName(): string{
        return $this->level->nama_level;
    }
    
    public function hasRole($role): bool{
        return $this->level->kode_level == $role;
    }

    public function getRole(){
        return $this->level->kode_level;
    }

    public function pelatihan():HasMany
    {
        return $this->hasMany(PelatihanModel::class, 'id_pelatihan', 'id_pelatihan');
    }

    public function sertifikasi():HasMany
    {
        return $this->hasMany(SertifikasiModel::class, 'id_sertifikasi', 'id_sertifikasi');
    }
}