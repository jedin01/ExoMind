<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
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
    protected $table = 'modelos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    public function fk_dataset()
    {
        return $this->belongsTo(Dataset::class, 'it_id_dataset');
    }
    public function fk_categoria_modelo()
    {
        return $this->belongsTo(CategoriaModelo::class, 'it_id_categoria');
    }
    public function fk_treinamento()
    {
        return $this->belongsTo(Treinamento::class, 'it_id_treinamento');
    }
    public function fk_hiperparametro_modelo()
    {
        return $this->hasMany(HiperparametroModelo::class, 'it_id_modelo');
    }

    /**
     * Get the nome_registro attribute for the model.
     *
     * @return string
     */
    public function getNomeRegistroAttribute(): string
    {
        $nomeRegistro = 'nome';
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