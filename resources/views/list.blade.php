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
    }
    </script>
    
</body>
</html>
