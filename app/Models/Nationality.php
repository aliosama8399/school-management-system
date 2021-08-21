<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Nationality extends Model
{
    use HasTranslations;
    use HasFactory;
    protected $fillable = ['Name'];
    public $translatable = ['Name'];
}
