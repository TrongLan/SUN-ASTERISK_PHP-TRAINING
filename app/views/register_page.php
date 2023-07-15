<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<?php
function showInputMessage($m, $fieldName)
{
    if (isset($m[$fieldName])) {
        echo "<div style='color: red'><p>" . $m[$fieldName] . "</p></div>";
    }
}

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <?php showInputMessage($dto["errors"], "email"); ?>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First name:</label>
                            <input type="text" class="form-control" id="f-name" name="first-name">
                            <?php showInputMessage($dto["errors"], "first-name"); ?>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name:</label>
                            <input type="text" class="form-control" id="l-name" name="last-name">
                            <?php showInputMessage($dto["errors"], "last-name"); ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <?php showInputMessage($dto["errors"], "username"); ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <?php showInputMessage($dto["errors"], "password"); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
                <div class="card-body">
                    Already have an account? <a href="/login">Sign in</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
