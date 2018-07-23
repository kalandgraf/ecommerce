<?php

use \Hcode\Page;
use \Hcode\Model\Category;
use \Hcode\Model\Product;

$app->get('/', function() {
    $products = Product::listAll();
    $page = new Page();
    $page->setTpl("index", [
        'products' => Product::checkList($products)
    ]);
});


$app->get('/categories/:idcategory', function($idcategory){
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    $cat = new Category;
    $cat->get((int)$idcategory);
    $pagination = $cat->getProductsPage($page);
    $pages = [];
    for ($i = 1; $i <= $pagination['pages']; $i++)
    {
        array_push($pages, [
            'link'=>"/categories/{$idcategory}?page={$i}",
            'page'=>$i
        ]);
    }
    $page = new Page;
    $page->setTpl("category", array(
        'category' => $cat->getValues(),
        'products' => $pagination['data'],
        'pages' => $pages
    ));
});

$app->get("/products/:desurl", function($desurl){
    $p = new Product;
    $p->getFromURL($desurl);
    $pg = new Page;
    $pg->setTpl("product-detail", [
        'product'=>$p->getValues(),
        'categories'=>$p->getCategories()
    ]);
});

?>