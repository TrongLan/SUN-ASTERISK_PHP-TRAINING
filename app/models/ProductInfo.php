<?php

class ProductInfo extends Database
{
    private $uuid;
    private $code;
    private $title;
    private $description;
    private $image;
    private $quantity;
    private $price;

    public function __construct()
    {
        // Nothing here...
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param mixed $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function saveProductInfo()
    {
        $insertUserQuery =
            "INSERT INTO products (uuid, code, title, description, price, quantity, image) "
            . "VALUES (?, ?, ?, ?, ?, ?, ?)";
        $mysqliStatement = mysqli_prepare($this->getConnection(), $insertUserQuery);
        mysqli_stmt_bind_param(
            $mysqliStatement,
            'ssssdis',
            $this->uuid,
            $this->code,
            $this->title,
            $this->description,
            $this->price,
            $this->quantity,
            $this->image);
        return mysqli_stmt_execute($mysqliStatement);
    }

    public function getById($uuid)
    {
        $query = "SELECT * FROM products WHERE uuid = ?";
        $stmt = mysqli_prepare($this->getConnection(), $query);
        $stmt->bind_param("s", $uuid);
        $stmt->execute();
        $stmt->bind_result($uuid, $code, $description, $price, $quantity, $image, $title);
        $byId = new ProductInfo();
        while ($stmt->fetch()) {
            $this->mapToProductInfoObject($byId, $uuid, $code, $description, $price, $quantity, $image, $title);
        }
        return $byId;
    }

    public function findAllByCriteria()
    {
        $query = "SELECT * FROM products ORDER BY title";
        $stmt = mysqli_prepare($this->getConnection(), $query);
        $stmt->execute();
        $stmt->bind_result($uuid, $code, $description, $price, $quantity, $image, $title);
        $productList = [];
        while ($stmt->fetch()) {
            $info = new ProductInfo();
            $infoObject = $this->mapToProductInfoObject(
                $info, $uuid, $code, $description, $price, $quantity, $image, $title);
            $productList[] = $info;
        }
        return $productList;
    }

    /**
     * @param ProductInfo $productInfo
     * @param $uuid
     * @param $code
     * @param $description
     * @param $price
     * @param $quantity
     * @param $image
     * @param $title
     * @return void
     */
    public function mapToProductInfoObject(
        ProductInfo $productInfo, $uuid, $code, $description, $price, $quantity, $image, $title)
    {
        $productInfo->setUuid($uuid);
        $productInfo->setCode($code);
        $productInfo->setDescription($description);
        $productInfo->setPrice($price);
        $productInfo->setQuantity($quantity);
        $productInfo->setImage($image);
        $productInfo->setTitle($title);
    }

}
