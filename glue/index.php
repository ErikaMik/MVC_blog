<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

function connect()
{
    $host = '127.0.0.1';
    $db = 'pirma_db';
    $user = 'ErikaMik';
    $password = '#DamnSoul666';

    try {
        $pdo = new PDO("mysql:host=$host; dbname=$db; charset=utf8", $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return false;
    }
    return $pdo;
}

$name = $_POST['name'];
$price = $_POST['price'];
$qty = $_POST['qty'];
$sku = $_POST['sku'];
$descr = $_POST['description'];
$status = $_POST['status'];
$weight = $_POST['weight'];
$image = $_POST['image'];

function uniqueSKU($sku){
    $sql = "SELECT * FROM glue WHERE sku = ?";
    $stmt = connect()->prepare($sql);
    $stmt->execute([$sku]);
    $skuExist = $stmt->fetch();
    if($skuExist == false){
        return true;
    }
        return false;
}

// fetchasoc() ?

function createUser($name, $price, $qty, $sku, $descr, $status, $weight, $image){
    {
        $sql = "INSERT INTO glue(name, price, qty, sku, description, status, weight, image) VALUES(:name, :price, :qty, :sku, :descr, :status, :weight, :image)";
        $stmt = connect()->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR_CHAR);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':qty', $qty, PDO::PARAM_INT);
        $stmt->bindValue(':sku', $sku, PDO::PARAM_STR_CHAR);
        $stmt->bindValue(':descr', $descr, PDO::PARAM_STR_CHAR);
        $stmt->bindValue(':status', (int)$status, PDO::PARAM_BOOL);
        $stmt->bindValue(':weight', $weight, PDO::PARAM_INT);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR_CHAR);
        $stmt->execute();
    }
}

function submitProduct($name, $price, $qty, $sku, $descr, $status, $weight, $image){
    if(!uniqueSKU($sku)){
        echo 'SKU already exist';
    }
    createUser($name, $price, $qty, $sku, $descr, $status, $weight, $image);
}

submitProduct($name, $price, $qty, $sku, $descr, $status, $weight, $image);
echo '<br>';


// Draw DB table - output RenderView


//$stmt = connect()->query('SELECT * FROM glue');
//while ($row = $stmt->fetchObject()){
//    print_r($row->name);
//}

//$stmt = connect()->query('SELECT * FROM glue');
//while ($row = $stmt->fetch()){
//    print_r($row);
//}

function renderListItems(){
    $stmt = connect()->query('SELECT * FROM glue');
    foreach ($stmt as $row) {
        $html = '';
        $html .= '<div>';
        $html .= '<h2>' . $row["name"] . '</h2>';
        $html .= '<h2>' . $row["price"] . '€</h2>';
        $html .= '<h3>APRAŠYMAS</h3>';
        $html .= '<p>' . $row["description"] . '</p>';
        $html .= '<p class="p"><img src="' . $row["image"] . '"></p>';
        $html .= '</div>';
        echo $html;
    }
}

function renderView(){
    $html = '';
    $html .= '<section>';
    $html .= renderListItems();
    $html .= '</section>';
    echo $html;
}

echo renderView();

?>

<style>
    body {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    div {
        max-width: 25%;
        margin: 10px;
        padding: 10px;
        border: 1px solid black;
        border-radius: 5px;
    }

    img {
        max-width: 200px;
    }

    .p {
        text-align: center;
    }
</style>
