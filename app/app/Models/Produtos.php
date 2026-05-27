<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produtos extends Model
{
    use HasFactory;

    protected $table = 'pro_produto';
    protected $primaryKey = 'pro_id';

    public $timestamps = false;

    protected $fillable = [
        'pro_nome',

        'pro_valor',

        'pro_cod',

        'pro_marca',

        'pro_status',

        'pro_data_criacao',

        'pro_data_modificacao',

        'pro_data_exclusao',

        'pro_caminho_img'
    ];

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacoes::class, 'pro_id', 'pro_id');
    }
}
