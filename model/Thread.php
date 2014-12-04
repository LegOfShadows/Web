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
		$query = 'SELECT * FROM ';
		$query .= String::Table ( $this->Name() );
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