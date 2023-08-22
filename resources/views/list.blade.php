<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="js/jquery.metadata.js"></script> 
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">
    <meta name="token" content="{{ csrf_token() }}">
    <title>自動販売機管理システム</title>
    <style>
        #result th{
            background-color: pink;
        }
        .sort{
        margin-right: 10px;
        }
    </style>
    <script>
        $(document).ready(function() {
        $('#result').tablesorter();
        });
    </script>

</head>

<body>


    <h2>商品詳細一覧</h2>

    @if(session('message'))
    <div class ="alert alert-success">{{ session('message') }}</div>
    @endif

    <form method="get">
  
    <div class="container">
    <input type="search" name="search" id ="search" placeholder="何か入れてください">
    <input type="button" id = "search-button" value="検索">
    </div>
    </form>
    <h3 id ="search_result"></h3>

    <select>
    <option selected>選択してください</option>
    @foreach($companies as $company)
    <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
    @endforeach
    </select><br><br>



    <form method = "get" action= "{{ route('create' )}}">
    <input type="submit" value="新規登録">
    </form>
    <br>
    <table id="result" class="table table-bordered">
    
    <thead>
        <tr>
            <th>id</th>
            <th>会社名</th>
            <th>会社id</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫</th>
            <th>コメント</th>
            <th>画像URL</th>
        </tr>
    </thead>

    @foreach($test_users as $test_user)
    <tbody>
    <tr>
    <td class="id">{{  $test_user-> id  }}</td>
    <a href="#" class="sort" data-name="id" data-sort="desc">id</a>

    
    <td class="company_name">{{  $test_user -> companies -> company_name  }}</td>
    

    <td class="company_id">{{  $test_user-> company_id  }}</td>
    <a href="#" class="sort" data-name="company_id" data-sort="desc">会社ID</a>

    <td class="product_name">{{  $test_user-> product_name  }}</td>

    <td class="price">{{  $test_user-> price  }}</td>
    <a href="#" class="sort" data-name="price" data-sort="desc">価格</a>

    <td class="stock">{{  $test_user-> stock  }}</td>
    <a href="#" class="sort" data-name="stock" data-sort="desc">在庫数</a>
    
    
    <td class="comment">{{  $test_user-> comment  }}</td>
    <td class="img_path">{{  $test_user-> img_path  }}</td>

    <td><button type="button"  onclick = "location.href ='/show/{{  $test_user-> id  }}'">詳細</button></td>

    <td>
   
    <button method = "post" data-user-id="{{  $test_user-> id  }}" class="delete" value="削除">削除</button>
   
    </td>
    </tr>
  
    </tbody>
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
       $('#search-button').on('click',function(){
        var value = $('#search').val();
        /*if($value){
            $('#result').html($output);
        }*/
        
        $.ajax({

        type:'get',
        url:'/list/search/'+ value,
        //data:{'search':value},
        dataType:'json',      
        })
        //↓フォームの送信に成功した場合の処理
        .done(function(data) {
        console.log(data);
    
        $('tr').remove();
        $.each(data.result,function(index,value){
        var html = `
        <tr>
        <td class="id">${value.id}</td>
        <td class="company_id">${value.company_id}</td>
        <td class="product_name">${value.product_name}</td>
        <td class="price">${value.price}</td>
        <td class="stock">${value.stock}</td>
        <td class="comment">${value.comment}</td>
        <td class="img_path">${value.img_path}</td>
        </tr>
        `;
        $("#result").append(html);
        console.log(value.product_name);
        })

        })

        

        
        //↓フォームの送信に失敗した場合の処理
        .fail(function(){
        alert('エラー');
        });
        })

        //ここから非同期処理削除機能
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
        });
        $(function(){
        $('.delete').on('click',function(){

            var deleteConfilm = ('削除してよろしいでしょうか？');
            var clickEle = $(this);

            var user = clickEle.attr('data-user-id');

            $.ajax({
            url:'/destroy',
            type:'POST',
            data:{'id':user},
            '_method':'DELETE'
            })

            .done(function($id){
            clickEle.parents('tr').remove();
            })

            .fail(function(){
            alert('エラーです');
            })
            })

            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            });
            $(function(){
            $('.sort').on('click',function(){

            var clickEle = $(this);

            var name = clickEle.attr('data-name');
            var sort = clickEle.attr('data-sort');
            console.log(name);
            console.log(sort);
            $.ajax({
            url:'/sort/'+name+'/'+sort,
            type:'GET',
            })

            .done(function(data){
                $('tr').remove();
        $.each(data.result,function(index,value){
        var html = `
        <tr>
        <td class="id">${value.id}</td>
        <td class="company_id">${value.company_id}</td>
        <td class="product_name">${value.product_name}</td>
        <td class="price">${value.price}</td>
        <td class="stock">${value.stock}</td>
        <td class="comment">${value.comment}</td>
        <td class="img_path">${value.img_path}</td>
        </tr>
        `;
        $("#result").append(html);
        console.log(value.product_name);
        })
            })

            .fail(function(){
            alert('エラーです');
            })
            })

        })
        })
       

 



    </script>
</body>
</html>
