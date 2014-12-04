<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Person
 *
 * @author PhungHV
 */
class Person extends AppModel {

    //put your code here
    var $name = "Person";
    var $useTable = "person";
    var $hasOne = array(
        'Pet' => array(
            'className' => 'Pet',
            'foreignKey' => 'person_id'
        ),
        'Vehicle' => array(
            'className' => 'Vehicle',
            'foreignKey' => 'person_id'
        )
    );

    public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {
        $recursive = -1;
        // Mandatory to have
        $this->useTable = false;
        $sql = '';
        $sql .= "SELECT * FROM person AS Person LIMIT ";
        // Adding LIMIT Clause
        $sql .= (($page - 1) * $limit) . ', ' . $limit;
        $results = $this->query($sql);
        return $results;
    }
    /*
    public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
        $sql = '';
        $sql .= "SELECT COUNT(*) AS `count` FROM `demo`.`person` AS `Person`";
        $this->recursive = $recursive;
        //$results = $this->query($sql);
        $results = $this->query($sql);
        return count($results);
    }
    */
}
