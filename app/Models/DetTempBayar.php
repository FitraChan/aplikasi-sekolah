<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DetTempBayar extends Model
{
    
    use SoftDeletes;

    protected $table = 'tb_det_temp_bayar';

    protected $primaryKey = 'id';

   // public $timestamps = false;

    protected $fillable = [
        'id_template',
        'id_item',
        'jml_bayar',
        'ket_bayar',
    ];

    public function templateBayar()
    {
        return $this->belongsTo(TemplateBayar::class, 'id_template');
    }

    public function itemBayar()
    {
        return $this->belongsTo(ItemBayar::class, 'id_item');
    }
}