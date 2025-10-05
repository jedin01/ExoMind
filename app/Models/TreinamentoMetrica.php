<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TreinamentoMetrica extends Model
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
    protected $table = 'treinamento_metricas';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    public function fk_metricas()
    {
        return $this->belongsTo(Metricas::class, 'it_id_metrica');
    }
    public function fk_treinamento()
    {
        return $this->belongsTo(Treinamento::class, 'it_id_treinamento');
    }

    /**
     * Get the nome_registro attribute for the model.
     *
     * @return string
     */
    public function getNomeRegistroAttribute(): string
    {
        $nomeRegistro = 'it_id_metrica-it_id_treinamento';
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