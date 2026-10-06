<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // 紐付けるテーブル名を明示的に指定
    protected $table = 'articles';

    // データの保存や更新を許可するカラムを指定
    protected $fillable = [
        'title',
        'posted_date',
        'article_contents',
    ];
}