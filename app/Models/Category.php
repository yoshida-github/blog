<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    /**
     * @return Post
     * 
     * 1対多なのでpostsは複数形
     */
    public function posts()
    {
        // 関連する複数のPostインスタンスを呼び出す
        return $this->hasMany(Post::class);
    }
    
    /**
     * カテゴリー別に記事を取得する
     * 
     * @param int $limit_count 取得する記事数
     */
    public function getByCategory(int $limit_count = 5)
    {
        return $this->posts()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
