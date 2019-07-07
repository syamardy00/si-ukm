<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <form method="POST" action="{{route('login')}}">
      {{ csrf_field() }}
      <input type="text" name="username" placeholder="username">
      <br>
      <input type="password" name="password" placeholder="password">
      <br>
      <input type="submit" value="Login">
    </form>
  </body>
</html>
