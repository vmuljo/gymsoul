<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Gym Soul Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <link rel="stylesheet" type="text/css" href="style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  <title>Home</title>
  
  <style>
    .card{background-color: #3b4352; margin: 0 auto;}
    p{text-align:center;}
  </style>
</head>
<body class="bg-dark text-white d-flex align-items-center">
  <div class="card d-flex  p-3 justify-content-center">
    <h2>Welcome to Gym Soul</h2> <!-- some title -->
    <form method="POST" action="home.html" class="d-flex flex-column">
        <div class="form-group my-3">
            <label for="email" >Email:</label>
            <input name="email" class="form-control" type="email" id="email" />
            <small id="email-error" class="invalid-feedback">Email is required.</small>
        </div>
        <div class="form-group mb-3">
            <label for="password">Password:</label>
            <input name="password" class="form-control" type="password" id="password"/>
            <small id="password-error" class="invalid-feedback">Password is required.</small>
          </div>
        
        <button type="submit" class="btn btn-primary my-3">Log in</button>
        <p class="my-2">Don't have an account? <a href="signup.html">Sign up here.</a></p>
    </form>
  </div>
  <script src="login.js" ></script>
</body>
</html>