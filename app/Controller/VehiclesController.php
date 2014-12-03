<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VehiclesController
 *
 * @author PhungHV
 */
class VehiclesController extends AppController{
    //put your code here
     //put your code here
    var $name = "Vehicles";
    var $components = array('Session');
    var $helpers = array('Paginator', 'Html');
    var $paginate = array();

    function paging() {
        $this->paginate = array('limit' => 100);
        $data = $this->paginate("Vehicle");
        $this->set("data", $data);
    }

    function view($id) {
        $sql = array("conditions" => array("id =" => $id));
        $data = $this->Vehicle->find("all", $sql);
        $this->set("data", $data);
    }

    function index() {
        $data = $this->Vehicle->find("all");
        $this->set("data", $data);
    }
}
