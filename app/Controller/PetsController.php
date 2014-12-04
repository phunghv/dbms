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
        if (isset($this->passedArgs['Pets.address'])) {
            // set the conditions
            $address = $this->passedArgs['Pets.address'];
            $conditionsSubQuery = array('`Person`.`address` LIKE ' => $address);
            $db = $this->Pet->getDataSource();
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
                    ), $this->Pet
            );
            $subQuery = ' `Pet`.`person_id` IN (' . $subQuery . ') ';
            $subQueryExpression = $db->expression($subQuery);
            $conditions[] = $subQueryExpression;
            $this->paginate = array('limit' => 100);
            $data = $this->paginate("Pet", $subQuery);
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
