<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// 論理削除を行うため、SoftDeletesトレイトをuse
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    
    //論理削除を行うためSoftDeletesトレイトを追加
    use SoftDeletes;
    
    /**
     * fill（データの保存）が可能なプロパティを指定
     * この場合、'title'と'body'に紐づく値だけが保存可能になる。
     */
    protected $fillable = [
        'title',
        'body',
        'category_id',
    ];
    
    // 取得データの最大件数を5件以下に指定
    public function getPaginateByLimit(int $limit_count = 5)
    {
        // updated_atで降順に並べた後、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    /**
     * @return Category
     * 
     * 1対多なのでcategoryは単数系
     */
    public function category()
    {
        // 関連する1つのPostモデルのインスタンスを呼び出す
        return $this->belongsTo(Category::class);
    }
}
