<?php
require_once "./vendor/autoload.php";

use Ramsey\Uuid\Uuid;

class Product extends Controller
{
    private $errors = [];

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
        $this->loginRequire();
        $model = $this->loadModel("ProductInfo");
        $this->loadView(
            "product_list_page",
            ["products" => $model->findAllByCriteria()]);
    }

    public function add()
    {
        $this->loginRequire();
        $productInfo = $this->loadModel("ProductInfo");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $requiredErrors = CustomValidator::commonValidate([
                "code" => $_POST["code"],
                "title" => $_POST["title"],
                "price" => $_POST["price"],
                "quantity" => $_POST["quantity"],
            ]);
            $lengthErrors = CustomValidator::lengthValidation([
                "code" => [$_POST["code"], 50],
                "title" => [$_POST["title"], 100],
                "description" => [$_POST["description"], 50000],
            ]);
            $numberErrors = CustomValidator::numberValidation([
                "price" => [$_POST["price"], [0, 100]],
                "quantity" => [$_POST["quantity"], [0, 100]]
            ]);
            $this->errors = array_merge($requiredErrors, $lengthErrors, $numberErrors);

            if ($productInfo->existsByCode($_POST["code"])) {
                $this->errors["code"] = "code has already existed.";
            }
            if (empty($this->errors)) {
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
                    exit();
                }
            }
        }
        $this->loadView("add_new_product_page", ["errors" => $this->errors]);
        unset($this->errors);
    }

    public function details($uuid)
    {
        $this->loginRequire();
        $productInfo = $this->loadModel("ProductInfo");
        $this->loadView("product_details_page", ["product_info" => $productInfo->getById($uuid)]);
    }

    public function delete($uuid)
    {
        $this->loginRequire();
        $model = $this->loadModel("ProductInfo");
        $model->deleteById($uuid);
        header("Location: /product");
        exit();
    }

    public function update($uuid)
    {
        $this->loginRequire();
        $model = $this->loadModel("ProductInfo");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->errors = CustomValidator::commonValidate([
                "code" => $_POST["code"],
                "title" => $_POST["title"],
                "price" => $_POST["price"],
                "quantity" => $_POST["quantity"],
            ]);
            if (empty($this->errors)) {
                $updateData = new ProductInfo();
                $updateData->setTitle($_POST["title"]);
                $updateData->setDescription($_POST["description"]);
                $updateData->setPrice($_POST["price"]);
                $updateData->setQuantity($_POST["quantity"]);
                // lưu vào csdl
                $savedProductInfo = $updateData->updateById($uuid, $updateData);
                if ($savedProductInfo) {
                    header("Location: /product/details/" . $uuid);
                    exit();
                }
            }
        }
        $this->loadView(
            "update_product_page",
            ["errors" => $this->errors, "need_update" => $model->getById($uuid)]);
        unset($this->errors);
    }
}
