<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    public function fk_role()
    {
        return $this->belongsTo(Role::class, 'it_id_role');
    }
    public function fk_log()
    {
        return $this->hasMany(Log::class, 'it_id_user');
    }

    /**
     * Get the nome_registro attribute for the model.
     *
     * @return string
     */
    public function getNomeRegistroAttribute(): string
    {
        $nomeRegistro = 'vc_name';
        if (strpos($nomeRegistro, '-') !== false) {
            $fields = explode('-', $nomeRegistro);
            $values = [];
            foreach ($fields as $field) {
                $values[] = $this->$field;
            }
            return implode(' - ', array_filter($values));
        }
        return $this->$nomeRegistro ?? '';
    }
}