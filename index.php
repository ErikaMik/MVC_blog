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

function renderProduct($product){
    $html = '';
    $html .= '<div style="float: left;" class="product-wrapper">';

    $html .= '<div  class="image"><img style="max-width: 100px;" src="'.$product['image'].'"></div>';
    $html .= '<div class="sku">'.$product['sku'].'</div>';
    $html .= '<div class="price">'.$product['price'].'</div>';
    $html .= '</div>';

    return $html;
}


function renderGrid($products){
    $html = '';
    $html .= '<div class="grid-wrapper">';
    foreach ($products as $product){
        $html .= renderProduct($product);
    }
    $html .= '</div>';
    return $html;


}

echo renderGrid($products);