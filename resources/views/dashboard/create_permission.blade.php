<form action="/create-permission" method="post">
    @csrf
    <input type="text" placeholder="name" name="name">
    <input type="text" placeholder="parent" name="parent">
    <input type="text" placeholder="type" name="type">
    <button type="submit">save</button>
</form>
