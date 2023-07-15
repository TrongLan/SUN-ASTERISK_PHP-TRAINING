<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha384-..." crossorigin="anonymous">
    <style>
        .floating-add-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            text-align: center;
            line-height: 60px;
            font-size: 24px;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

    </style>
</head>
<body>
<?php require_once 'nav_bar.php' ?>
<div class="container">

    <br>
    <a href="/product/add" class="btn btn-primary floating-add-btn">
        <i class="fa fa-plus"></i>
    </a>
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
