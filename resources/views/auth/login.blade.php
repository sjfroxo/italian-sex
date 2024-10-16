<form method="POST" action="{{ route('login.user') }}">
    @csrf
    @method('POST')
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="email">
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="password">
    </div>

    <button type="submit">Login</button>
    <label for="">
        <input type="checkbox" name="remember" value="remember">Запомнить меня
    </label>
</form>
