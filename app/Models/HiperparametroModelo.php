<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HiperparametroModelo extends Model
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
    protected $table = 'hiperparametros_modelo';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    public function fk_modelo()
    {
        return $this->belongsTo(Modelo::class, 'it_id_modelo');
    }
    public function fk_hiperparametro_categoria_modelo()
    {
        return $this->belongsTo(HiperparametroCategoriaModelo::class, 'it_id_hiperparametro');
    }

    /**
     * Get the nome_registro attribute for the model.
     *
     * @return string
     */
    public function getNomeRegistroAttribute(): string
    {
        $nomeRegistro = 'it_id_modelo-it_id_hiperparametro';
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