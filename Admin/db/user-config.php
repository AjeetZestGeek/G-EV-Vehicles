<?php 
require_once('database.php');
/**
 * 
 */
class userConfig
{
	private $id;
	private $phone;
	private $username; 		 	
	private $email;
	private $password;
	private $status;
	protected $con;
	
	public function __construct($id=0,$phone=0,$username='',$email='',$password='')
	{
		$this->id = $id;
		$this->phone = $phone;
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
		$this->status = 0;
		$this->con = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setPhone($phone){
		$this->phone = $phone;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getUsername(){
		return $this->username;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setPassword($password){
		$this->password = md5(md5(md5($password).'te').md5(md5($password).'sla').md5($password));
	}

	public function getPassword(){
		return $this->password;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getStatus(){
		return $this->status;
	}

	public function insertData(){
		try{
			$stm = $this->con->prepare("INSERT INTO users(phone,username,email,password,status)VALUES(?,?,?,?,?)");
			$stm->execute([$this->phone,$this->username,$this->email,$this->password,$this->status]);
			echo "<script>document.location = 'userlist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchAll(){
		try{
			$stm = $this->con->prepare("SELECT * FROM users");
			$stm->execute();
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchOne(){
		try{
			$stm = $this->con->prepare("SELECT * FROM users WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function update(){
		try{
			$stm = $this->con->prepare("UPDATE users set username = ?, email = ?,phone = ? WHERE id = ?");
			$stm->execute([$this->username,$this->email,$this->phone,$this->id]);
			echo "<script>document.location = 'userlist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function delete(){
		try{
			$stm = $this->con->prepare("DELETE  FROM users WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
			echo "<script>document.location = 'userlist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function changeStatus(){
		try{
			$stm = $this->con->prepare("UPDATE users set status = ? WHERE id = ?");
			$stm->execute([$this->status,$this->id]);
			echo "<script>document.location = 'userlist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function login(){
		try{
			$state = ['isVerified'=>false,'state'=>true];
			$stm = $this->con->prepare("SELECT * FROM users WHERE (username = ? OR email = ?) AND password = ?");
			$stm->execute([$this->username,$this->username,$this->password]);
			$loginData = $stm->fetchAll()[0];
			if($stm->rowCount()==1){
				if($loginData['status']==1){
					$_SESSION['user_data'] = $loginData;
					$state['isVerified'] = true;
					return $state;
				}else{
					return $state;
				}
			}else{
				$state['state'] = false;
				return $state;
			}
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
}