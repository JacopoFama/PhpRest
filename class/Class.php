<?php
include_once("DBConnection.php");
class ClassCon
{
    protected $db;
    public $_id;
    public $_year;
    public $_section;
 
	public function __construct()
	{
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }
 
    //insert
	public function insert()
	{
		try
		{
    		$sql = 'INSERT INTO class (year, section)  VALUES (:year, :section)';
    		$data = [
			    'year' => $this->_year,
			    'section' => $this->_section
			];
	    	$stmt = $this->db->prepare($sql);
	    	$stmt->execute($data);
			$status = $stmt->rowCount();
            return $status;
 
		} catch (Exception $e)
		{
    		die("Errore: ".$e);
		}
 
    }
   
    // getAll 
    public function list() {
    	try {
    		$sql = "SELECT * FROM class";
		    $stmt = $this->db->prepare($sql);
 
		    $stmt->execute();
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Errore: ".$e);
		}
    }

    // getOne
    public function one() {
    	try {
    		$sql = "SELECT * FROM class WHERE id=:id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id' => $this->_id
			];
		    $stmt->execute($data);
		    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Errore: ".$e);
		}
	}
	
	public function getLast()
	{
		try
		{
    		$sql = "SELECT * FROM class ORDER BY id DESC LIMIT 1";
		    $stmt = $this->db->prepare($sql);
		    $stmt->execute($data);
		    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
		}
		catch (Exception $e)
		{
		    die("Errore: ".$e);
		}
	}
 
	public function delete()
	{
		try
		{
    		$sql = "DELETE FROM student_class WHERE id_class=:id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id' => $this->_id
			];
		    $stmt->execute($data);
			$status = $stmt->rowCount();
			
			$sql = "DELETE FROM class WHERE id=:id";
			$stmt = $this->db->prepare($sql);
		    $data = [
		    	'id' => $this->_id
			];
		    $stmt->execute($data);
			$status = $stmt->rowCount();

            return $status;
		}
		catch (Exception $e)
		{
			die("Errore: ".$e);
		}
    }

	public function patch()
	{
		try
		{
			$data = ['id' => $this->_id];
			$sql = 'UPDATE class SET ';
			
			foreach($this as $key => $value)
			{
				if($value != null && strcmp($key,'db')!=0 && strcmp($key,'id')!=0)
				{
					$key = ltrim($key, "_");
					$sql = $sql . "$key=:$key,";

					$data[$key] = $value;
				}
			}

			$sql = rtrim($sql,",");
			$sql = $sql . " WHERE id=:id";

	    	$stmt = $this->db->prepare($sql);
	    	$stmt->execute($data);
			$status = $stmt->rowCount();
			return $status;
		}
		catch (Exception $e)
		{
    		die("Errore: ".$e);
		}
	}
	
	public function put()
	{
		try
		{
			$sql = 'UPDATE class SET year=:year, section=:section WHERE id=:id';

    		$data = [
				'id' =>$this->_id,
			    'year' => $this->_year,
			    'section' => $this->_section
			];

	    	$stmt = $this->db->prepare($sql);
	    	$stmt->execute($data);
			$status = $stmt->rowCount();
            return $status;
		}
		catch (Exception $e)
		{
    		die("Errore: ".$e);
		}
    }
 
}
?>