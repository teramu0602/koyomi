<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    @yield('css')


    <!-- ドロップダウンのｃｓｓ-->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">  -->




</head>

<body>
    <header>
        <a class="logo" href="{{ route('calendar') }}">
            <img src="{{ asset('img/logo.jpg')}}" alt="ロゴ">
        </a>
        
        <h1 class="service-name">KOYOMI</h1>
        @guest

        @else
        <nav class="navbar">
  <!-- ハンバーガートグル -->
  <input type="checkbox" id="menu-toggle">
  <label for="menu-toggle" class="menu-icon">☰</label>

  <ul class="nav-links">
    <li>{{ Auth::user()->name }}</li>
    <li>
      <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          ログアウト
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </li>
  </ul>
</nav>

        
        @endguest

    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @yield('footer')
    </footer>

</body>

</html>