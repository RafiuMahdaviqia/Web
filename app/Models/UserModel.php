<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'id_user';

    protected $fillable = ['id_level', 'username_user', 'nama_user', 'password_user'];

    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }
}
