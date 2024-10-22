@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        *, *:before, *:after {
            box-sizing: border-box;
        }

        :root {
            --white: #fff;
            --black: #000;
            --bg: #f8f8f8;
            --grey: #999;
            --dark: #1a1a1a;
            --light: #e6e6e6;
            --wrapper: 1000px;
            --blue: #00b0ff;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 400;
            background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/image.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .wrapper {
            position: relative;
            left: 50%;
            width: var(--wrapper);
            height: 800px;
            transform: translate(-50%, 0);
        }

        .container {
            position: relative;
            top: 50%;
            left: 50%;
            width: 80%;
            height: 75%;
            background-color: var(--white);
            transform: translate(-50%, -50%);
        }

        .left {
            float: left;
            width: 37.6%;
            height: 100%;
            border: 1px solid var(--light);
            background-color: var(--white);
        }

        .left .top {
            position: relative;
            width: 100%;
            height: 96px;
            padding: 29px;
        }

        .left .top:after {
            position: absolute;
            bottom: 0;
            left: 50%;
            display: block;
            width: 80%;
            height: 1px;
            content: '';
            background-color: var(--light);
            transform: translate(-50%, 0);
        }

        .left input {
            float: left;
            width: 188px;
            height: 42px;
            padding: 0 15px;
            border: 1px solid var(--light);
            background-color: #eceff1;
            border-radius: 21px;
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 400;
        }

        .left input:focus {
            outline: none;
        }

        .left a.search {
            display: block;
            float: left;
            width: 42px;
            height: 42px;
            margin-left: 10px;
            border: 1px solid var(--light);
            background-color: var(--blue);
            background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/name-type.png');
            background-repeat: no-repeat;
            background-position: top 12px left 14px;
            border-radius: 50%;
        }

        .people {
            margin-left: -1px;
            border-right: 1px solid var(--light);
            border-left: 1px solid var(--light);
            width: calc(100% + 2px);
        }

        .person {
            position: relative;
            width: 100%;
            padding: 12px 10% 16px;
            cursor: pointer;
            background-color: var(--white);
        }

        .person:after {
            position: absolute;
            bottom: 0;
            left: 50%;
            display: block;
            width: 80%;
            height: 1px;
            content: '';
            background-color: var(--light);
            transform: translate(-50%, 0);
        }

        .person img {
            float: left;
            width: 40px;
            height: 40px;
            margin-right: 12px;
            border-radius: 50%;
            object-fit: cover;
        }

        .person .name {
            font-size: 14px;
            line-height: 22px;
            color: var(--dark);
        }

        .right {
            float: right;
            width: 62.4%;
            height: 100%;
        }

        .right .top {
            position: relative;
            width: 100%;
            height: 96px;
            padding: 29px;
            background-color: var(--white);
            border-bottom: 1px solid var(--light);
        }

        .right .top .name {
            font-size: 22px;
            line-height: 38px;
            color: var(--dark);
        }

        .messages {
            width: 100%;
            height: calc(100% - 185px);
            overflow-y: auto;
            background-color: #eceff1;
            padding: 12px;
            display: flex;
            flex-direction: column;
        }

        .message {
            margin-bottom: 12px;
            width: 100%;
            display: flex;
            align-items: flex-start;
        }

        .message p {
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            line-height: 20px;
            color: var(--white);
            font-weight: 400;
        }

        .message .left p {
            background-color: var(--blue);
            margin-right: auto;
        }

        .message .right p {
            background-color: var(--dark);
            margin-left: auto;
        }

        .bottom {
            padding: 20px 10px;
            background-color: var(--white);
            border-top: 1px solid var(--light);
        }

        .bottom input {
            width: 88%;
            height: 42px;
            padding: 0 15px;
            border: 1px solid var(--light);
            background-color: #eceff1;
            border-radius: 21px;
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 400;
        }

        .bottom input:focus {
            outline: none;
        }

        .bottom a.send {
            display: inline-block;
            width: 42px;
            height: 42px;
            margin-left: 10px;
            border: 1px solid var(--light);
            background-color: var(--blue);
            border-radius: 50%;
            background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/send.png');
            background-repeat: no-repeat;
            background-position: top 12px left 14px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="left">
            <div class="top">
                <input type="text" id="search" placeholder="Поиск" />
                <a href="#" class="search"></a>
            </div>
            <div class="people">
                @foreach($users as $user)
                    <div class="person" data-id="{{ $user->id }}">
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}">
                        <div class="name">{{ $user->name }}</div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="right">
            <div class="top">
                <div class="name" id="chatName">Выберите пользователя для чата</div>
            </div>
            <div class="messages" id="messages"></div>
            <div class="bottom">
                <input type="text" id="message" placeholder="Введите ваше сообщение" />
                <a href="#" class="send"></a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.person').on('click', function() {
            const chatId = $(this).data('id');
            $('#chatName').text($(this).find('.name').text());
            loadMessages(chatId);
        });

        $('.send').on('click', function(e) {
            e.preventDefault();
            const message = $('#message').val();
            const recipientId = $('.person.selected').data('id'); // Предполагается, что у вас есть логика для выбора получателя
            sendMessage(message, recipientId);
        });

        function loadMessages(chatId) {
            axios.get(`/chat/${chatId}/messages`)
                .then(response => {
                    const messages = response.data.messages;
                    $('#messages').empty();
                    messages.forEach(msg => {
                        const msgElement = `
                                <div class="message ${msg.user_id === {{ Auth::id() }} ? 'right' : 'left'}">
                                    <p>${msg.message}</p>
                                </div>
                            `;
                        $('#messages').append(msgElement);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function sendMessage(message, recipientId) {
            axios.post('/chat/send', {
                message: message,
                recipient_id: recipientId
            })
                .then(response => {
                    $('#message').val('');
                    loadMessages(recipientId);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>
</body>
</html>
