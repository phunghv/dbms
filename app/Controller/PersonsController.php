<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonController
 *
 * @author PhungHV
 */
class PersonsController extends AppController {

    //put your code here
    /**
     * $this->loadModel("Category");
      //Trang index su dung phan trang
      $this->paginate = array(
      'limit' => 10,
      'order' => array('category_created' => 'desc'),
      );
      $data = $this->paginate("Category");
      $this->set("categories", $data);
      //$this->set('studyshares', $this->Studyshare->find('all'));
     * @var type 
     */
    var $name = "Persons";
    var $helpers = array('Paginator', 'Html');
    var $components = array('Session');
    var $paginate = array();

    /**
     * Phan trang thuong
     */
    function paging() {
        /*
        $this->paginate = array(
            'limit' => 100,
            'fields' => array(
                'DISTINCT Person.id',
                'Person.name',
                'Person.address',
                'Person.tel'
        ));
        */
        $this->Person->recursive=0;
        $this->paginate = array('Person'=>array('limit'=>100));
        $data = $this->paginate("Person");
        $this->set("data", $data);
    }

    function index() {
        $this->paginate = array('limit' => 100, 'group' => array('Person.id'));
        $data = $this->paginate("Person");
        $this->set("data", $data);
    }

    /**
     * Select person p.personid = $id 
     */
    function view($id = null) {
        $sql = array(
            "conditions" => array(
                "`Person`.`id` =" => $id
            )
        );
        $data = $this->Person->find("all", $sql);
        $this->set("data", $data);
    }

}
