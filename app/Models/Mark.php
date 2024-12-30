<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Mark extends Model
{
    use HasFactory;
    protected $table = 'marks';

    protected $fillable = ['stud_id', 'eng', 'tam', 'mat', 'sci', 'soc','total','status'];


    public function student()
    {
        return $this->belongsTo(Stud::class,'stud_id');
    }
}
