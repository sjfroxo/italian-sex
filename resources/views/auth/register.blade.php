<form method="POST" action="{{ route('register.user') }}">
    @csrf
    @method('POST')
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="name">
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="email">
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="id">
    </div>

    <div>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="password_confirmation">
    </div>

    <button type="submit">Register</button>
</form>
