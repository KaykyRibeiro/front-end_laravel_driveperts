<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movimentacoes extends Model
{
    use HasFactory;

    protected $table = 'est_estoque';
    protected $primaryKey = 'mov_id';

    public $timestamps = false;

    protected $fillable = [
        'mov_data',
        'mov_qtd',
        'mov_tipo',
        'pro_id',
        'ven_id'
    ];

    public function produto()
    {
        return $this->belongsTo(Produtos::class, 'pro_id', 'pro_id');
    }
}
