 <?php
class User {
	public $userid = null;
	public $username = null;
    
	public function __construct( $data=array() ) {
		if ( isset( $data['userid'] ) )		$this->userid = (int) $data['userid'];
		if ( isset( $data['username'] ) )	$this->username = $data['username'];
	}
	
	public static function fetchByLogin( $username , $password) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT userid, username FROM users WHERE username = :username AND password = :password LIMIT 1";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":username", $username, PDO::PARAM_STR );
		$st->bindValue( ":password", $password, PDO::PARAM_STR);
		$st->execute();
		$row = $st->fetch();
		$conn = null;
		if ($row) return new User( $row );
	}
	
	public static function fetchByUsername( $username ) {//Duy
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT userid, username FROM users WHERE username = :username LIMIT 1";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":username", $username, PDO::PARAM_STR );
		$st->execute();
		$row = $st->fetch();
		$conn = null;
		if ($row) return new User( $row );
	}
	
	public static function fetchByUserid( $userid ) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT userid, username FROM users WHERE userid = :userid LIMIT 1";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":userid", $userid, PDO::PARAM_STR );
		$st->execute();
		$row = $st->fetch();
		$conn = null;
		if ($row) return new User( $row );
	}
	
	public function insert() {
		
		try{	
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO users ( username, password) VALUES ( :username, :password)";
			$st = $conn->prepare ( $sql );
			$st->bindValue( ":username", $this->username, PDO::PARAM_STR );
			$st->bindValue( ":password", $this->password, PDO::PARAM_STR );
			$st->execute();
			$this->userid = $conn->lastInsertId();
			$conn = null;
			return $this->userid ;
		}
		catch (Exception $e){
			echo $this->getError();

			return false;
		}
		
	}
}
?>
 

