<?php

class ContactsController extends Controller{

    public function __construct($data = array() ){
        parent::__construct($data);
        $this->model = new Message();
    }

        public function index(){
            if($_POST){
                if($this->model->save($_POST)){
                    Session::setFlash('Thank you! Your message was sent successfully.');
                } else {
                    Session::setFlash('Please fill in all fields of this form to send a messages to admins.');
                }
            }
    }

    public function admin_index(){
        $this->data = $this->model->getList();
    }
}