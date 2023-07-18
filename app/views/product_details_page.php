<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha384-..." crossorigin="anonymous">
    <style>
        .floating-button-container {
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

        .floating-button {
            background-color: #007bff;
            color: #fff;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .floating-button:hover {
            background-color: #0056b3;
        }

        .floating-button-icon {
            font-size: 24px;
        }

        .floating-button-toggle {
            display: none;
        }

        .floating-button-toggle:checked ~ .floating-button-options {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
        }

        .floating-button-options {
            position: absolute;
            bottom: 80px;
            right: 0;
            visibility: hidden;
            opacity: 0;
            transform: translateY(10px);
            transition: visibility 0s ease, opacity 0.3s ease, transform 0.3s ease;
        }

        .floating-button-options li {
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
<?php require_once 'nav_bar.php' ?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-6">
            <img <?php echo 'src="/' . $dto["product_info"]->getImage() . '"'; ?> alt="Product Image" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2><?php echo $dto["product_info"]->getTitle(); ?></h2>
            <p><?php echo $dto["product_info"]->getDescription(); ?></p>
            <p><strong>Price:</strong> <?php echo '$' . $dto["product_info"]->getPrice(); ?></p>
            <p><strong>Quantity:</strong> <?php echo $dto["product_info"]->getQuantity(); ?></p>
        </div>
    </div>
    <div class="floating-button-container">
        <input type="checkbox" id="floating-button-toggle" class="floating-button-toggle">
        <label for="floating-button-toggle" class="floating-button">
            <i class="fa-solid fa-ellipsis"></i>
        </label>
        <ul class="floating-button-options">
            <li>
                <a <?php echo 'href="/product/update/' . $dto["product_info"]->getUuid() . '"' ?>
                        class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                    Update
                </a>
            </li>
            <li>
                <a <?php echo 'href="/product/delete/' . $dto["product_info"]->getUuid() . '"' ?>
                        class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    Delete
                </a>
            </li>
        </ul>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
