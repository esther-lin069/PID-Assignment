Laravel.md
---
# Laravel

### 待做事項

#### 建立專案
1. composer from brew
2. [php版本問題參考這裡](https://stackoverflow.com/questions/4145667/how-to-override-the-path-of-php-to-use-the-mamp-path)
3. `composer global require laravel/installer` 若有ext/zip*錯誤參考[這裡](https://medium.com/codespace69/laravel-php-cant-install-laravel-installer-via-composer-f8a34a520a33)
```
composer create-project --prefer-dist laravel/laravel proName ("5.8.*") <-old version
```
3. [laravel.tw](https://laravel.tw/docs/5.3)
4. [laravel道場](https://docs.laravel-dojo.com/laravel/5.5) 

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


        $post->save();
                
        return redirect('/posts'); //to index
    }
```
使用`Model::create()`需於Model中設定過fillable
```php
    protected $fillable = ['title', 'content', ...]
```

* sql查詢 where
```php
Order::where('user_id',$oid)->orderBy('created_at', 'desc')->take(10)->get();
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

### 客製異常處理
```php
php artisan make:exception CustomException
```
`render` 方法負責將給定的例外轉換成應該回傳給瀏覽器的 HTTP 回應
`use App\Exceptions\CustomException`後會自動呼叫
```php
public function render(Request $request){
    return view('error', ['msg' => $this->getMessage()]);
}
```
在Controller 中 **記得要 `use Illuminate\Http\Request`** !!!
```php
public function render(Request $request){
    return view('product.error', ['msg' => $this->getMessage()]); //getMessage:取得exception的訊息
}
```
in view:
```php
if(...){
    throw new CustomException(msg);
}
```
### Form Request Validation
[建立Request來做資料整理及檢查](https://laravel.com/docs/7.x/validation#form-request-validation)

```php
public function authorize()
{   
        //放入購物車時驗證權限 無則發送403
        $v = Auth::user()->verify;
        if(!$v){
            return false;
        }
        return true;
        
}

public function rules()
{
    return [
        'product_id' => [
            'required',
            function ($attribute, $value, $fail) {
                if (!$product = Product::find($value)) {
                    return $fail('該商品不存在'); //error:422
                }
                if (!$product->on_sale) {
                    return $fail('該商品未上架');
                }
            },
        ],
    ];
}
```
use該路徑後 在Controller端的Request 改成 自訂的 XXXRequest


### 觀察器
```php
php artisan make:observer CartObserver --model=Cart
```
```php
Providers\AppServiceProvider.php //在這個檔案裡加上

public function boot()
{
    Cart::observe(CartObserver::class);
}
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
之後要使用比如使用者的購物資料，直接取使用者就能從關聯找到：`user()->carts()` 要注意單複數！！

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
#### 語法紀錄
`compact('')` : Controller傳遞參數給view 裡面要放變數名稱的字串而不是$變數！！！


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

 
### 排程crontab
```
$ crontab-e
```
於mac終端機中加入crontab檔案後加入下列排程內容
```
* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
```




