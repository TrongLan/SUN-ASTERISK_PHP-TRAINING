<?php
require_once "./vendor/autoload.php";

use Ramsey\Uuid\Uuid;

class Product extends Controller
{
    public function __construct()
    {
        // constructor
    }

    public function index()
    {
        $this->store();
    }

    public function store()
    {

        $model = $this->loadModel("ProductInfo");
        $this->loadView(
            "product_list_page",
            ["products" => $model->findAllByCriteria()]);
    }

    public function add()
    {
        $productInfo = $this->loadModel("ProductInfo");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $uuid = Uuid::uuid4()->toString();
            $productInfo->setUuid($uuid);
            $productInfo->setCode($_POST["code"]);
            $productInfo->setTitle($_POST["title"]);
            $productInfo->setDescription($_POST["description"]);
            $productInfo->setPrice($_POST["price"]);
            $productInfo->setQuantity($_POST["quantity"]);
            $cropData = $_POST["cropData"];
            // xử lý lưu ảnh
            $image = $_FILES["image"];
            if ($image["error"] === UPLOAD_ERR_OK) {
                // xử lý ảnh cropped
                $croppedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $cropData));
                $fileName = uniqid() . '_' . $image['name'];
                $croppedImagePath = 'app/images/' . $fileName;
                file_put_contents($croppedImagePath, $croppedImage);
                $productInfo->setImage($croppedImagePath);
            }
            // lưu vào csdl
            $savedProductInfo = $productInfo->saveProductInfo();
            if ($savedProductInfo) {
                header("Location: /product/details/" . $productInfo->getUuid());
            }
        }
        $this->loadView("add_new_product_page", []);
    }

    public function details($uuid)
    {
        $productInfo = $this->loadModel("ProductInfo");
        $this->loadView("product_details_page", ["product_info" => $productInfo->getById($uuid)]);
    }
}
