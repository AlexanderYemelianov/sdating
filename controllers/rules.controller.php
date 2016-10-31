<?php

class RulesController extends Controller {

    public function __construct($data=array() ){
        parent::__construct($data);
        $this->model = new Rule;

    }

    public function index(){
        $this->data['rules'] = $this->model->getRules();
    }

    public function admin_index(){

    }
}
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 17.03.2016
 * Time: 20:22
 */ 