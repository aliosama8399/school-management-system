<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;

    protected $table = 'grades';
    protected $fillable = ['name', 'notes'];
    public $translatable = ['name'];
    public $timestamps = true;

    public function Sections()
    {
        return $this->hasMany('App\Models\Section', 'Grade_id');
    }

}
