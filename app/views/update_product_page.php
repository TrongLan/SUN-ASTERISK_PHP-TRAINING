<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Product</title>
    <link rel="stylesheet" type="text/css" href="/cropper/cropper.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .modal-content {
            max-width: 600px; /* Adjust the maximum width as needed */
            max-height: 400px; /* Adjust the maximum width as needed */
            margin: 0 auto;
        }

        .cropper-container {
            max-width: 100%;
            height: auto;
            overflow: hidden;
        }

        #croppedPreview {
            max-width: 100%;
            height: auto;
        }

        .modal-footer {
            justify-content: space-between;
        }

        #cropButton {
            border: none;
            background-color: #007bff;
            color: #fff;
        }

        #cancelButton {
            border: none;
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
<?php
require_once 'nav_bar.php';

function showInputMessage($m, $fieldName)
{
    if (isset($m[$fieldName])) {
        echo "<div style='color: red'><p>" . $m[$fieldName] . "</p></div>";
    }
}

?>
<div class="container">
    <br>
    <h2>Update product</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="code">Code:</label>
                <input type="text" class="form-control" id="code" name="code" readonly
                    <?php echo 'value="' . $dto["need_update"]->getCode() . '"' ?>
                >
                <?php showInputMessage($dto["errors"], "code"); ?>
            </div>
            <div class="form-group col-md-8">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title"
                    <?php echo 'value="' . $dto["need_update"]->getTitle() . '"' ?>
                >
                <?php showInputMessage($dto["errors"], "title"); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-8">
                <label style="height: 10%" for="description">Description:</label>
                <textarea style="height: 80%; resize: none;" class="form-control" id="description" name="description"
                ><?php echo $dto["need_update"]->getDescription(); ?></textarea>
            </div>
            <div class="form-group col-md-1">
            </div>
            <div class="form-group col-md-3" style="text-align: end">
                <img alt="product image" height=100% width="200px" <?php echo 'src="/' . $dto["need_update"]->getImage() . '"' ?>>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="price">Price (USD):</label>
                <input type="number" class="form-control" id="price" name="price"
                    <?php echo 'value="' . $dto["need_update"]->getPrice() . '"' ?>
                >
                <?php showInputMessage($dto["errors"], "price"); ?>
            </div>
            <div class="form-group col-md-4">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    <?php echo 'value="' . $dto["need_update"]->getQuantity() . '"' ?>
                >
                <?php showInputMessage($dto["errors"], "quantity"); ?>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Accept</button>
    </form>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
