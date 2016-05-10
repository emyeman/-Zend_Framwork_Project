<?php

class TypematerialsController extends Zend_Controller_Action
{
    private $model;

    public function init(){
        /* Initialize action controller here */
	$this->model = new Application_Model_DbTable_Typematerials();
    }
    
    public function indexAction()
    {
     	$this->view->typematerials = $this->model->listTypematerials();

    }
    
    public function addtypematAction(){
        $ids = $this->getRequest()->getParams();
        $id_type=$ids['id_type'];
        $course_id=$ids['course_id'];
        
    	$form = new Application_Form_addtypemat();
        if($this->getRequest()->isPost()){
            if($form->isValid($this->getRequest()->getParams())){
            $data = $form->getValues();
            if ($this->model->addTypematerial($data))
               $this->redirect('materials/single/course_id/'.$course_id.'/id_type/'.$id_type);

            }

        }
        $this->view->form = $form;

    }
    
    public function deleteAction() {
        $ids = $this->getRequest()->getParams();
        $id_type=$ids['id_type'];
        $course_id=$ids['course_id'];
        if($this->model->deleteTypematerial($id_type))
        $this->redirect('materials/single/course_id/'.$course_id.'/id_type/'.$id_type);
    }


	function editAction(){
            $ids = $this->getRequest()->getParams();
            $id_type=$ids['id_type'];
            $course_id=$ids['course_id'];
            $tymats = $this->model->getTypematerialById($id_type);
            $form = new Application_Form_addtypemat();
            $form->populate($tymats[0]);
            if($this->getRequest()->isPost()){
                if($form->isValid($this->getRequest()->getParams())){
                $data = $form->getValues();
                // var_dump($datas);
                if($this->model->updateTypematerial($data,$id_type))
                 $this->redirect('materials/single/course_id/'.$course_id.'/id_type/'.$id_type);
                }
            }
            $this->view->form = $form;
            $this->render('addtypemat');

	} 


}

