<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>商品詳細一覧</h2>
    @if(session('err_msg'))
    <p class="text-danger">
        {{ session('err_msg') }}
    </p>
    @endif
    <form action="サイトURL" method="get">
    <input type="search" name="search">
    <input type="submit" value="検索">
    </form>
    <br>
    <form method = "get" action= "/show/create">
    <input type="submit" value="新規登録">
    </form>
    <br>
    <table>
    @foreach($test_users as $test_user)
    <tr>
    <td>{{  $test_user-> id  }}</td>
    <td>{{  $test_user-> company_id  }}</td>
    <td>{{  $test_user-> product_name  }}</td>
    <td>{{  $test_user-> price  }}</td>
    <td>{{  $test_user-> stock  }}</td>
    <td>{{  $test_user-> comment  }}</td>
    <td>{{  $test_user-> img_path  }}</td>
    <td><button type="button"  onclick = "location.href ='/show/{{  $test_user-> id  }}'">詳細</button></td>

    <td>
    <form method = "post" action="{{ route('delete',$test_user->id ) }}" onclick="return checkDelete()">
    @csrf
    <button type="submit">削除</button>
    </form>
    </td>
    </tr>
    @endforeach
    </table>
    <script>
    function checkDelete(){
        if(window.confirm('削除してよろしいですか？')){
            return true;
        }
        else{
            return false;
        }
    }
    </script>
    
</body>
</html>