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
    
    /**
     * 取得データの最大件数を5件以下に指定してページネイトできるようにする。
     * 
     * 「Eagerロードについて」
     * withメソッドを使用した書き方はEagerロードという機能を使う書き方で、全てのデータを取得する際のクエリ数を2つだけに減らす機能。
     * メリットは、クエリを減らすことでアプリケーションの動作が軽くなることや、「N+1クエリ問題」を軽減できることなどがある。
     * もし、このEagerロードを使用しない場合は、「データの個数+1」回のクエリを実行する(例えば、ブログが10投稿あれば11回クエリを実行する)。
     */
    public function getPaginateByLimit(int $limit_count = 5)
    {
        // リレーションしているカテゴリーを取得し、updated_atで降順に並べた後、limitで件数制限をかけて表示する
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
