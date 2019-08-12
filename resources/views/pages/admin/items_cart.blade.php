@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form method="post" id="form_product" action="{{ route('items.update', $item->id) }}" class="col-12">
                @method('PUT')
                @csrf
                <h2>Публикация от <span class="text-primary">{{date_format($item->created_at,"d.m.Y")}}</span></h2>
                <hr>
                <br>
                <p><span class="edit-item">Имя: </span> <input type="text" name="name" value="{{$item->name }}" /></p>
                <p><span class="edit-item">Cебестоимость товара: </span> <input type="text" name="price" value="{{$item->price }}" /></p>
                <p><span class="edit-item">Cтоимость лида: </span> <input type="text" name="price_lid" value="{{$item->price_lid }}" /></p>
                <p><span class="edit-item">Расходы на почту: </span> <input type="text" name="cost_email" value="{{$item->cost_email }}" /></p>
                <p><span class="edit-item">Расходы на упаковку и отправку: </span> <input type="text" name="cost_sends" value="{{$item->cost_sends }}" /></p>
                <p><span class="edit-item">Необходимый уровень аппрува: </span> <input type="text" name="approve" value="{{$item->approve }}" /></p>
                <p><span class="edit-item">Выкуп: </span> <input type="text" name="buyout" value="{{$item->buyout }}" /></p>
                <button type="submit" class="btn bg-success text-white" id="add_product">Сохранить</button>
            </form>
        </div>
    </div>
@endsection