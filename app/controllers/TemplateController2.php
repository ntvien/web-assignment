<?php
require_once __DIR__ . "/Controller.php";

class TemplateController2 extends Controller
{

    // private $loginView;

    public function __construct()
    {
        parent::__construct();
    }
    public function render()
    {
        parent::getView("template2");
    }
}
