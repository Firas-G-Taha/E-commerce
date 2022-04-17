<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@700&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

   
</head>
<body>
    <header>
        <nav class="nav">
            <div class="flex-row admin-nav-content">
                <div class="logo-container">
                    <a href="/">
                    <img src="/storage/images/logo.png  " alt="Logo" class="main-logo">
                        <h1> E-Commerce</h1>
                    </a>
                </div>
                <div class="admin-second">
                    <ul class="admin-nav-list flex-row">
                        <li class="nav-list-item li-header">
                            <a href="/admin/users">Manage Users</a>
                        </li>
                        <li class="nav-list-item li-header">
                            <a href="/admin/categories">Manage Categories</a>
                        </li>
                        <li class="nav-list-item li-header">
                            <a href="/admin/subcategories">Manage Subcategories</a>
                        </li>
                        <li class="nav-list-item li-header">
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
