<?php
require_once "Models/dashbord/TotalSoldModel.php";

class TotalSoldController extends BaseController
{
    private $totalSoldModel;

    public function __construct()
    {
        $this->totalSoldModel = new TotalSoldModel();
    }

   
}