<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cube Summation</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,600" rel="stylesheet" type="text/css">

    <style>
      * {
        padding: 0;
        margin: 0;
      }
      html, body {
        background-color: #fff;
        color: black;
        font-family: 'Raleway', sans-serif;
        font-weight: 300;
        font-size: 18px;
        height: 100vh;
        margin: 0;
      }
      header {
        text-align: center;
        font-size: 84px;
        padding: 30px 0;
        font-weight: 600;
      }
      .content {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
      }
      .flex-center {
          align-items: center;
          display: flex;
          justify-content: center;
      }
    </style>
    @yield('styles')
  </head>
  <body>
    <header>
      Cube Summation
    </header>
    <section class="content flex-center">
      @yield('content')
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @yield('scripts')
  </body>
</html>
