<?php

class MainpageController extends Controller {

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Main_page;
    }

    public function index(){
        $this->data['mainpage'] = $this->model->getNearestSD();
        $this->data['photos'] = $this->model->getPhotoForMainPage();
    }

    public function admin_index(){
        $this->data['mainpage'] = $this->model->getNearestSD();
        $this->data['participants'] = $this->model->getCurrentParticipants();
    }

    public function admin_prepayment(){
        $id = $_POST['prepayment_status_with_user_id'];
        $admin = Session::get('admin_id');
        $this->data['prepayment'] = $this->model->prepayment($id, $admin);
        Router::redirect('/admin/');
    }

    public function admin_edit(){
        $this->data['dates'] = $this->model->getNearestSD();

        if($_POST){
            $result = $this->model->save($_POST);
            if($result){
                Session::setFlash('Dates was saved.');
            } else {
                Session::setFlash('Error.');
            }
            Router::redirect('/admin/');
        }
    }

    public function admin_add(){
        if($_POST){
            $result = $this->model->admin_addDate($_POST);
            if($result){
                Session::setFlash('New date was created');
            }else{
                Session::setFlash('Ooops, something goes wrong! New date was not created!');
            }
            Router::redirect('/admin/mainpage/');
        }
    }

    public function admin_delete(){
        if(isset($this->params[0])){
            $result = $this->model->admin_delete($this->params[0]);
            if($result){
                Session::setFlash('Date was deleted.');
            } else {
                Session::setFlash('Error!');
            }
        }
        Router::redirect('/admin/');
    }

    public function admin_archive(){
        $this->data['archive'] = $this->model->admin_getAllDates();
    }
}

