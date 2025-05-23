{{-- resources/views/profile/landingpage.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .header {
            background-image: url('https://via.placeholder.com/1600x600');
            background-size: cover;
            padding: 100px 50px;
            text-align: center;
            color: white;
        }
        .header h1 {
            font-size: 3em;
            margin: 0;
        }
        .header p {
            font-size: 1.2em;
            margin-top: 20px;
        }
        .auth-links {
            margin-top: 20px;
        }
        .auth-links a {
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            color: white;
            border-radius: 5px;
            background-color: #f76c6c;
            font-size: 1.2em;
        }
        .auth-links a:hover {
            background-color: #d64e4e;
        }
        .categories {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
        .category {
            text-align: center;
            margin: 0 20px;
            max-width: 300px;
        }
        .category img {
            width: 100%;
            border-radius: 10px;
        }
        .category h3 {
            margin-top: 15px;
            font-size: 1.5em;
        }
        .popular-articles {
            margin-top: 50px;
            text-align: center;
        }
        .popular-articles h2 {
            font-size: 2em;
            margin-bottom: 30px;
        }
        .popular-articles .article {
            margin-bottom: 20px;
        }
        .newsletter {
            background-color: #333;
            padding: 50px 0;
            color: white;
            text-align: center;
        }
        .newsletter input {
            padding: 10px;
            font-size: 1em;
            width: 300px;
            margin-right: 20px;
            border: none;
            border-radius: 5px;
        }
        .newsletter button {
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            background-color: #f76c6c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Conquer the wild: Exploring terrains and conquering nature</h1>
        <p>Learn about the challenges of exploring remote terrains and overcoming the forces of nature.</p>
        <div class="auth-links">
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Register</a>
        </div>
    </div>

    <div class="categories">
        <div class="category">
            <img src="https://via.placeholder.com/400x300" alt="Travel">
            <h3>Travel</h3>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/400x300" alt="Adventure">
            <h3>Adventure</h3>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/400x300" alt="Gear">
            <h3>Gear</h3>
        </div>
    </div>

    <div class="popular-articles">
        <h2>Popular now</h2>
        <div class="article">
            <h3><a href="#">Unveiling hidden gems: Exploring off-the-beaten-path destinations</a></h3>
            <p><small>Sept 1, 2023</small></p>
        </div>
        <div class="article">
            <h3><a href="#">Conquer the wild: Exploring terrains and conquering nature</a></h3>
            <p><small>Sept 1, 2023</small></p>
        </div>
        <div class="article">
            <h3><a href="#">Gear up for adventure: Equipment for outdoor enthusiasts</a></h3>
            <p><small>Sept 1, 2023</small></p>
        </div>
    </div>

    <div class="newsletter">
        <h2>Subscribe to our newsletter</h2>
        <p>Receive our daily news</p>
        <input type="email" placeholder="Enter your email">
        <button>Subscribe</button>
    </div>
</body>
</html>
