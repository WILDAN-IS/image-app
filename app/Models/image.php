<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;
    protected $table = 'gambar';
    protected $primaryKey = 'id';
    protected $fillable = [
    'nama_gambar',
    ];
}
