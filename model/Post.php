<?php
class Post extends Model {
	public function GetPostsByThread($thread) {
		$db = Database::getInstance();
		$query = 'SELECT p.id, p.created, p.text, u.username, u.accesslevel FROM  posts p';
		$query .= ' INNER JOIN users u ON u.id = p.owner';
		$query .= ' WHERE thread=:thread';
		$params = array(':thread'=>$thread);
		$stm = $db->con->prepare($query);
		if ($stm->execute($params)) {
			return $stm->fetchAll(PDO::FETCH_ASSOC);
		} else {
			return false;
		}
	}
	public function GetFrontPage() {
		$db = Database::getInstance();
		$query = 'CALL GetFrontPage();';
		$stm = $db->con->prepare($query);
		if ($stm->execute()) {
			return $stm->fetchAll(PDO::FETCH_ASSOC);
		} else {
			return false;
		}
	}
}