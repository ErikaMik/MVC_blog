<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//
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
//
////echo '<pre>';
////print_r($products);
//
//function renderProduct($product){
//    $html = '';
//    $html .= '<div style="float: left;" class="product-wrapper">';
//
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
//
//}
//
//echo renderGrid($products);

$users = [
    1 => [
        'name' => 'Antans',
        'surname' => 'Bagdonavicius',
        'email' => 'antanas@gmail.com',
        'phone' => '+37066212345',
        'bday' => '1987 07 01'
    ],
    2 => [
        'name' => 'Petras',
        'surname' => 'Bagdonavicius',
        'email' => 'antanas@gmail.com',
        'phone' => '+37066212345',
        'bday' => '1987 07 01'
    ],
    3 => [
        'name' => 'Kestas',
        'surname' => 'Bagdonavicius',
        'email' => 'antanas@gmail.com',
        'phone' => '+37066212345',
        'bday' => '1987 07 01'
    ],
    4 => [
        'name' => 'Maryte',
        'surname' => 'Bagdonavicius',
        'email' => 'antanas@gmail.com',
        'phone' => '+37066212345',
        'bday' => '1987 07 01'
    ],
    5 => [
        'name' => 'Zose',
        'surname' => 'Bagdonavicius',
        'email' => 'antanas@gmail.com',
        'phone' => '+37066212345',
        'bday' => '1987 07 01'
    ],
];


function renderListItem($user)
{
    $html = '';
    $html .= '<tr class="user-row">';
    $html .= '<td style="border: 1px solid black; border-collapse: collapse; padding: 5px;" class="name">' . $user['name'] . '</td>';
    $html .= '<td style="border: 1px solid black; border-collapse: collapse; padding: 5px;" class="surname">' . $user['surname'] . '</td>';
    $html .= '<td style="border: 1px solid black; border-collapse: collapse; padding: 5px;" class="email">' . $user['email'] . '</td>';
    $html .= '<td style="border: 1px solid black; border-collapse: collapse; padding: 5px;" class="phone">' . $user['phone'] . '</td>';
    $html .= '<td style="border: 1px solid black; border-collapse: collapse; padding: 5px;" class="bday">' . $user['bday'] . '</td>';
    $html .= '</tr>';

    return $html;

}

    function renderGrid($users){
    $html = '';
    $html .= '<table style="border: 1px solid black; border-collapse: collapse;" class="grid-wrapper">';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid black; border-collapse: collapse; padding: 5px;" >Name</th>';
        $html .= '<th style="border: 1px solid black; border-collapse: collapse; padding: 5px;" >Surname</th>';
        $html .= '<th style="border: 1px solid black; border-collapse: collapse; padding: 5px;" >Email</th>';
        $html .= '<th style="border: 1px solid black; border-collapse: collapse; padding: 5px;" >Phone</th>';
        $html .= '<th style="border: 1px solid black; border-collapse: collapse; padding: 5px;" >Birth date</th>';
        $html .= '</tr>';
    foreach ($users as $user){
        $html .= renderListItem($user);
    }
    $html .= '</table>';
    return $html;
}

echo renderGrid($users);