<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function conect()
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


//$password = 'Test';

echo '<pre>';
//$stmt = conect()->query('SELECT * FROM table1');
//while ($row = $stmt->fetch()){
//    print_r($row);
//}

$name = $_POST['name']; //'Činhčkuchas';
$email = $_POST['email']; //'cinhis1@mail.com';
$password1 = $_POST['password1']; //'pass1';
$password2 = $_POST['password2']; //'pass1';
//$password1 = md5(md5($password1.'salt'));
//$password2 = md5(md5($password2.'salt'));


//function emailModification($email){
//    $email = strtolower($email);
//    $email = str_replace(["]", "[", ":", "\\", "/", "*", "'"], "", $email);
//    $email = str_replace(" ","",$email);
//    $email = str_replace(",",".",$email);
//    $email = str_replace(["..", "...", "...."],"",$email);
//
//    echo $email;
//}
//
//emailModification($email);

function uniqueEmail($email){
        $sql = "SELECT * FROM table1 WHERE email = ?";
        $stmt = conect()->prepare($sql);
        $stmt->execute([$email]);
        $emailExist = $stmt->fetch();
        if($emailExist == false){
            return true;
        }
        return false;
}

function passwordMatch($password1, $password2){
    if($password1 === $password2){
        return true;
    }
    return false;
}

function createUser($name, $email, $password1){
    {
        $sql = "INSERT INTO table1(name, email, password) VALUES(:name, :email, :password)";
        $stmt = conect()->prepare($sql);
        $stmt->execute([
            "name" => $name,
            "email" => $email,
            "password" => $password1
        ]);
    }

}

function submitUser($name, $email, $password1, $password2){
    if(!passwordMatch($password1, $password2)){
        echo 'Nesutampa passwordai';
    }
    if(!uniqueEmail($email)){
        echo 'Email exist';
    }
    createUser($name, $email, $password1);
    echo 'Success';
}
submitUser($name, $email, $password1, $password2);

//phpinfo();



//$products = [
//    1 => [
//        'name' => 'Produktas 1',
//        'sku' => '000001',
//        'price' => '100',
//        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
//    ],
//
//    2 => [
//        'name' => 'Produktas 2',
//        'sku' => '000002',
//        'price' => '1050',
//        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
//    ],
//    3 => [
//        'name' => 'Produktas 3',
//        'sku' => '000003',
//        'price' => '1200',
//        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
//    ],
//    4 => [
//        'name' => 'Produktas 4',
//        'sku' => '000004',
//        'price' => '100',
//        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
//    ],
//    5 => [
//        'name' => 'Produktas 5',
//        'sku' => '000005',
//        'price' => '10120',
//        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
//    ],
//    6 => [
//        'name' => 'Produktas 6',
//        'sku' => '000006',
//        'price' => '100',
//        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
//    ],
//];

//echo '<pre>';
//print_r($products);

//function renderProduct($product){
//    $html = '';
//    $html .= '<div style="float: left;" class="product-wrapper">';
//    $html .= '<div  class="image"><img style="max-width: 100px;" src="'.$product['image'].'"></div>';
//    $html .= '<div class="sku">'.$product['sku'].'</div>';
//    $html .= '<div class="price">'.$product['price'].'</div>';
//    $html .= '</div>';
//
//    return $html;
//}
//
//
//function renderGrid($products){
//    $html = '';
//    $html .= '<div class="grid-wrapper">';
//    foreach ($products as $product){
//        $html .= renderProduct($product);
//    }
//    $html .= '</div>';
//    return $html;
//
//}
//
//echo renderGrid($products);

//$users = [
//    1 => [
//        'name' => 'Antans',
//        'surname' => 'Bagdonavicius',
//        'email' => 'antanas@gmail.com',
//        'phone' => '+37066212345',
//        'bday' => '1987 07 01'
//    ],
//    2 => [
//        'name' => 'Petras',
//        'surname' => 'Bagdonavicius',
//        'email' => 'antanas@gmail.com',
//        'phone' => '+37066212345',
//        'bday' => '1987 07 01'
//    ],
//    3 => [
//        'name' => 'Kestas',
//        'surname' => 'Bagdonavicius',
//        'email' => 'antanas@gmail.com',
//        'phone' => '+37066212345',
//        'bday' => '1987 07 01'
//    ],
//    4 => [
//        'name' => 'Maryte',
//        'surname' => 'Bagdonavicius',
//        'email' => 'antanas@gmail.com',
//        'phone' => '+37066212345',
//        'bday' => '1987 07 01'
//    ],
//    5 => [
//        'name' => 'Zose',
//        'surname' => 'Bagdonavicius',
//        'email' => 'antanas@gmail.com',
//        'phone' => '+37066212345',
//        'bday' => '1987 07 01'
//    ],
//];
//
//
//function renderListItem($user, $key)
//{
//    $html = '';
//    $html .= '<tr class="user-row">';
//    $html .= '<td class="id">' . $key . '</td>';
//    $html .= '<td class="name">' . $user['name'] . '</td>';
//    $html .= '<td class="surname">' . $user['surname'] . '</td>';
//    $html .= '<td class="email">' . $user['email'] . '</td>';
//    $html .= '<td class="phone">' . $user['phone'] . '</td>';
//    $html .= '<td class="bday">' . $user['bday'] . '</td>';
//    $html .= '</tr>';
//
//    return $html;
//
//}
//
//function renderGrid($users){
//    $html = '';
//    $html .= '<table class="grid-wrapper">';
//    $html .= '<tr>';
//    $html .= '<th>ID</th>';
//    $html .= '<th>Name</th>';
//    $html .= '<th>Surname</th>';
//    $html .= '<th>Email</th>';
//    $html .= '<th>Phone</th>';
//    $html .= '<th>Birth date</th>';
//    $html .= '</tr>';
//    foreach ($users as $key => $user){
//        $html .= renderListItem($user, $key);
//    }
//    $html .= '</table>';
//    return $html;
//}
//
//echo renderGrid($users);
//
//
//
//
//
//function renderListItem($product, $key){
//    $html = '';
//    $html .= '<tr>';
//    $html .= '<td>' . $key . '</td>';
//    $html .= '<td>' . $product['name'] . '</td>';
//    $html .= '<td>' . $product['sku'] . '</td>';
//    $html .= '<td>' . $product['price'] . ' €</td>';
//    $html .= '<td><img src="' . $product["image"] . '"></td>';
//    $html .= '<td>' . priceWithPVM($product['price']) . ' €</td>';
//    $html .= '</tr>';
//    return $html;
//}
//
//function priceWithPVM($price){
//    $pvm = $price * 1.21;
//    return $pvm;
//}
//
//function renderGrid($products){
//    $html = '';
//    $html .= '<table>';
//    $html .= '<tr>';
//    $html .= '<th>ID</th>';
//    $html .= '<th>Name</th>';
//    $html .= '<th>Sku</th>';
//    $html .= '<th>Price</th>';
//    $html .= '<th>Imge</th>';
//    $html .= '<th>P. with PVM</th>';
//    $html .= '</tr>';
//
//    foreach ($products as $key => $product){
//        $html .= renderListItem($product, $key);
//    }
//
//    $html .= '</table>';
//    return $html;
//}

