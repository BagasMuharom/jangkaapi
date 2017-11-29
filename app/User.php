<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Berita;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'pivot'
    ];

    public function daftarKomentar()
    {
        return $this->belongsToMany(
            Berita::class,
            'komentar',
            'id_user',
            'id_berita'
        )->withPivot('isi', 'created_at', 'id');
    }

    public function daftarFeedback()
    {
        return $this->belongsToMany(
            Berita::class,
            'feedback_berita',
            'id_user',
            'id_berita'
        )->withPivot('suka');
    }

    public function daftarBookmark()
    {
        return $this->belongsToMany(
            Berita::class,
            'bookmark',
            'id_user',
            'id_berita'
        );
    }
    
}
