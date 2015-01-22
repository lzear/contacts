 <?php
class Contact {
	public $contactid = null;
	public $userid = null;
	public $contactName = null;
	public $phone = null;
	public $email = null;
	public $address = null;
	public $note = null;
	public $status = null;
	public $timestamp = null;
    
	public function __construct( $data=array() ) {
		if ( isset( $data['contactid'] ) )	$this->contactid = $data['contactid'];
		if ( isset( $data['contactName'] ) )	$this->contactName = $data['contactName'];
		if ( isset( $data['phone'] ) )	$this->phone = $data['phone'];
		if ( isset( $data['email'] ) )	$this->email = $data['email'];
		if ( isset( $data['address'] ) )$this->address = $data['address'];
		if ( isset( $data['note'] ) )	$this->note = $data['note'];
		$this->userid = isset( $_SESSION['userid'] ) ? $_SESSION['userid'] : "";
	}
	
	public static function fetchByUserid( $userid ) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT * FROM contacts WHERE userid = :userid ORDER BY contactName LIMIT 100";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":userid", $userid, PDO::PARAM_INT );
		$st->execute();
		
		$list = array();
		while ( $row = $st->fetch() ) {
			$contact = new Contact( $row );
			$list[] = $contact;
		}
		$conn = null;
		return $list;
	}
	
	public function insert() {
		try{
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO contacts ( userid, contactName, phone, email, address, note)
			VALUES (:userid, :contactName, :phone, :email, :address, :note)";
			$st = $conn->prepare ( $sql );
			$st->bindValue( ":userid", $this->userid, PDO::PARAM_INT );
			$st->bindValue( ":contactName", $this->contactName, PDO::PARAM_STR );
			$st->bindValue( ":phone", $this->phone, PDO::PARAM_STR );
			$st->bindValue( ":email", $this->email, PDO::PARAM_STR );
			$st->bindValue( ":address", $this->address, PDO::PARAM_STR );
			$st->bindValue( ":note", $this->note, PDO::PARAM_STR );
			$st->execute();
			$this->contactid = $conn->lastInsertId();
			
			$conn = null;
			
			return $this->contactid ;
		}
		catch (Exception $e){
			echo $this->getError();

			return false;
		}
	}
	
	/*
	public function edit($contactid) {
		try{
			
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "UPDATE contacts SET contactName=:contactName, phone=:phone, email=:email, address=:address, note=:note, timestamp=:timestamp WHERE contactid = :contactid";
			$st->bindValue( ":contactName", $this->contactName, PDO::PARAM_INT );
			$st->bindValue( ":phone", $this->phone, PDO::PARAM_INT );
			$st->bindValue( ":email", $this->email, PDO::PARAM_INT );
			$st->bindValue( ":address", $this->address, PDO::PARAM_INT );
			$st->bindValue( ":note", $this->note, PDO::PARAM_INT );
			$st->bindValue( ":timestamp", time(), PDO::PARAM_INT );
			$st->bindValue( ":contactid", $contactid, PDO::PARAM_INT );
			$r = $st->execute();
			$conn = null;
			
			return $r ;
		}
		catch (Exception $e){
			echo $this->getError();
			return -1;
		}
	}
	*/
	
	public static function deleteByContactid($contactid, $userid) {
		try{
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "DELETE FROM contacts WHERE contactid = :contactid AND userid=:userid";
			$st = $conn->prepare ( $sql );
			$st->bindValue( ":contactid", $contactid, PDO::PARAM_INT );
			$st->bindValue( ":userid", $userid, PDO::PARAM_INT );
			$r = $st->execute();
			$conn = null;
			return $r ;
		}
		catch (Exception $e){
			echo $this->getError();
			return -1;
		}
	}
	
	public function filter() {
		$this->contactName = filter_var($this->contactName, FILTER_SANITIZE_STRING);
		$this->phone = filter_var($this->phone, FILTER_SANITIZE_STRING);
		$this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
		$this->address = filter_var($this->address, FILTER_SANITIZE_STRING);
		$this->note = filter_var($this->note, FILTER_SANITIZE_STRING);
	}
	
	public static function insertFromPOST( $post ) {
		$contact = new Contact( $post );
		$contact->filter() ;
		return $contact->insert();
	}
}
?>
 

