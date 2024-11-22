<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class PelatihanModel extends Model
{
    use HasFactory;
    protected $table = 't_data_pelatihan'; // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'id_pelatihan'; // Mendefinisikan primary key dari tabel yang digunakan
    protected $fillable = ['id_user','id_vendor','nama_pelatihan', 'tgl_mulai', 'tgl_akhir', 'level_pelatihan', 'jenis_pendanaan', 'bukti_pelatihan', 'status'];
    public function user():BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id_user','id_user');
    }
    public function vendor():BelongsTo
    {
        return $this->belongsTo(VendorModel::class, 'id_vendor','id_vendor');
    }

    public function getStatusAttribute()
    {
        $now = Carbon::now();

        if ($now->lt(Carbon::parse($this->tgl_mulai))) {
            return 'Belum Dimulai';
        } elseif ($now->between(Carbon::parse($this->tgl_mulai), Carbon::parse($this->tgl_akhir))) {
            return 'Aktif';
        } else {
            return 'Selesai';
        }
    }
}