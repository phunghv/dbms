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
class VehiclesController extends AppController {

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
        if (isset($this->passedArgs['Vehicles.address'])) {
            // set the conditions
            $address = $this->passedArgs['Vehicles.address'];


            // $conditionsSubQuery['`Person`.`address`'] = $address;
            $conditionsSubQuery = array('`Person`.`address` LIKE ' => $address);
            $db = $this->Vehicle->getDataSource();
            $subQuery = $db->buildStatement(
                    array(
                'fields' => array('`Person`.`id`'),
                'table' => 'person', //$db->fullTableName($this->Person),
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
            // $data = $this->Vehicle->find('all', compact('conditions'));
            $this->paginate = array('limit' => 100);
            // $data = $this->paginate("Vehicle",compact('conditions'));
            $data = $this->paginate("Vehicle", $subQuery);
            if ($data == NULL) {
                $data = "Không tìm thấy dữ liệu với từ khóa <b>" . $address . "</b>";
                $this->set("data", $data);
                $this->set("has", 1);
            } else {
                $this->set("data", $data);
                $this->set("has", 0);
            }
        } else {
            $data = NULL;
            $this->set("data", $data);
            $this->set("has", 0);
        }
    }

}
