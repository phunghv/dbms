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
        $this->Person->unbindModel(array(
            'hasOne' => array(
                'Pet',
                'Vehicle'
            )
                )
        );
        $this->Person->recursive = 0;
        $this->paginate = array('Person' => array('limit' => 100));
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

    function search() {
        // the page we will redirect to
        $url['action'] = 'result';

        // build a URL will all the search elements in it
        // the resulting URL will be
        // example.com/cake/posts/index/Search.keywords:mykeyword/Search.tag_id:3

        foreach ($this->data as $k => $v) {
            foreach ($v as $kk => $vv) {
                $url[$k . '.' . $kk] = $vv;
            }
        }

        // redirect the user to the url
        $this->redirect($url, null, true);
    }

    function result() {
        $title = array();

        //
        // filter by id
        //
        $data;
        if (isset($this->passedArgs['Vehicles.address'])) {
            // set the conditions
            $address = $this->passedArgs['Vehicles.address'];
            $conditionsSubQuery['`Person`.`address`'] = $address;
            $db = $this->Vehicle->getDataSource();
            $subQuery = $db->buildStatement(
                    array(
                'fields' => array('`Person`.`id`'),
                'table' => $db->fullTableName($this->Vehicle),
                'alias' => 'Person',
                'limit' => null,
                'offset' => null,
                'joins' => array(),
                'conditions' => $conditionsSubQuery,
                'order' => null,
                'group' => null
                    ), $this->Vehicle
            );
            $subQuery = ' `Vehicle`.`person_id` IN (' . $subQuery . ') ';
            $subQueryExpression = $db->expression($subQuery);
            $conditions[] = $subQueryExpression;
            $this->loadModel('Person');
            $data = $this->Person->find('all', compact('conditions'));
            $this->set("data", $data);
        } else {
            $data = null;
            $this->set("data", $data);
        }
    }

}
