@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Для работы с Комментариями добавьте следующий код на преленд:<br />
                    <code>
                    &lt;div id=&quot;push-comments&quot;&gt;&lt;/div&gt; 
                    </code> <br>
                    <code>
                    &lt;script src=&quot;https://com.devtizer.ru/js/commets.js&quot;&gt;&lt;/script&gt;
                    </code>
                </div>
                <div class="card-header">Комментарии</div>
                <!-- <pre>{ dd(get_defined_vars()) }}</pre> -->
                <div class="card-body">
                    <div id="comments"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection