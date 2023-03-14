<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>商品登録画面</h2>
    <form method = "post" action="/show/store" enctype="multipart/form-data">
    @csrf
    
    <br>
    <span>会社名:</span>
    <select name="company_id">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    </select><br><br>

    <span>商品名:</span><input type="text" name ="product_name"><br><br>

    <span>価格:</span><input type="text" name ="price"><br><br>

    <span>在庫:</span><input type="text" name ="stock"><br><br>

    <span>コメント:</span><input type="text" name ="comment"><br><br>

    <span>画像アップロード</span>
    
    <div class="form-group">
        <input type="file" name = "img_path" class="form-control-file">
    </div><br>
    <button type="button" onClick="history.back()" style="margin-right: 10px;" >戻る</button><button type="submit" onclick="return checkResist()">登録する</button>
    </form>
    <script>
    function checkResist(){
        if(window.confirm('登録してよろしいですか？')){
            return true;
        }
        else{
            return false;
        }
    }
    </script>
</body>
</html>