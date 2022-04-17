<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   
</head>
<body>
    <header>
        <nav class="nav">
            <div class="flex-row nav-content">
                <div class="logo-container">
                    <a href="/">
                        <img src="/storage/images/logo.png  " alt="Logo" class="main-logo">
                        <h1> E-Commerce</h1>
                    </a>
                </div>
                <div class="second flex-row">
                    <div class="search">
                        <input 
                        type="text"
                         name="search" 
                         id="search" 
                         placeholder="Search . . ."
                         class="text-input">
                    </div>
                    
                    <ul class="nav-list flex-row">
                        <li class="nav-list-item dropdown">
                            <a href="/categories">CATEGORIES</a>
                            <div class="dropdown-content">
                                @foreach ($importantCategories as $category)
                                    <a href="/category/{{ $category->id }}" class="drop-down-item">{{ $category->title }}</a>
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-list-item"><a href="#">ABOUT US</a></li>
                        <li class="nav-list-item li-cart">
                            <a href="/customers/Cart" class="a-cart">
                                <i class="fa fa-shopping-cart" style="font-size:40px"></i>
                                @if ($productsInCart  != 0)
                                <div class="products-in-cart"> 
                                    <p>{{ $productsInCart }}</p>     
                                </div>
                                @endif
                            </a>
                        </li>
                    </ul>
                    <div class="logout">
                        @auth
                        <a href="/logout">Logout</a>
                        @endauth
                        @guest
                        <a href="/login">Login</a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

    </header>
    <main>
        @yield('content')
    </main>

    <script>
        $(document).ready(function(){
        $('#search').on('keyup', function (e) {


            if (e.keyCode == 13 && $(this).val() != '') {
            window.location.href = '/search?search=' + $('#search').val();
            } 
        });
        
    });
</script>
<footer>
    <p>Made by Firas taha&#169;</p>
</footer>
</body>

</html>
