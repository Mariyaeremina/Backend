<?php

class catController extends Controller {

    public function index(){
        $examples=$this->model->load();		// просим у модели все записи
        $this->setResponce($examples);		// возвращаем ответ
    }

    public function view($data){
        $example=$this->model->load($data['id']); // просим у модели конкретную запись
        $this->setResponce($example);
    }

    public function add(){
        if( (isset($_POST['id'])) && (isset($_POST['name'])) && (isset($_POST['image'])) && (isset($_POST['power'])) && (isset($_POST['speed'])) ){
            // мы передаем в модель массив с данными
            // модель должна вернуть boolean
            $dataToSave=array('id'=>$_POST['id'], 'name'=>$_POST['name'], 'image'=>$_POST['image'], 'power'=>$_POST['power'], 'speed'=>$_POST['speed']);
            $addedItem=$this->model->create($dataToSave);
            $this->setResponce($addedItem);
        }
    }

    public function edit($data) {
        $_PUT=json_decode(file_get_contents('php://input'));
        if( (isset($_POST['id'])) && (isset($_POST['name'])) && (isset($_POST['image'])) && (isset($_POST['power'])) && (isset($_POST['speed']))) {
            // мы передаем в модель массив с данными
            // модель должна вернуть boolean
            $dataToUpdate=array('id'=>$_POST['id'], 'name'=>$_POST['name'], 'image'=>$_POST['image'], 'power'=>$_POST['power'], 'speed'=>$_POST['speed']);
            $updatedItem=$this->model->save($dataToUpdate, $data['id']);
            $this->setResponce($updatedItem);
        }
    }

    public function delete($data) {
        $deletedItem = $this->model->delete($data['id']);
        $this->setResponce($deletedItem);
    }

}