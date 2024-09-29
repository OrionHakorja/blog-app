<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Frontpage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px 0;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 24px;
        }

        nav ul {
            list-style: none;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav ul li a,
        nav ul li form {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        nav ul li a:hover,
        nav ul li form:hover {
            background-color: #555;
        }

        nav ul li form button {
            background-color: transparent;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .search-form {
            display: inline-block;
        }

        .search-form input[type="text"] {
            padding: 5px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        .search-form button {
            padding: 5px 10px;
            background-color: #555;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .blog-list {
            padding: 40px 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .blogs {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .blog-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            width: 30%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .blog-card:hover {
            transform: scale(1.05);
        }

        .blog-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .blog-info {
            padding: 20px;
        }

        .blog-info h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .blog-info p {
            margin-bottom: 10px;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 40px;
        }
        .pagination-custom nav {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-custom ul {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .pagination-custom li {
            margin: 0 5px;
        }

        .pagination-custom a, .pagination-custom span {
            display: block;
            padding: 8px 16px;
            color: #333;
            background-color: #f1f1f1;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .pagination-custom a:hover {
            background-color: #333;
            color: white;
        }

        .pagination-custom .active span {
            background-color: #333;
            color: white;
            cursor: default;
        }
        /* Delete button */
        .button-container button {
            background-color: #dc3545;
            color: white;
        }

        .button-container button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <h1>Admin Frontpage</h1>
        <nav>
            <ul>
                <li><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li>
                  <form method="POST" action="{{route('logout')}}">
                      @csrf
                      <button>LOGOUT</button>
                  </form>
              </li>
                <form action="{{route('blogs.search2')}}" method="GET" class="search-form">
                    @csrf
                    <input type="text" name="search" placeholder="Search blogs...">
                    <button type="submit">Search</button>
                </form>
            </ul>
        </nav>
    </div>
</header>

<!-- Main Content -->
<main class="blog-list">
    <div class="container">
        <h2>All Blogs</h2>
        <div class="blogs">
            <!-- Repeat this block for each blog post dynamically -->
            @foreach($blogs as $blog)
                <div class="blog-card">
                    <div class="blog-info">
                        <h3>{{$blog->name}}</h3>
                        <p>{{$blog->description}}</p>
                        <p>By: {{ $blog->users ? $blog->users->name : 'Unknown Author' }}</p>
                        <p>Published on: {{$blog->date_posted}}</p>
                    </div>
                    <div class="button-container">
                        <form method="POST" action="{{route('admin.delete', $blog->id)}}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="display: inline-block; padding: 10px 20px; font-size: 1rem; font-weight: 600; text-align: center; text-decoration: none; border-radius: 5px; border: none; cursor: pointer; background-color: #dc3545; color: white; transition: background-color 0.3s ease;">
                                DELETE
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
            <!-- End of blog block -->
        </div>
        <div class="pagination-custom">
            {{ $blogs->links() }}
        </div>
    </div>
</main>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2024 My Blog. All rights reserved.</p>
    </div>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>
