<?php


try {
    $pdo = new PDO("mysql:dbname=iran;host=localhost", 'root', '');
    $pdo->exec("set names utf8;");

} catch (PDOException $e) {

    die('Connection failed: ' . $e->getMessage());
}



#==============  Simple Validators  ================
function isValidCity($data){
    if(empty($data['province_id']) or !is_numeric($data['province_id']))
        return false;
    return empty($data['name']) ? false : true;
}



#================  Read Operations  =================
function getCities($data = null){
    global $pdo;
    $province_id=$data['province_id']??null;
    $page=$data['page']??null;
    $page_size=$data['page_size']??null;
    $fields=$data['fields']?? "*";
    $limit='';
    $where='';

    if(is_numeric($page) and is_numeric($page_size)){
        $start=($page-1) * $page_size;
        $limit=" LIMIT $start,$page_size";
    }

    if(is_numeric($province_id) and !is_null($province_id)){
        
        $where=" where province_id={$province_id}";
    }

    $sql = "select $fields from city $where $limit ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}





#================  Create Operations  =================
function addCity($data){
    global $pdo;
    if(!isValidCity($data)){
        return false;
    }
    $sql = "INSERT INTO `city` (`province_id`, `name`) VALUES (:province_id, :name);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':province_id'=>$data['province_id'],':name'=>$data['name']]);
    return $stmt->rowCount();
}



#================  Update Operations  =================
function changeCityName($city_id,$name){
    global $pdo;
    $sql = "update city set name = '$name' where id = $city_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}


#================  Delete Operations  =================
function deleteCity($city_id){
    global $pdo;
    $sql = "delete from city where id = $city_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}




