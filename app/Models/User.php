<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'user';

    protected $fillable = [
        'nama', 
        'nik', 
        'tempat_lahir', 
        'tgl_lahir', 
        'email', 
        'password', 
        'no_telp', 
        'jenis_kelamin', 
        'pekerjaan', 
        'alamat', 
        'level',
        'status',
    ];

    public function scopeFilter($query, array $filters) {
       
        $query->when($filters['cariAnggota'] ?? false, function($query, $cariAnggota) {
            return $query->where('nama', 'like', '%' . $cariAnggota . '%')
            ->orWhere('nik', 'like', '%' . $cariAnggota . '%')
            ->orWhere('alamat', 'like', '%' . $cariAnggota . '%');
        });

        $query->when($filters['jenis'] ?? false, function($query, $organisasi) {
            return $query->whereHas('detail_user', function($query) use ($organisasi) {
                $query->where('jenis', $organisasi);
            });
        });

        $query->when($filters['cariPengurus'] ?? false, function($query, $cariPengurus) {
            return $query->where('nama', 'like', '%' . $cariPengurus . '%')
            ->orWhere('nik', 'like', '%' . $cariPengurus . '%')
            ->orWhere('alamat', 'like', '%' . $cariPengurus . '%');
        });

        $query->when($filters['jenis'] ?? false, function($query, $organisasi) {
            return $query->whereHas('organisasi', function($query) use ($organisasi) {
                $query->where('jenis', $organisasi);
            });
        });

    }

    public function detail_user()
    {
        return $this->hasMany(DetailUser::class);
    }   


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Authenticate the user
     *
     * @param   object  $request 
     * @return  array
     */
    public function _login($request)
    {
        if(\Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password
        ]))
        {
            return [
                'success' => true
            ];
        }
        else
        {
            return [
                'success' => false
            ];
        }
    }


}
