<?php
class Thread extends Model {
	public function GetCategories() {
		$db = Database::getInstance ();
		$query = 'SELECT tc.*, (SELECT count(th.id) FROM threads th WHERE th.category = tc.id) \'count\' FROM thread_categories tc;';
		$stm = $db->con->prepare ( $query );
		$stm->execute ();
		return $stm->fetchAll ( PDO::FETCH_ASSOC );
	}
	public function GetThreadsByCategory($cat) {
		$db = Database::getInstance ();
		$query = 'SELECT th.id, th.title, th.created, us.username \'owner\', GetPostCount(th.id) \'count\' FROM ';
		$query .= String::Table ( $this->Name() );
		$query .= ' th INNER JOIN users us ON us.id = th.owner';
		$query .= ' WHERE category=:category';
		$stm = $db->con->prepare ( $query );
		$params = array (
				':category' => $cat 
		);
		if ($stm->execute ( $params )) {
			return $stm->fetchAll ( PDO::FETCH_ASSOC );
		}
	}
}