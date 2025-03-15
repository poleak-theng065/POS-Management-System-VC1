<?php

require_once ("Models/inventory/ImportNewProductModel.php");

class ImportNewProductController extends BaseController {

    private $new_imports;

    public function __construct() {
        $this->new_imports = new ImportNewProductModel();
    }

    public function importNewProduct() {

        $result = $this->new_imports->getNewImportProduct();
        $this->view('inventory/import_new_product/import_new_product', ['new_imports' => $result]);
    }

   
}

