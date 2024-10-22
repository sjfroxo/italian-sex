<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<div id="chat-container">
    <div id="chat-header">
        <h3>Чат с участниками</h3>
        <div id="chat-members">
            <!-- Здесь будут отображаться имена участников чата -->
            @foreach($chat->users as $user)
                <span>{{ $user->name }}</span>
            @endforeach
        </div>
    </div>
    <div id="chat-messages" style="border: 1px solid #ccc; height: 400px; overflow-y: scroll;">
        <h1>Chat #{{ $chat->id }}</h1>
        @foreach($chat->messages as $message)
            <div class="message">
                <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
            </div>
        @endforeach
    </div>
    <div id="chat-input">
        <input type="text" id="message" placeholder="Введите сообщение..." />
        <button id="send-message">Отправить</button>
    </div>
</div>

<script>
    // Функция для обновления сообщений
    function loadMessages() {
        const chatId = {{ $chat->id }};
        axios.get(`/chat/${chatId}/messages`)
            .then(response => {
                const messages = response.data;
                const chatMessages = document.getElementById('chat-messages');
                chatMessages.innerHTML = ''; // Очищаем старые сообщения

                messages.forEach(function (message) {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message');
                    messageElement.innerHTML = `<strong>${message.user.name}:</strong> ${message.message}`;
                    chatMessages.appendChild(messageElement);
                });
                chatMessages.scrollTop = chatMessages.scrollHeight; // Прокручиваем вниз
            })
            .catch(error => {
                console.error('Ошибка загрузки сообщений:', error);
            });
    }

    // Загрузка сообщений раз в несколько секунд
    setInterval(loadMessages, 5000);

    // Отправка сообщения
    document.getElementById('send-message').addEventListener('click', function () {
        const message = document.getElementById('message').value;
        const chatId = {{ $chat->id }};

        if (message.trim() !== '') {
            axios.post(`/chat/${chatId}/send`, { message: message })
                .then(() => {
                    document.getElementById('message').value = ''; // Очищаем поле ввода
                    loadMessages(); // Обновляем список сообщений
                })
                .catch(error => {
                    console.error('Ошибка отправки сообщения:', error);
                });
        }
    });

    // Инициализация начальной загрузки сообщений
    loadMessages();
</script>
</body>
</html>
