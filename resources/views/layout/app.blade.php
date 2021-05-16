<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!--Fonts-->
        <link href = "https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel = "stylesheet">

        <!--Font Awesome 4.7.0 -->
        <link href = "{{asset('include/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel = "stylesheet">

        <title>Store</title>
    </head>
    <body>
        <nav class = "navbar navbar-expand-lg navbar-light bg-light" style = "background-color: #e3f2fd;">
            <div class = "container">
                <a class = "navbar-brand" href = "#">Store</a>
                <button class = "navbar-toggler" type = "button" data-toggle = "collapse" data-target = "#navbarNav" aria-controls = "navbarNav" aria-expanded = "false" aria-label = "Toggle navigation">
                    <span class = "navbar-toggler-icon"></span>
                </button>
                <form class = "form-inline my-2 my-lg-0">
                    <div class = "collapse navbar-collapse" id = "navbarNav">
                        <ul class = "navbar-nav">
                            <li class = "nav-item active">
                                <a class = "nav-link" href = "#">
                                    <i class="fa fa-shopping-cart" aria-hidden = "true"></i> Carro de Compras</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </nav>

        <div class = "container mt-2">
            @yield('content')
        </div>

        <!--Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>