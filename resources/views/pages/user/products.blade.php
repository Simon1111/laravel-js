@extends('layouts.app')

@section('content')
<div class="container navbar-laravel">
    <br>
    <h1>Расчёт прибыли с лида</h1>
    <div class="row justify-content-center">
        <div class="col">
            <p>Прибыль с лида = ( (ср.чек * выкуп - 'расход на упаковку и отправку' - 'расходы на почту' - 'себестоимость товара' - 'прочие расходы') * 0.9 - 'необходимый уровень аппрува' / 'аппрув по оператору' * 'стоимость лида' ) * 0.2%</p>
            <table class="table" id="users__table">
                <thead class="thead-dark">
                    <tr>
                        <th width=100>ИД</th>
                        <th width=170>Наименование</th>
                        <th width=170>Средний чек*</th>
                        <th width=170>Аппрув по оператору*</th>
                        <th width=170>Прочие расходы</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach( $items as $post )
                    <tr id="users__table--line{{$post->id}}">
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->name }}</td>
                        <td><input type="text" class="users__table--input" name="middle_check_{{ $post->id }}" value="0"></td>
                        <td><input type="text" class="users__table--input" name="approve_oper_{{ $post->id }}" value="0"></td>
                        <td><input type="text" class="users__table--input" name="add_{{ $post->id }}" value="0"></td>
                        <td class="users__table--left"><button class="btn bg-info text-white" data-id="{{ $post->id }}">Расчёт</button> = <span id="calk_result_{{ $post->id }}">0</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>  
        </div>
    </div>
    {{ $items->links() }}
    <br>
</div>
<script>
    $("#users__table button").click(function(event) {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).data('id')
        var check = $(`input[name='middle_check_${id}']`).val();
        var approve = $(`input[name='approve_oper_${id}']`).val();
        var add = $(`input[name='add_${id}']`).val();
        $.ajax({
            type      : 'POST',
            url       : `/calc/${id}`, //Your form processing file URL
            data      : {'check':check,'approve':approve,'add':add}, //Forms name
            dataType  : 'json',
            success   : function(msg) {
                $(`#calk_result_${id}`).html(msg.result)
            },
            error     : function(e){
                console.log(e);
            }
        });
        event.preventDefault();
    });
</script>
@endsection
