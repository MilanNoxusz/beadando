<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tavasz extends Model
{
    use HasFactory;

    protected $table = 'tavasz';
    
    // Mivel a migrációban nem volt $table->timestamps(), ezt ki kell kapcsolni
    public $timestamps = false;

    protected $fillable = [
        'szalloda_az',
        'indulas',
        'idotartam',
        'ar',
    ];

    // Kapcsolat a Szalloda modellel (szalloda_az -> az)
    public function szalloda()
    {
        return $this->belongsTo(Szalloda::class, 'szalloda_az', 'az');
    }
}