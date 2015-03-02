<?php
class Card extends Model {
	public function GetDB() {
    return DBMTG::GetInstance();
}

public function Search($string) {
    $db = $this->GetDB();
    $query = 'SELECT * FROM cards WHERE name LIKE :name';
    $stm = $db->con->prepare ( $query );
    $params[':name'] = "%$string%";
    if ($stm->execute($params)) {
        return $stm->fetchAll ( PDO::FETCH_ASSOC );
    } else {
        return false;
    }
}
}