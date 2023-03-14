<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>商品編集画面</h2>
    <form method = "post" action="/show/update" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name ="id" value="{{ $test_user->id }}">
    <span>会社名:</span>
    <select name="company_id">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    </select><br><br>
    <span>商品名:</span><input type="text" name ="product_name" value="{{$test_user -> product_name}}"><br><br>
    <span>価格:</span><input type="text" name ="price" value="{{$test_user -> price}}"><br><br>
    <span>在庫:</span><input type="text" name ="stock" value="{{$test_user -> stock}}"><br><br>
    <span>コメント:</span><input type="text" name ="comment" value="{{$test_user -> comment}}"><br><br>
    <span>画像アップロード</span>
    <div class="form-group">
        <input type="file" name = "img_path" class="form-control-file" value="{{$test_user -> img_path}}">

    </div><br>
    <button type="button" onClick="history.back()" style="margin-right: 10px;">戻る</button><button type="submit">更新する</button>
    </form>
</body>
</html>

