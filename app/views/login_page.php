<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
                <div class="card-body">
                    Don't have account yet? <a href="/register">Create a new one.</a>
                </div>
                <?php
                if (isset($dto["errorMessage"])) {
                    echo '<div class="card-footer" style="color: red">'
                        . $dto["errorMessage"]
                        . '</div>';
                }
                ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>
