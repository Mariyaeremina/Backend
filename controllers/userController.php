<?php

class userController extends Controller {

    public function index(){
        $users=$this->model->load();		// просим у модели все записи
        $this->setResponse($users);		// возвращаем ответ
    }

    public function view($data){
        $user=$this->model->load($data['id']); // просим у модели конкретную запись
        $this->setResponse($user);
    }

    public function add(){
        $postData=json_decode(file_get_contents('php://input'), TRUE);
        if(isset($postData['id']) && isset($postData['name']) && isset($postData['score'])){
            // мы передаем в модель массив с данными
            // модель должна вернуть boolean
            $dataToSave=array('id'=>$postData['id'], 'name'=>$postData['name'], 'score'=>$postData['score']);
            $addedItem=$this->model->create($dataToSave);
            $this->setResponse($addedItem);
        }
    }

    public function edit($data) {
        $postData=json_decode(file_get_contents('php://input'));
        if(isset($postData['id']) && isset($postData['name']) && isset($postData['score'])){
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