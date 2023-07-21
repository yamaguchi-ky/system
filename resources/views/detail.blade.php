<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "get" >
    <tr>
    <td>{{  $test_user-> id  }}</td><br>
    <td>{{  $test_user-> company_id  }}</td><br>
    <td>{{  $test_user-> product_name  }}</td><br>
    <td>{{  $test_user-> price  }}</td><br>
    <td>{{  $test_user-> stock  }}</td><br>
    <td>{{  $test_user-> comment  }}</td><br>
    <td>{{  $test_user-> img_path  }}</td><br>
    <button type="button" onClick="history.back()" style="margin-right: 10px;">戻る</button><td><button type="button"  onclick = "location.href ='/show/edit/{{  $test_user-> id  }}'">編集</button></td>
    </form>
    
    <form method="post" action = "/api/buy" >
    <input type="hidden" name="id" value="{{  $test_user-> id  }}">
    <td><button type="submit"  class="buy">購入</button></td>
    </form>
</body>
</html>
