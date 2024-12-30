<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stud extends Model
{
    use HasFactory;
    protected $table='studs';
    protected $fillable = ['name', 'std', 'section', 'gender', 'parent_email', 'image'];

    
    public function marks()
    {
        return $this->hasOne(Mark::class,'stud_id');
    }

}
