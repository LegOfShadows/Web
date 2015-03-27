<?php
class Card extends Model {
	public function GetDB() {
    return DBMTG::GetInstance();
}

public function Search($string) {
    $db = $this->GetDB();
	$query = "SELECT c.id, c.name, c.cost, c.cmc, c.colors,c.text,c.power,c.toughness,c.loyalty,x.type,z.`set` FROM cards c ";
	$query .= "LEFT JOIN (SELECT ct.id as id, group_concat(name ORDER BY level ASC) as type FROM cardtypes ct GROUP BY ct.id) x ON x.id = c.id ";
	$query .= "LEFT JOIN (SELECT cs.id as id, group_concat(name) as 'set' FROM cardsets cs GROUP BY cs.id) z on z.id = c.id ";
	$query .= "WHERE name LIKE :name";
    $stm = $db->con->prepare ( $query );
    $params[':name'] = "%$string%";
    if ($stm->execute($params)) {
        return $stm->fetchAll ( PDO::FETCH_ASSOC );
    } else {
        return false;
    }
}
}