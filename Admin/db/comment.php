<?php 
require_once('database.php');
/**
 * 
 */
class comment
{
	private $id;
	private $blog_id;
	private $name;
	private $email;
	private $content;
	private $status; 		 	
	private $created_by_id;
	private $created_date;
	private $Updated_date;
	protected $con;
	
	public function __construct($id=0,$blog_id = 0,$name='',$email='',$content='')
	{
		$this->id = $id;
		$this->blog_id = $blog_id;
		$this->name = $name;
		$this->email = $email;
		$this->content = $content;
		$this->status = 0;
		$this->con = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setBlogId($blog_id){
		$this->blog_id = $blog_id;
	}

	public function getBlogId(){
		return $this->blog_id;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function getContent(){
		return $this->content;
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
			$stm = $this->con->prepare("INSERT INTO blog_comment(blog_id,name,content,email,status,created_date,created_by_id)VALUES(?,?,?,?,?,?,?)");
			$stm->execute([$this->blog_id,$this->name,$this->content,$this->email,$this->status,date('Y-m-d h:t:s'),$this->created_by_id]);
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchAll($pageno=0,$blogId=''){
		try{
			$limit = 4;
			$offset = ($pageno-1)*$limit;
			$sql = "SELECT bc.id as com_id, bc.name as com_name, bc.email as com_email, content, bc.created_by_id as com_craated_by_id, bc.created_date as com_created_date, bc.status as com_status FROM blog_comment as bc";
			if($blogId!=''){
				$sql .= " WHERE bc.blog_id = $blogId";
			}

			if($pageno!=0){
				$paginatedSql = $sql . " LIMIT $limit OFFSET $offset";
				$stmPagi = $this->con->prepare($paginatedSql);
				$stmPagi->execute();
			}
			$stm = $this->con->prepare($sql);
			$stm->execute();

			return ['data'=>$stmPagi->fetchAll(),'total-page'=>ceil($stm->rowCount()/$limit)];
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchOne(){
		try{
			$stm = $this->con->prepare("SELECT bc.name as com_name, bc.email as com_email, content, bc.created_date as com_created_date, username FROM blog_comment as bc JOIN users as u ON bc.created_by_id = u.id WHERE bc.id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function update(){
		try{
			$stm = $this->con->prepare("UPDATE blog_comment set name = ?,content = ?,email = ?, updated_date = ? WHERE id = ?");
			$stm->execute([$this->name,$this->content,$this->email,date('Y-m-d h:t:s'),$this->id]);
			echo "<script>document.location = 'commentlist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function delete(){
		try{
			$stm = $this->con->prepare("DELETE FROM blog_comment WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
			echo "<script>document.location = 'commentlist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchCreatedBy(){
		try{
			$stm = $this->con->prepare("SELECT username FROM blog_comment JOIN users ON blog_comment.created_by_id = users.id WHERE blog_comment.id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll()[0];
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function changeStatus(){
		try{
			$stm = $this->con->prepare("UPDATE blog_comment set status = ? WHERE id = ?");
			$stm->execute([$this->status,$this->id]);
			echo "<script>document.location = 'commentlist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
}