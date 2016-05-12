<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';
	

	function listUsers(){
		return $this->fetchAll()->toArray();
	}
	
	function getUserById($id_user){
		return $this->find($id_user)->toArray();
	}

	function updateUser($userInfo,$id_user){
		$userInfo['password']=md5($userInfo['password']);
		return $this->update($userInfo,'id_user='.$id_user);
	}

	
	function deleteUser($id_user){
		return $this->delete('id_user='.$id_user);
	}


	function addUser($userInfo){
		$row = $this->createRow();

		$row->email = $userInfo['email'];
		// md5 this way for hash password in database
		$row->password = md5($userInfo['password']);
		$row->ban_user=1;
		$row->type=0;
		$row->image=$userInfo['image'];
		$row->gender=$userInfo['gender'];
		$row->country=$userInfo['country'];
		$row->signature=$userInfo['signature'];
		$row->username=$userInfo['username'];


		return $row->save();
	}

	// Count website users by osama ...
	function countUsers(){
		$result = $this->fetchAll()->toArray();
		return count($result);
	}

}

