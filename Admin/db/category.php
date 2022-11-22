<?php 
require_once('database.php');
/**
 * 
 */
class category
{
	private $id;
	private $title;
	private $status; 		 	
	private $created_by_id;
	private $created_date;
	private $Updated_date;
	protected $con;
	
	public function __construct($id=0,$title='')
	{
		$this->id = $id;
		$this->title = $title;
		$this->status = 0;
		$this->con = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setCreatedBy($created_by_id){
		$this->created_by_id = $created_by_id;
	}

	public function getCreatedBy(){
		return $this->created_by_id;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getStatus(){
		return $this->status;
	}

	public function insertData(){
		try{
			$stm = $this->con->prepare("INSERT INTO blog_categary(title,status,created_date,created_by_id)VALUES(?,?,?,?)");
			$stm->execute([$this->title,$this->status,date('Y-m-d h:t:s'),$this->created_by_id]);
			echo "<script>alert('Data saved successfully');document.location = 'blogCategory.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchAll(){
		try{
			$stm = $this->con->prepare("SELECT * FROM blog_categary");
			$stm->execute();
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchOne(){
		try{
			$stm = $this->con->prepare("SELECT * FROM blog_categary WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function update(){
		try{
			$stm = $this->con->prepare("UPDATE blog_categary set title = ?, updated_date = ? WHERE id = ?");
			$stm->execute([$this->title,date('Y-m-d h:t:s'),$this->id]);
			echo "<script>alert('Data updated successfully');document.location = 'blogCategory.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function delete(){
		try{
			$stm = $this->con->prepare("DELETE  FROM blog_categary WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
			echo "<script>alert('Data deleted successfully');document.location = 'blogCategory.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchCreatedBy(){
		try{
			$stm = $this->con->prepare("SELECT username FROM blog_categary JOIN users ON blog_categary.created_by_id = users.id WHERE blog_categary.id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll()[0];
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
}