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
    <h2>New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="code">Code:</label>
                <input type="text" class="form-control" id="code" name="code">
                <?php showInputMessage($dto["errors"], "code"); ?>
            </div>
            <div class="form-group col-md-8">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title">
                <?php showInputMessage($dto["errors"], "title"); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
                <input hidden id="cropData" name="cropData">
            </div>
            <div class="form-group col-md-3">
                <label for="price">Price (USD):</label>
                <input type="number" class="form-control" id="price" name="price">
                <?php showInputMessage($dto["errors"], "price"); ?>
            </div>
            <div class="form-group col-md-3">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
                <?php showInputMessage($dto["errors"], "quantity"); ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>

    <!-- Cropper Modal -->
    <div id="cropperModal" class="modal">
        <div class="modal-content">
            <div class="cropper-container">
                <img src="" id="cropperImage" alt="product image">
            </div>
            <div class="modal-footer">
                <button id="cropButton">Crop</button>
                <button id="cancelButton">Cancel</button>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="cropperjs/cropper.min.js" type="text/javascript"></script>
<script>
    // Get the image upload input element
    var imageUpload = document.getElementById('image');

    // Create variables for cropper and modal
    var cropper;
    var modal = document.getElementById('cropperModal');

    // Add event listener to the image upload input
    imageUpload.addEventListener('change', function (e) {
        var file = e.target.files[0];

        // Check if file is selected
        if (file) {
            // Show the cropper modal
            modal.style.display = 'block';

            // Create FileReader to read the selected file
            var reader = new FileReader();
            reader.onload = function (event) {
                // Create an image element and set the uploaded image as its source
                var image = document.getElementById('cropperImage');
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                    image.src = "";
                }

                image.src = event.target.result;

                // Initialize the cropper
                cropper = new Cropper(image, {
                    aspectRatio: 1, // Set the aspect ratio as desired
                    viewMode: 2, // Set the view mode (0, 1, 2, 3)
                    background: false, // Set to true to show a background behind the crop box
                });
            };

            // Read the uploaded file as a data URL
            reader.readAsDataURL(file);
        }
    });

    // Add event listener to the crop button
    document.getElementById('cropButton').addEventListener('click', function () {
        // Get the cropped data
        var croppedData = cropper.getCroppedCanvas().toDataURL();

        // Set the cropped data to the hidden input field
        document.getElementById('cropData').value = croppedData;
        console.log(croppedData);

        // Hide the modal
        modal.style.display = 'none';
    });

    // Add event listener to the cancel button
    document.getElementById('cancelButton').addEventListener('click', function () {
        // Reset the cropper
        cropper.destroy();

        // Clear the input field value
        imageUpload.value = '';

        // Hide the modal
        modal.style.display = 'none';

        // Clear the preview container
        var previewContainer = document.getElementById('croppedPreview');
        previewContainer.innerHTML = '';
    });


</script>
</body>
</html>
