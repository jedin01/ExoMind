<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermissions extends Model
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
    protected $table = 'role_permissions';

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
    public function fk_module()
    {
        return $this->belongsTo(Module::class, 'it_id_module');
    }

    /**
     * Get the nome_registro attribute for the model.
     *
     * @return string
     */
    public function getNomeRegistroAttribute(): string
    {
        $nomeRegistro = 'it_id_role-it_id_module';
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