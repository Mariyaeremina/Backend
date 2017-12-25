<?php

class catController extends Controller {

    public function index(){
        $cat=$this->model->load();		// просим у модели все записи
        $this->setResponse($cat);		// возвращаем ответ
    }

    public function view($data){
        $cat=$this->model->load($data['id']); // просим у модели конкретную запись
        $this->setResponse($cat);
    }

    public function add(){
        $postData=json_decode(file_get_contents('php://input'), true);
        if( (isset($postData['id'])) && (isset($postData['name'])) && (isset($postData['image'])) && (isset($postData['power'])) && (isset($postData['speed'])) ){
            // мы передаем в модель массив с данными
            // модель должна вернуть boolean
            $dataToSave=array('id'=>$postData['id'], 'name'=>$postData['name'], 'image'=>$postData['image'], 'power'=>$postData['power'], 'speed'=>$postData['speed']);
            $addedItem=$this->model->create($dataToSave);
            $this->setResponse($addedItem);
        }
    }

    public function edit($data) {
        $postData=json_decode(file_get_contents('php://input'), true);
        if( (isset($postData['id'])) && (isset($postData['name'])) && (isset($postData['image'])) && (isset($postData['power'])) && (isset($postData['speed']))) {
            // мы передаем в модель массив с данными
            // модель должна вернуть boolean
            $dataToUpdate=array('id'=>$postData['id'], 'name'=>$postData['name'], 'image'=>$postData['image'], 'power'=>$postData['power'], 'speed'=>$postData['speed']);
            $updatedItem=$this->model->save($data['id'], $dataToUpdate);
            $this->setResponse($updatedItem);
        }
    }

    public function delete($data) {
        $deletedItem = $this->model->delete($data['id']);
        $this->setResponse($deletedItem);
    }

}