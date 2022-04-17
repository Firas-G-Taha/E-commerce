<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
   
</head>
<body>
    <header>
        <nav class="nav">
            <div class="flex-row admin-nav-content">
                <div class="logo-container">
                    <a href="/">
                        <img src="/storage/logo.png  " alt="Logo" class="main-logo">
                        <h1> E-Commerce</h1>
                    </a>
                </div>
                <div class="admin-second">
                    <ul class="admin-nav-list flex-row">
                        <li class="nav-list-item dropdown">
                            <a href="/admin/users">Manage Users</a>
                        </li>
                        <li class="nav-list-item">
                            <a href="/admin/categories">Manage Categories</a>
                        </li>
                        <li class="nav-list-item">
                            <a href="/admin/subcategories">Manage Subcategories</a>
                        </li>
                        <li class="nav-list-item">
                            <a href="/admin/products">Manage Products</a>
                        </li>
                    </ul>
                    <a href="/logout" class="logout">Logout</a>
                </div>
            </div>
        </nav>

    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>Made by Firas taha&#169;</p>
    </footer>
</body>
</html>