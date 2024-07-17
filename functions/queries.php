<?php
$dbh = new PDO('pgsql:host='.$_ENV['DB_HOST'].';port='.$_ENV['DB_PORT'].';dbname='.$_ENV['DB_NAME'].'
    ;user='.$_ENV['DB_USER'].';password='.$_ENV['DB_PASS'].'');

function indexQuery($table,$params,$indexFilters=array(),$order="DESC") {
    // $dbh = new PDO('pgsql:host='.$_ENV['DB_HOST'].';port='.$_ENV['DB_PORT'].';dbname='.$_ENV['DB_NAME'].'
    // ;user='.$_ENV['DB_USER'].';password='.$_ENV['DB_PASS'].'');
    global $dbh;
    try {
        $queryCount = "SELECT COUNT(*) FROM " . $table;
        $queryRow = "SELECT * FROM " . $table;
        $queryParameters = $params;
        unset($queryParameters["max"]);
        unset($queryParameters["offset"]);
        $queryParametersKeys = array_keys($queryParameters);
        $queryParametersLength = count($queryParametersKeys);
        if($queryParametersLength > 0) {
            for($i = 0; $i < $queryParametersLength; $i++) {
                $filterIndex = array_search($queryParametersKeys[$i], $indexFilters);
                $filterKey=$queryParametersKeys[$filterIndex];
                if($filterKey !== false) {
                    if(isset($queryParameters[$filterKey]) && !empty($queryParameters[$filterKey])){
                        $value=$queryParameters[$filterKey];
                        switch(gettype($params[$filterKey])){
                            case 'string':
                                if($i === 0) {
                                    $queryCount .= " WHERE " . $filterKey . " ILIKE '" . $value . "%'";
                                    $queryRow .= " WHERE " . $filterKey . " ILIKE '" . $value . "%'";
                                } else {
                                    $queryRow .= " AND";
                                    $queryCount .= " AND";
                                    $queryCount .= " " . $filterKey . " ILIKE '" . $value . "%'";
                                    $queryRow .= " " . $filterKey . " ILIKE '" . $value . "%'";
                                }
                                break;
                            case "integer":
                            case "double":
                                if($i === 0) {
                                    $queryCount .= " WHERE " . $filterKey . " BETWEEN " . ($value - $value * 0.1) . " AND " . ($value + $value * 0.1);
                                    $queryRow .= " WHERE " . $filterKey . " BETWEEN " . ($value - $value * 0.1) . " AND " . ($value + $value * 0.1);
                                } else {
                                    $queryRow .= " AND";
                                    $queryCount .= " AND";
                                    $queryCount .= " " . $filterKey . " BETWEEN " . ($value - $value * 0.1) . " AND " . ($value + $value * 0.1);
                                    $queryRow .= " " . $filterKey . " BETWEEN " . ($value - $value * 0.1) . " AND " . ($value + $value * 0.1);
                                }
                                break;
                            case "boolean":
                                if($i === 0) {
                                    $queryCount .= " WHERE " . $filterKey . " IS " . ($value ? 'true' : 'false');
                                    $queryRow .= " WHERE " . $filterKey . " IS " . ($value ? 'true' : 'false');
                                } else {
                                    $queryRow .= " AND";
                                    $queryCount .= " AND";
                                    $queryCount .= " " . $filterKey . " IS " . ($value ? 'true' : 'false');
                                    $queryRow .= " " . $filterKey . " IS " . ($value ? 'true' : 'false');
                                }
                                break;
                        }
                    }
                } else {
                    continue;
                }
            }
        }
        $queryRow .= ' ORDER BY _id '.$order;
        if(isset($params['max']) && isset($params['offset'])) {
            $queryRow .= " LIMIT " . $params['max'] . " OFFSET " . $params['offset'];
        }
        $stmt=$dbh->prepare($queryRow);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmtc=$dbh->prepare($queryCount);
        $stmtc->execute();
        $count=$stmtc->fetchAll();
        return array("results"=>$data,"count"=>$count);
        // $count = $this->pool->query($queryCount)->fetchColumn();
        // $row = $this->pool->query($queryRow)->fetchAll(PDO::FETCH_ASSOC);
        // return $this->_utils->setIndexResponse($count, $row);
    } catch (Exception $error) {
        return array('error' => true, 'failure' => $error->getMessage());
    }
}
function getQuery($table,$id){
    try{
        global $dbh;
        $query="SELECT * FROM ".$table." WHERE _id= :_id";
        $stmt=$dbh->prepare($query);
        $stmt->bindValue(":_id",$id);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $data;        
    }catch(Exception $error){
        return array('error' => true, 'failure' => $error->getMessage());
    }
}
function postQuery($table,$data){
    try{
        global $dbh;
        $data = (array)$data;
        $keys = array_keys($data);
        $columnsQuery = implode(", ", $keys);
        $valuesQuery = ":" . implode(", :", $keys);
        $query = "INSERT INTO {$table} ({$columnsQuery}) VALUES ({$valuesQuery}) RETURNING *";
        $stmt = $dbh->prepare($query);
        foreach ($data as $key => &$value) {
            $stmt->bindValue(':'.$key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $query;
    }catch(Exception $error){
        return array('error' => true, 'failure' => $error->getMessage());
    }
}
function putQuery($table,$data,$id){
    try {
        global $dbh;
    $data=(array)$data;
    $keys=array_keys($data);
    $sets="";
    foreach($data as $key=>$value ){
        $sets.= "{$key}=:{$key}, ";
    };
    $sets=rtrim($sets,", ");
    $query="UPDATE {$table} SET {$sets} WHERE _id=:_id RETURNING *";
    $stmt = $dbh->prepare($query);
        foreach ($data as $key => &$value) {
            $stmt->bindValue(':'.$key, $value);
        }
    $stmt->bindValue(':_id',$id);
    $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // return $query;
    } catch (Exception $error) {
        return array('error' => true, 'failure' => $error->getMessage());
    }
    
}

function deleteQuery($table,$id){
    try {
        global $dbh;
        $query="DELETE FROM {$table} WHERE _id=:_id";
        $stmt=$dbh->prepare($query);
        $stmt->bindValue(':_id',$id);
        $stmt->execute();
        return array('error'=>false,'message'=>"Row/document deleted successfully");
    } catch (Exception $error) {
        return array('error' => true, 'failure' => $error->getMessage());
    }
    

}

?>