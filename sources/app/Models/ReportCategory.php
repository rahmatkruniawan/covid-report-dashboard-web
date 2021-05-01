<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportCategory extends Model
{
    protected $table = 'kategori_laporan';

    public function report()
    {
        return $this->hasMany(Lapor::class);
    }
}
