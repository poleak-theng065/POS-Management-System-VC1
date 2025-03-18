<?php

// require_once ("Models/inventory/ImportNewProductModel.php");

class ImportProductController extends BaseController {

    private $importProducts;

    public function ImportProduct() {
        $this->view('inventory/import_product/import_product');
    }


   
}