//$menuItems = [
//    1 => [
//        'label' => 'Home',
//        'URL' => 'https://www.delfi.lt/',
//    ],
//    2 => [
//        'label' => 'About',
//        'URL' => 'http://erikamik.site/',
//    ],
//    3 => [
//        'label' => 'Category',
//        'URL' => 'https://www.delfi.lt/',
//    ],
//    4 => [
//        'label' => 'Contacts',
//        'URL' => 'https://www.delfi.lt/',
//    ],
//];
//
//function renderNavItems($alink){
//    $html = '';
//    $html .= '<a href="' .$alink['URL']. '">'.$alink['label'].'</a>';
//    return $html;
//    }
//
//function renderHeader($menuItems){
//    $html = '';
//    $html .= '<header>';
//    $html .= '<nav>';
//        foreach ($menuItems as $alink){
//            $html .= renderNavItems($alink);
//        }
//
//    $html .= '</nav>';
//    $html .= '</header>';
//    return $html;
//}
//
//echo renderHeader($menuItems);

//$productGlobal = [
//    'name' => 'Masina',
//    'price' => 28800,
//    'sku' => 'Opel'
//];
//
//function getPriceWithTax($countryCode, $product){
//    $pvmRates = [
//        'lt' => 21,
//        'pl' => 18,
//        'lv' => 21
//    ];
//
//    $price = $product['price'];
//    $countryRate = $pvmRates[$countryCode];
//    $priceWithTax = $price * (100 + $countryRate)/100;
//
//    return $priceWithTax;
//}
//
//echo getPriceWithTax('pl', $productGlobal);

//$array = [1,3,5,6,7,8,10,11,12];
////1 iki n
//
//function find($array)
//{   $i = 1;
//    $x = 0;
//    foreach($array as $value) {
//        if($value != $i) {
//            echo $value - 1;
//            $i++;
//            $x = 1;
//            echo '<pre>';
//        }
//        $i++;
//    }
//    if($x == 0){
//        $value = end($array)+1;
//        echo $value;
//    }
//}


//for($i = 1; $i <= count($array) + 1; $i++){
//    if(!in_array($i, $array)){
//        echo $i;
//        echo '<pre>';
//    }
//}

//echo find($array);
//

//$array = [-5,6,10,-15,19,15,20,-2];
//
//function minValue($array)
//{
//    $min = 9999;
//    $min2 = 0;
//    $min3 = 0;
//    foreach ($array as $value) {
//        if ($value < $min) {
//            $min2 = $min;
//            $min = $value;
//        }elseif($value < $min2){
//            $min3 = $min2;
//            $min2 = $value;
//        }elseif($value < $min3){
//            $min3 = $value;
//        }
//
//    }
//    echo 'Mažiausias: ' . $min;
//    echo '<br>';
//    echo 'II mažiausias: ' . $min2;
//    echo '<br>';
//    echo 'III mažiausias: ' . $min3;
//}
//
//
//
//
//function maxFromTree(){
//    $x = 81;
//    $y = 200;
//    $z = 11;
//
//    if ($x > $y) {
//        if ($x > $z) {
//            echo $x;
//        } elseif ($y > $z) {
//            echo $y;
//        } else {
//            echo $z;
//        }
//    } elseif ($y > $z) {
//        echo $y;
//    } else {
//        echo $z;
//    }
//}
//
//minValue($array);
//
//echo '<br>';
//echo '<br>';
//
//maxFromTree();

//foreach($array as $key => $value){
//    echo '<br>';
//    echo $array[$key+1];
//    if($array[$key]<$array[$key+1]){
//        $min = $array[$key];
//    }else{
//        $min = $array[$key]+1;
//    }
//    echo $min;
//}


?>

<style>
    header{
        max-width: 600px;
        margin: 0 auto;
        background-color: aquamarine;
    }

    nav{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    a{
        text-decoration: none;
        color: black;
        padding: 10px;
    }

    table {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
        text-align: center;
    }


    img {
        max-width: 100px;
    }
</style>
