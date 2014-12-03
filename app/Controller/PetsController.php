<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PetsController
 *
 * @author PhungHV
 */
class PetsController extends AppController {

    //put your code here
    var $name = "Pets";
    var $components = array('Session');
    var $helpers = array('Paginator', 'Html');
    var $paginate = array();

    function paging() {
        $this->paginate = array('limit' => 100);
        $data = $this->paginate("Pet");
        $this->set("data", $data);
    }

    function view($id) {
        $sql = array("conditions" => array("id =" => $id));
        $data = $this->Pet->find("all", $sql);
        $this->set("data", $data);
    }

    function index() {
        $this->paginate = array('limit' => 100);
        $data = $this->paginate("Pet");
        $this->set("data", $data);
    }

}
