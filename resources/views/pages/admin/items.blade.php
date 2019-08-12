@extends('layouts.app')

@section('content')
<form action="{{ route('items.store') }}" id="form_product" method="POST" class="container navbar-laravel">
    @method('POST')
    @csrf
    <br>
    <div class="row">
        <div class="col-4"><input type="text" class="w-100" name="name" placeholder="Наименование"></div>
        <div class="col-4"><input type="text" class="w-100" name="price" placeholder="Себестоимость товара" min="1" max="1000"></div>
        <div class="col-4"><input type="text" class="w-100" name="price_lid" placeholder="Стоимость лида" min="1" max="1000"></div>
        <div class="col-3"><input type="text" class="w-100" name="cost_email" placeholder="Расходы на почту" min="1" max="1000"></div>
        <div class="col-3"><input type="text" class="w-100" name="cost_sends" placeholder="Расходы на упаковку и отправку" min="1" max="1000"></div>
        <div class="col-3"><input type="text" class="w-100" name="approve" placeholder="Необходимый уровень аппрува" min="1" max="100"></div>
        <div class="col-3"><input type="text" class="w-100" name="buyout" placeholder="Выкуп" min="1" max="100"></div>
    </div>
    <div class="row">
        <div class="col-12" style="margin-bottom: 20px">
            <div id="form_product_info" class="float-right">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 92 92" width="20px" height="20px" style="enable-background:new 0 0 92 92;" xml:space="preserve">
                    <path style="fill:#6cb2eb;" d="M45.386,0.004C19.983,0.344-0.333,21.215,0.005,46.619c0.34,25.393,21.209,45.715,46.611,45.377
                        c25.398-0.342,45.718-21.213,45.38-46.615C91.656,19.986,70.786-0.335,45.386,0.004z M45.25,74l-0.254-0.004
                        c-3.912-0.116-6.67-2.998-6.559-6.852c0.109-3.788,2.934-6.538,6.717-6.538l0.227,0.004c4.021,0.119,6.748,2.972,6.635,6.937
                        C51.904,71.346,49.123,74,45.25,74z M61.705,41.341c-0.92,1.307-2.943,2.93-5.492,4.916l-2.807,1.938
                        c-1.541,1.198-2.471,2.325-2.82,3.434c-0.275,0.873-0.41,1.104-0.434,2.88l-0.004,0.451H39.43l0.031-0.907
                        c0.131-3.728,0.223-5.921,1.768-7.733c2.424-2.846,7.771-6.289,7.998-6.435c0.766-0.577,1.412-1.234,1.893-1.936
                        c1.125-1.551,1.623-2.772,1.623-3.972c0-1.665-0.494-3.205-1.471-4.576c-0.939-1.323-2.723-1.993-5.303-1.993
                        c-2.559,0-4.311,0.812-5.359,2.478c-1.078,1.713-1.623,3.512-1.623,5.35v0.457H27.936l0.02-0.477
                        c0.285-6.769,2.701-11.643,7.178-14.487C37.947,18.918,41.447,18,45.531,18c5.346,0,9.859,1.299,13.412,3.861
                        c3.6,2.596,5.426,6.484,5.426,11.556C64.369,36.254,63.473,38.919,61.705,41.341z"/>
                </svg>
                <div class="form_product_info--helper">
                    - себестоимость товара (от 1 до 1000) <br />
                    - стоимость лида (от 1 до 10000) <br />
                    - расходы на почту (от 1 до 1000) <br />
                    - расходы на упаковку и отправку (от 1 до 1000) <br />
                    - необходимый уровень аппрува (от 1 до 100) <br />
                    - выкуп (от 1 до 100)
                </div>
            </div>
            <button type="submit" id="add_product" class="btn bg-success float-right text-white">Добавить</button>
        </div>
    </div>
