<?php

class RegistrationController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Registration1();
    }

    public function index(){
        $this->data['mainpage'] = $this->model->getNearestDateInformation();

        if($_POST['enter'] != 'enter'){
            null;
        }else{
            $name = $_POST['name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $ageGroup = $_POST['age_group'];
            $sex = $_POST['sex'];
            $idOfDate= $_POST['id_of_date'];

            if(empty($name) || empty($lastName) || empty($email) || empty($phone) || empty($ageGroup) || empty($sex) || empty($idOfDate)){
                Session::setFlash('Please fill in all fields!');
            }else{
                $this->model->registration($_POST['name'], $_POST['last_name'], $_POST['email'], $_POST['phone'], $_POST['age_group'], $_POST['sex'], $_POST['id_of_date']);
                Session::setFlash('Thank you for registration. Our representative will contact with you as soon as possible.');
            }
        }
    }

    public function admin_index(){

        $this->data['dateId'] = $this->model->getListOfDates();
        $this->data['id'] = $_POST['datesId'];

        if(!isset($_POST['datesId'])){
            $this->data['participants'] = array();
        }elseif($_POST['datesId'] == 'all'){
            $this->data['participants'] = $this->model->getAllParticiapnts();
            $this->data['participants']['fullList'] = 1;
        }else{
            $id = $_POST['datesId'];
            $this->data['participants'] = $this->model->participantsList($id);
        }
    }
}