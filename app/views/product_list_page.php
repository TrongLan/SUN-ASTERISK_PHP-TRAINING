<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Store</h1>
    <div class="row">
        <?php
        foreach ($dto["products"] as $p) {
            echo
        '<div class="col-md-4">
            <div class="card mb-4">
                <img src="/' . $p->getImage() . '" alt="Product image" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">' . $p->getTitle() . '</h5>
                    <p class="card-text">Price: $' . $p->getPrice() . '</p>
                    <p class="card-text">Quantity: ' . $p->getQuantity() . '</p>
                    <a href="/product/details/' . $p->getUuid() . '" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>';
        }
        ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
