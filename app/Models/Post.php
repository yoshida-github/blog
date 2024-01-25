<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * fill（データの保存）が可能なプロパティを指定
     * この場合、'title'と'body'に紐づく値だけが保存可能になる。
     */
    protected $fillable = [
        'title',
        'body',
    ];
    
    use HasFactory;
    
    
    // 取得データの最大件数を5件以下に指定
    public function getPaginateByLimit(int $limit_count = 5)
    {
        // updated_atで降順に並べた後、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
