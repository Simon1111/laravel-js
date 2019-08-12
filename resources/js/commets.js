/**
 * * Для работы скрипта необходимо добавить код нужную секцию 
 *   
 *   <div id="${randomID}"></div>
 *	 <script src="< path_to >/formcomment.js"></script>
 * */
(function () {
    "use strict"

    // form => возможно расписать по массиву
    let randomID = (function randomInteger(min = 6, max = 12) {
        let rand = min + Math.random() * (max - min)
        rand = Math.round(rand)
        var cba = "abcdefghijklmnopqrstuvwxyz1234567890";
        var str = "";
        while (str.length < rand) {
            str += cba[Math.floor(Math.random() * cba.length)];
        }
        return 'push_' + str
    })() // создаю рандомный id

    let style = `
     #push-comments #${randomID} {
        background-color: #f0f0f0;
        box-sizing: border-box;
        font-family: Arial, serif;
        padding: 3rem 2rem;
        transition: 1s;
        width: 100%;
    }

    #push-comments #${randomID}.hide{
        opacity: 0;
        display: block !important;
    }

    #push-comments #${randomID}__form {
        box-sizing: border-box;
        margin: auto;
        max-width: 600px;
    }

    #push-comments #${randomID}__title {
        color: #43A047;
        border-bottom: 0px solid;
        box-shadow: 1px 4px 10px -7px #ccc;
        display: inline-block;
        font-size: 24px;
        font-weight: bold;
        line-height: 20px;
        margin-top: 0;
        margin-bottom: 16px;
    }

    #push-comments #${randomID}__message {
        border: 1px solid #43A047;
        box-shadow: 0px 2px 4px -3px #237a27;
        font-size: 16px;
        box-sizing: border-box;
        padding: 10px 20px;
        height: 120px;
        width: 100%;
    }

    #push-comments #${randomID}__submit {
        background: #43A047;
        border: none;
        box-shadow: 0px 2px 4px -3px #000;
        color: #fff;
        cursor: pointer;
        border-radius: 25px;
        display: table;
        margin: 20px 0 0;
        height: 50px;
        transition: .5s;
        text-align: center;
        text-shadow: 0px 0px 1px #237a27;
        font-size: 18px;
        max-width: 280px;
        width: 100%;
    }

    #push-comments #${randomID}__submit:hover {
        background: #237a27;
        text-shadow: none;
        box-shadow: none;
    }

    #push-comments #${randomID}__label::before,
    #push-comments #${randomID}__label::after {
        content: '';
        display: none;
    }`

    var sendMessage = (e, id_form = randomID) => {
        e.preventDefault()

        let request = new XMLHttpRequest();
        let url = window.location.hostname // получаю url
        let message = document.querySelector(`#${id_form}__message`).value
        let body = `text=${encodeURIComponent(message)}&url=${encodeURIComponent(url)}`

        request.open("POST", "http://127.0.0.1:8000/add-comment", true); // куда отправляю

        // debugger
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(body); // то что отправляю 

        // if (!request.responseText) return;

        alert(`Ваш комментарий отправлен на модерацию`)

        document.querySelector(`#push-comments #${id_form}`).classList.add('hide')

        function removeFunc() {
            document.querySelector(`#${id_form}`).remove()
        }

        setTimeout(removeFunc, 1000);
    }

    const form = `<div id="${randomID}">
        <style>${style}</style>
        <form action="/" id="${randomID}__form" method="POST">
            <h3 id="${randomID}__title">Оставить комментарий</h3>
            <textarea name="message" cols="30" rows="10" id="${randomID}__message" placeholder="Ваш комментарий"></textarea>
            <input type="submit" value="Отправить" id="${randomID}__submit">
        </form>
    </div>`

    document.getElementById('push-comments').innerHTML = form
    document.getElementById(`${randomID}__submit`).addEventListener("click", sendMessage, false)
})();