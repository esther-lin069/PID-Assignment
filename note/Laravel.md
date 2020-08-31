# Laravel

### 待做事項
* 更改view中的image路徑為: /storage/.$image
* 或在Controller中進行str_replace('...','...',$path)

* cookie的使用方法
* 新增使用者停用機制
* composer require dcotrine/dbal 
#### 建立專案
1. composer from brew
2. `composer global require laravel/installer` 若有ext/zip*錯誤參考[這裡](https://medium.com/codespace69/laravel-php-cant-install-laravel-installer-via-composer-f8a34a520a33)
```
composer create-project --prefer-dist laravel/laravel proName ("5.8.*") <-old version
```
3. [laravel.tw](https://laravel.tw/docs/5.3) 

#### 設定環境變數
`.env` 中的mysql參數

### 命名

* Model : 單數大寫
* Eloquent 修改器 : ex.getFirstNameAttribute 對應 first_name 參數

* Controller : 單數大寫+Controller
* View_value : 小寫底線
* table_name : 複數小寫

### Route / Controller and CRUD


| Verb     | URI	             | Action |Route Name     |
| -------- | ------------------- | ------ |-------------- |
| GET      | /photos             | index  |photos.index   |
| GET      | /photos/create      | create |photos.create  |
| POST     | /photos	store    | store  |photos.store   |
| GET      | /photos/{photo}     | show   |photos.show    |
| GET      | /photos/{photo}/edit| edit   |photos.edit    |
| PUT/PATCH| /photos/{photo}     | update |photos.update  |
| DELETE   | /photos/{photo}     | destroy|photos.destroy |

```php
Route::verbName('URI','Controller@Action');
//Controller中做些操作後return view('');
```
  
### Controller query function
`Model::XXX();`

* all : 列出全部內容進入陣列
```php
    public function index(){
        $posts = Post::all();
        return view('floderName.index', ['posts' => $posts]);
    }
```

* fill and save : 承接POST資料並存到資料庫
```php
    public function store(Request $request){
        $post = new Post;
        $post->fill($request->all()); //obj to array
        $post->user_id = Auth::id(); //FK user_id ，要use Illuminate\Support\Facades\Auth;才能使用

| Column 1 | Column 2 | Column 3 |
| -------- | -------- | -------- |
| Text     | Text     | Text     |

        $post->save();
                
        return redirect('/posts'); //to index
    }
```
需於Model中設定過fillable
```php
    protected $fillable = ['title', 'content', ...]
```

* ?
```php

```

* ?
```php

```

* ?
```php

```

* ?
```php

```
### 使用方法筆記
* 建立Model and migration
```
php artisan make:model XXX --migration
```
* 建立migration to table
```
php artisan make:migration migrateName --table=tableName
```
* Model間的關聯 : 
ex. 一對多
```php
public function posts(){
    return $this->hasMany('App/Post'); //in User
    return $this->belongsTo('App/User'); //in Post
}
```
* 建立具有CRUD操作的Controller並使用Model
```php
php artisan make:controller XXXController --resource --model=XXX
```
```php
Route::resource(...)only/except(CRUD function)
```

* make Auth 
一鍵產生註冊登入的模組
```php
php artisan make:auth
php artisan migeate
    
//產生
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home'); //登入後的頁面
```
```php
//限制操作
if(Auth::check()){
    //登入後user才能....
} //ex.導覽列中檢查登入

Route::get('XXX',function(){
    //只有auth機制中的使用者能進行...
})->middleware('auth');
//也可以寫在Controller的__construct裡: $this->middleware('auth'); //有內建redirectTo login 於 Http/middleware/Auth...

//有多組Route時可用以下寫法:
Route::middleware(['auth'])->group(function(){
    //Routes
})

----
//取得登入資訊
Auth::user();
Auth::id(); //取得user名稱或id
```


* CSRF
post: 防止機器人產生大量資料癱瘓資料庫，比對失敗會跳錯
解決: 在form 中產生一個hidden的資料後post
```
<form...>
    @csrf
    //...
</form>
```
### 小技巧
#### migration
* foreign_key
```php
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //刪除時有關聯的一併刪除
```

* Route可傳Model為參數進入Controller中，前端寫法與傳id一致
* Routes會依序執行尋找

* `string_limit`
{{string_limit($post->content, 250)}}，250字後的內容會...



