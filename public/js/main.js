$(document).ready(()=>{
    $(".form_product--delete").click(function(event) {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).data('id');id;
        if(confirm(`Вы уверены что хотите запись ${id}?`) == false) return; 
        $.ajax({
            type      : 'delete',
            url       : `/items/${id}`, //Your form processing file URL
            success   : function() {
                alert('Данные успешно сохранены!')
                document.location.href = location
            },
            error     : function(e){
                console.log(e);
            }
        });
        event.preventDefault();
    });
    $("#add_product").click((event) => {
        var method = $('#form_product input[name=_method]').val()
        var postForm = { //Fetch form data
            '_token'    : $('#form_product input[name=_token]').val(),
            'name'      : $('#form_product input[name="name"]').val(),
            'price'     : $('#form_product input[name="price"]').val(),
            'price_lid' : $('#form_product input[name="price_lid"]').val(),
            'cost_email': $('#form_product input[name="cost_email"]').val(),
            'cost_sends': $('#form_product input[name="cost_sends"]').val(),
            'approve'   : $('#form_product input[name="approve"]').val(),
            'buyout'    : $('#form_product input[name="buyout"]').val(),
        };
        
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type      : method,
            url       : $('#form_product').attr('action'), //Your form processing file URL
            data      : postForm, //Forms name
            dataType  : 'json',
            success   : function() {
                alert('Данные успешно сохранены!')
                document.location.href = location
            },
            error     : function(e){
                let trulala = 'Следующие поля заполнены неверно: \n';
                for(name in e.responseJSON.errors){
                    trulala = trulala+e.responseJSON.errors[name]+'\n'
                }
                alert(trulala)
            }
        });
        event.preventDefault();
    });

    // разрешаем выводить данные
    var block = true;
    //номер страницы для вывода
    var page = 0;
    // скроллинг
    
    var LoadComments = ()=>{
        block = false
        page++;
        $.ajax({
            url: '/api/comments?page=' + page,
            dataType: 'json',
        }).done((response) => {
            let arr = []
            response.data.map((item) => {
                arr.push(item);
            });

            if (arr.length > 0) block = true;

            for (var i = 0; i < arr.length; i++) {
                let comment = ''
                for (var j = 0; j < arr[i].comments.length; j++) {
                    comment = comment + `<li>${arr[i].comments[j].text}</li>`
                }
                let row = `<div class='comment-item'>
                    <div class='comment-item__body'>
                        <span class='comment-item__body__count'>${arr[i].count}</span> => <a href="//${arr[i].url}" class="comment-item__body__site">${arr[i].url}</a>
                        <button class="comments-item__btn">Посмотреть комментарии</button>
                    </div>
                    <div class='comment-item__text'>
                        <ol>
                            ${comment}
                        </ol>
                    </div>
                </div>`
                $('#comments').append(row);
            }
        });
    }

    LoadComments()

    $('#comments').on('click', '.comments-item__btn', function(e){
        e.preventDefault()
        $(this).parent().next().toggleClass('active')
    });

    $(window).scroll(() => {
        // подгружаю, если есть что подгружать
        if ($(window).height() + $(window).scrollTop() >= $(document).height() && block) {
            LoadComments()
        }
    });
});