<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <title>COACHTECH</title>
</head>
<body>
  <div class="container">
    @yield('container')
    <div class="content">
      <h1 class="title">@yield('title')</h1>
      @yield('content')
    </div>
  </div>
</body>
</html>