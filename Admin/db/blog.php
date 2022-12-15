<?php 
require_once('database.php');
/**
 * 
 */
class blog
{
	private $id;
	private $title;
	private $category_id;
	private $content;
	private $image;
	private $status; 		 	
	private $created_by_id;
	private $created_date;
	private $Updated_date;
	protected $con;
	
	public function __construct($id=0,$title='',$category_id='',$image='',$content='')
	{
		$this->id = $id;
		$this->title = $title;
		$this->category_id = $category_id;
		$this->content = $content;
		$this->image = $image;
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

	public function setCategoryId($category_id){
		$this->category_id = $category_id;
	}

	public function getCategoryId(){
		return $this->category_id;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function getContent(){
		return $this->content;
	}

	public function setImage($image){
		$this->image = $image;
	}

	public function getImage(){
		return $this->image;
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
			$stm = $this->con->prepare("INSERT INTO blog_post(title,content,category_id,image,status,created_date,created_by_id)VALUES(?,?,?,?,?,?,?)");
			$stm->execute([$this->title,$this->content,$this->category_id,$this->image,$this->status,date('Y-m-d h:t:s'),$this->created_by_id]);
			echo "<script>document.location = 'bloglist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchAll($pageno=1,$cat='',$query=''){
		try{
			$limit = 4;
			$offset = ($pageno-1)*$limit;
			$sql = "SELECT bp.id as blog_id, bp.title as blog_title, content, image, bp.created_by_id as blog_craated_by_id, bp.created_date as blog_created_date, bp.status as blog_status, bc.title as category_title, username FROM blog_post as bp JOIN blog_categary as bc ON bp.category_id = bc.id JOIN users as u ON bp.created_by_id = u.id";
			if($cat!=''){
				$sql .= " WHERE bp.category_id = $cat";
			}

			if($query!=''){
				$sql .= " AND (bp.title LIKE '%$query%' OR bp.created_date LIKE '%$query%' OR bc.title LIKE '%$query%' OR u.username LIKE '%$query%')";
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
			$stm = $this->con->prepare("SELECT bp.category_id as blog_category_id, bp.title as blog_title, content, image, bp.created_date as blog_created_date, username FROM blog_post as bp JOIN users as u ON bp.created_by_id = u.id WHERE bp.id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function update(){
		try{
			$stm = $this->con->prepare("UPDATE blog_post set title = ?,content = ?,category_id = ?, image = ?, updated_date = ? WHERE id = ?");
			$stm->execute([$this->title,$this->content,$this->category_id,$this->image,date('Y-m-d h:t:s'),$this->id]);
			echo "<script>document.location = 'bloglist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function delete(){
		try{
			$stm = $this->con->prepare("DELETE  FROM blog_post WHERE id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll();
			echo "<script>document.location = 'bloglist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function fetchCreatedBy(){
		try{
			$stm = $this->con->prepare("SELECT username FROM blog_post JOIN users ON blog_post.created_by_id = users.id WHERE blog_post.id = ?");
			$stm->execute([$this->id]);
			return $stm->fetchAll()[0];
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}

	public function changeStatus(){
		try{
			$stm = $this->con->prepare("UPDATE blog_post set status = ? WHERE id = ?");
			$stm->execute([$this->status,$this->id]);
			echo "<script>document.location = 'bloglist.php'</script>";
		}
		catch(Exception $e){
			return $e->getMessage();
		}
	}
}