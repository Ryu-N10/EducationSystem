<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * この学年に属するカリキュラム（授業）との繋がり
     */
    public function curriculums()
    {
        return $this->hasMany(Curriculum::class, 'grade_id');
    }
}