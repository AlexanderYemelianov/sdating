<?php

class PhotosController extends Controller {

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Photo();
    }

    public function index(){
        $this->data['photos'] = $this->model->getAllPhotoArchives();
    }

    public function admin_index(){
        $this->data['photos'] = $this->model->getAllPhotoArchives();
        $this->data['dateId'] = $this->model->getDateId();

        /*Check and create new directory for new photo archive*/

        if(!empty($_POST['archiveName'])){

            $fullDir = ROOT.DS.'webroot'. DS .'img'. DS . $_POST['archiveName'] . DS;
            $dir = $_POST['archiveName'];
            $dateId = $_POST['dateId'][0];

            if(is_dir($fullDir)){
                Session::setFlash('Directory: <b>' . $fullDir . '</b> is already exist.');
            }else{
                mkdir($fullDir);
            }

            if(!empty($_FILES)){

                /*Check $_FILES['type'] with whiteList*/
                $whiteList = array('image/jpg','image/gif','image/bmp','image/png', 'image/jpeg');

                foreach($_FILES['picture']['tmp_name'] as $fileName){
                    $fileType = getimagesize($fileName);
                    $result = in_array(strtolower($fileType['mime']), $whiteList);
                    if(empty($result)){
                        Session::setFlash('Only jpg/gif/bmp/png/jpeg is allowed!');
                        exit;
                    }
                }


                foreach($_FILES['picture']['error'] as $key => $error)
                {
                    if($error == UPLOAD_ERR_OK)
                    {
                        $tmp_name = $_FILES["picture"]["tmp_name"][$key];
                        $name = $_FILES["picture"]["name"][$key];
                        if(is_uploaded_file($tmp_name))
                        {
                            if (move_uploaded_file($tmp_name, $fullDir.$name))
                            {
                                /*You should to do something with this horror with 100500 INSERTS*/
                                $this->model->addImgPathToDB($name, $dir, $dateId);
                                Session::setFlash("Upload successful!");
                            } else {
                                Session::setFlash("Error while uploading the file, Please contact the webmaster.");
                                exit;
                            }
                        }
                        else
                        {
                            Session::setFlash("Error while uploading the file, Please contact the webmaster.");
                            exit;
                        }
                    }
                    else
                    {
                        $error = $_FILES['picture']['error'];
                        Session::setFlash('Error with file upload. Number of error: <b>' . $error . '</b>.');
                        exit;
                    }
                }
             }
        }
    }

    public function photo_archive(){

        $params = App::getRouter()->getParams();

        if (isset($params[0])){
            $id = $params[0];
            $this->data['photos'] = $this->model->getAllPhotoFromArchive($id);
        }
    }

    public function admin_photo_archive(){

        $params = App::getRouter()->getParams();

        if (isset($params[0])){
            $id = $params[0];
            $this->data['photos'] = $this->model->getAllPhotoFromArchive($id);
        }
    }

    public function admin_delete(){

       if(isset($this->params[0])){
            $result = $this->model->delete($this->params[0]);
            if($result){
                Session::setFlash('Photo was deleted.');
            } else {
                Session::setFlash('Error.');
            }
        }
        Router::redirect('/admin/photos/');
    }
}
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 17.03.2016
 * Time: 20:22
 */ 