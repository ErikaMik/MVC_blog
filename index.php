<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$products = [
    1 => [
        'name' => 'Produktas 1',
        'sku' => '000001',
        'price' => '100',
        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
    ],

    2 => [
        'name' => 'Produktas 2',
        'sku' => '000002',
        'price' => '1050',
        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
    ],
    3 => [
        'name' => 'Produktas 3',
        'sku' => '000003',
        'price' => '1200',
        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
    ],
    4 => [
        'name' => 'Produktas 4',
        'sku' => '000004',
        'price' => '100',
        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
    ],
    5 => [
        'name' => 'Produktas 5',
        'sku' => '000005',
        'price' => '10120',
        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
    ],
    6 => [
        'name' => 'Produktas 6',
        'sku' => '000006',
        'price' => '100',
        'image' => 'https://www.uhaul.com/MovingSupplies/Image/GetMedia/?id=16338&media=8174'
    ],
];

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

function renderListItem($product, $key){
    $html = '';
    $html .= '<tr>';
    $html .= '<td>' . $key . '</td>';
    $html .= '<td>' . $product['name'] . '</td>';
    $html .= '<td>' . $product['sku'] . '</td>';
    $html .= '<td>' . $product['price'] . ' €</td>';
    $html .= '<td><img src="' . $product["image"] . '"></td>';
    $html .= '<td>' . priceWithPVM($product['price']) . ' €</td>';
    $html .= '</tr>';
    return $html;
}

function priceWithPVM($price){
    $pvm = $price * 1.21;
    return $pvm;
}

function renderGrid($products){
    $html = '';
    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<th>ID</th>';
    $html .= '<th>Name</th>';
    $html .= '<th>Sku</th>';
    $html .= '<th>Price</th>';
    $html .= '<th>Imge</th>';
    $html .= '<th>P. with PVM</th>';
    $html .= '</tr>';

    foreach ($products as $key => $product){
        $html .= renderListItem($product, $key);
    }

    $html .= '</table>';
    return $html;
}

echo renderGrid($products);

?>


<style>
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
