<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>

<body class="bg-dark text-light">
<div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="text-center">
        <div class="card text-light card bg-secondary">
            <div class="card-body text-center">
                <h2>Log in to E-COMMERCE</h2>
                <form action="../actions/login.php" method="post">
                    <div class="mb-3 text-start">
                        <label for="Email" class="form-label">Email address</label>
                        <input type="email" id="email" name="email" required placeholder="name@example.com"
                               class="form-control">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" required class="form-control">
                    </div>
                    <input type="submit" value="Login" class="btn btn-success align-items-center">
                    <a href="sign_up.php" class="btn btn-success align-items-center">Sign up</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>