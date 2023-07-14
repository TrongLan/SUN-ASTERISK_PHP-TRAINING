<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
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
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