</form>
<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col">
            <table class="table">
                <thead class="thead-dark table__thead--small">
                    <tr>
                        <th>ИД</th>
                        <th>Наименование</th>
                        <th>Стоимость товара</th>
                        <th>Стоимость лида</th>
                        <th>Расходы на почту</th>
                        <th>Расходы на<br>упаковку и отправку</th>
                        <th>Аппрув</th>
                        <th>Выкуп</th>
                        <th>Дата создания</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach( $items as $post )
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->price }}</td>
                        <td>{{ $post->price_lid }}</td>
                        <td>{{ $post->cost_email }}</td>
                        <td>{{ $post->cost_sends }}</td>
                        <td>{{ $post->approve }}</td>
                        <td>{{ $post->buyout }}</td>
                        <td>{{ date("d.m.Y", strtotime($post->created_at)) }}</td>
                        <td>
                            <nobr>
                            <a href="{{ url('items/'.$post->id)}}" class="btn bg-info text-white" title="Редактировать" >
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="20px" height="20px">
                                    <path d="M352.459,220c0-11.046-8.954-20-20-20h-206c-11.046,0-20,8.954-20,20s8.954,20,20,20h206     C343.505,240,352.459,231.046,352.459,220z" fill="#FFFFFF"/>
                                    <path d="M126.459,280c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20H251.57c11.046,0,20-8.954,20-20c0-11.046-8.954-20-20-20     H126.459z" fill="#FFFFFF"/>
                                    <path d="M173.459,472H106.57c-22.056,0-40-17.944-40-40V80c0-22.056,17.944-40,40-40h245.889c22.056,0,40,17.944,40,40v123     c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V80c0-44.112-35.888-80-80-80H106.57c-44.112,0-80,35.888-80,80v352     c0,44.112,35.888,80,80,80h66.889c11.046,0,20-8.954,20-20C193.459,480.954,184.505,472,173.459,472z" fill="#FFFFFF"/>
                                    <path d="M467.884,289.572c-23.394-23.394-61.458-23.395-84.837-0.016l-109.803,109.56c-2.332,2.327-4.052,5.193-5.01,8.345     l-23.913,78.725c-2.12,6.98-0.273,14.559,4.821,19.78c3.816,3.911,9,6.034,14.317,6.034c1.779,0,3.575-0.238,5.338-0.727     l80.725-22.361c3.322-0.92,6.35-2.683,8.79-5.119l109.573-109.367C491.279,351.032,491.279,312.968,467.884,289.572z      M333.776,451.768l-40.612,11.25l11.885-39.129l74.089-73.925l28.29,28.29L333.776,451.768z M439.615,346.13l-3.875,3.867     l-28.285-28.285l3.862-3.854c7.798-7.798,20.486-7.798,28.284,0C447.399,325.656,447.399,338.344,439.615,346.13z" fill="#FFFFFF"/>
                                    <path d="M332.459,120h-206c-11.046,0-20,8.954-20,20s8.954,20,20,20h206c11.046,0,20-8.954,20-20S343.505,120,332.459,120z" fill="#FFFFFF"/>
                                </svg>
                            </a>
                            <button class="btn bg-danger text-white form_product--delete" data-id="{{ $post->id }}" title="удалить">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 774.266 774.266" style="enable-background:new 0 0 774.266 774.266;" xml:space="preserve">
                                    <path d="M640.35,91.169H536.971V23.991C536.971,10.469,526.064,0,512.543,0c-1.312,0-2.187,0.438-2.614,0.875    C509.491,0.438,508.616,0,508.179,0H265.212h-1.74h-1.75c-13.521,0-23.99,10.469-23.99,23.991v67.179H133.916    c-29.667,0-52.783,23.116-52.783,52.783v38.387v47.981h45.803v491.6c0,29.668,22.679,52.346,52.346,52.346h415.703    c29.667,0,52.782-22.678,52.782-52.346v-491.6h45.366v-47.981v-38.387C693.133,114.286,670.008,91.169,640.35,91.169z     M285.713,47.981h202.84v43.188h-202.84V47.981z M599.349,721.922c0,3.061-1.312,4.363-4.364,4.363H179.282    c-3.052,0-4.364-1.303-4.364-4.363V230.32h424.431V721.922z M644.715,182.339H129.551v-38.387c0-3.053,1.312-4.802,4.364-4.802    H640.35c3.053,0,4.365,1.749,4.365,4.802V182.339z" fill="#FFFFFF"/>
                                    <rect x="475.031" y="286.593" width="48.418" height="396.942" fill="#FFFFFF"/>
                                    <rect x="363.361" y="286.593" width="48.418" height="396.942" fill="#FFFFFF"/>
                                    <rect x="251.69" y="286.593" width="48.418" height="396.942" fill="#FFFFFF"/>
                                </svg>
                            </button>
                            </nobr>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>  
        </div>
    </div>
    {{ $items->links() }}
</div>
@endsection
