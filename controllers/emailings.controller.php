<?php

/*this class have a lot of double coding problems. you must fix this.*/

class EmailingsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Emailing;
    }

    public function admin_emailing_page(){

        $params = App::getRouter()->getParams();

        if (isset($params[0])){
            $id = $params[0];
            $this->data['participants'] = $this->model->getParticipants($id);
            $participant = $this->data['participants'];
        }

        if(!empty($_POST['email']) || !empty($_POST['subject']) || !empty($_POST['message'])){
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $headerFields = array(
                "From: AvKube.com",
                "MIME-Version: 1.0",
                "Content-Type: text/html;charset=utf-8"
            );
            $name = $participant[0]['name'];
            $datesId = $participant[0]['id_of_date'];

            $admin = Session::get('admin_id');

            mail($email, $subject, "\r\n\r\n" . $message, implode("\r\n", $headerFields));;

            /*SESSION MESSAGES WITH REDIRECT DOES NOT WORK*/

            $this->model->save($name, $email, $datesId, $subject, $message, $admin);

            Session::setFlash('Message to <b>' . $email . ' </b> was send succesfully!');
            Router::redirect('/admin/');
        }
    }

    public function admin_inform(){

        $id = $_POST['informed_status_with_user_id'];

        $participants = $this->model->getParticipants($id);
        $name = $participants[0]['name'];
        $datesId = $participants[0]['id_of_date'];
        $email = $participants[0]['email'];
        $datesName = $participants[1]['date_name'];
        $dateOfDate = $participants[0]['date'];
        $datesLocation = $participants[0]['location'];

        $subject = "AvKube registration confirmation";
        $message = 'Dear '. $name .','. "\r\n\r\nThank you for registration on date - " . $datesName . " that will be held " . $dateOfDate ." at a place that you can find using link " . $datesLocation . " \r\n\r\nHave a nice day!";
        $headerFields = array(
            "From: AvKube.com",
            "MIME-Version: 1.0",
            "Content-Type: text/html;charset=utf-8"
        );
        $admin = Session::get('admin_id');

        mail($participants[0]['email'], $subject, $message, implode("\r\n", $headerFields));
        $this->model->informed($id, $admin);

        $this->model->save($name, $email, $datesId, $subject, $message, $admin);

        Router::redirect('/admin/');
    }

    public function admin_results(){

        $params = App::getRouter()->getParams();

        if (isset($params[0])){
            $id = $params[0];
            $this->data['participant'] = $this->model->getParticipants($id);
            $participant = $this->data['participant'];
            $idOfDate = $participant[0]['id_of_date'];
            $sex = $participant[0]['sex'];
            $this->data['participants'] = $this->model->getAllParticipants($idOfDate, $sex);
        }

        $this->data['sym'] = $_POST['sympathy'];

        if(!empty($_POST['sympathy'])) {
            $this->data['sympathy'] = $_POST['sympathy'];
            $sympathy = $this->data['sympathy'];
            foreach($this->data['participants'] as $participants){
                if(array_intersect($participants, $sympathy)){
                    $results[] = $participants;
                }
            }
        }

        if($results == null) {
            $this->data['message'] = array();
        }else{
            $this->data['message'] = $results;
        }

        if(!empty($_POST['send'])){
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $headerFields = array(
                "From: AvKube.com",
                "MIME-Version: 1.0",
                "Content-Type: text/html;charset=utf-8"
            );
            $name = $participant[0]['name'];
            $datesId = $participant[0]['id_of_date'];
            $admin = Session::get('admin_id');

            mail($email, $subject, "\r\n\r\n" . $message, implode("\r\n", $headerFields));

            /*SESSION MESSAGES WITH REDIRECT DOES NOT WORK*/

            $this->model->save($name, $email, $datesId, $subject, $message, $admin);
            $this->model->result($id, $admin);

            Session::setFlash('Message with results to <b>' . $email . ' </b> was send succesfully!');
            Router::redirect('/admin/');
        }
    }

    public function admin_reply_page(){
        $params = App::getRouter()->getParams();

        if (isset($params[0])){
            $id = $params[0];
            $this->data['message'] = $this->model->getMessageInfo($id);
            $participant = $this->data['message'];
        }

        if(!empty($_POST['email']) || !empty($_POST['subject']) || !empty($_POST['message'])){
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $headerFields = array(
                "From: AvKube.com",
                "MIME-Version: 1.0",
                "Content-Type: text/html;charset=utf-8"
            );
            $name = $participant[0]['name'];
            $datesId = 0;

            $admin = Session::get('admin_id');

            mail($email, $subject, "\r\n\r\n" . $message, implode("\r\n", $headerFields));;

            /*SESSION MESSAGES WITH REDIRECT DOES NOT WORK*/

            $this->model->save($name, $email, $datesId, $subject, $message, $admin);
            $this->model->changeReplyStatus($id);

            Session::setFlash('Message to <b>' . $email . ' </b> was send succesfully!');
            Router::redirect('/admin/');
        }
    }
}
?>