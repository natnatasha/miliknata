<?php

    $username = "root";
    $password = "";
    $database = "cbtproduktif";
    $hostname = "localhost";
    $con = mysqli_connect($hostname,$username,$password,$database) or die("Connection Corrupt");

    
    class CRUD{
        
        public function login($username,$password){
            global $con;
            
            $sql = "SELECT * FROM tb_user WHERE username ='$username'";
            $query = mysqli_query($con,$sql);
            $rows  = mysqli_num_rows($query);
            $assoc = mysqli_fetch_assoc($query); 
            if($rows > 0){
                if(base64_decode($assoc['password']) == $password){
                    return ['response'=>'positive','alert'=>'Berhasil Login','user_role'=>$assoc['user_role'],'rayon'=>$assoc['rayon']];
                }else{
                    return ['response'=>'negative','alert'=>'Password Salah'];    
                }
            }else{
                
                return ['response'=>'negative','alert'=>'Username atau Password Salah'];
            }
        }

        public function register($id,$name,$username,$password,$confirm,$level,$rayon = "",$redirect){
            
            global $con;
            
            if($id == " " || empty($id) ||  empty($name) || $name == " " || empty($username) || $username == " " || empty($password) || $password == " "){
                return ['response'=>'negative','alert'=>'Lengkapi Form'];
            }
            
            $sql     = "SELECT * FROM tb_user WHERE username = '$username'";
            $query   = mysqli_query($con,$sql);
            
            $rows    = mysqli_num_rows($query);

            if(strlen($username) > 14){
                return ['response'=>'negative','alert'=>'Username maksimal 14 huruf']; 
            }

            $hue     = "SELECT * FROM tb_user WHERE rayon = '$rayon'";
            $hua   = mysqli_query($con,$hue);
            
            $row    = mysqli_num_rows($hua);

            if($row > 0){
                return ['response'=>'negative','alert'=>'Rayon '.$rayon.' sudah ada pembimbingnya!']; 
            }
            
            if($rows == 0){
                
                $name     = htmlspecialchars($name);
                
                $username = strtolower(htmlspecialchars($username));
                $password = htmlspecialchars($password);
                $confirm  = htmlspecialchars($confirm);
                
                if($password == $confirm){
                    $password = base64_encode($password);
                    $sql = "INSERT INTO tb_user VALUES('$id','$name','$username','$password','$level','$rayon')";
                    $query   = mysqli_query($con,$sql);
                    if($query){
                        return ['response'=>'positive','alert'=>'Registrasi Berhasil','redirect'=>$redirect];
                    }else{
                        
                        return ['response'=>'negative','alert'=>'Registrasi Error'];
                    }
                }else{
                    
                    return ['response'=>'negative','alert'=>'Password Tidak Cocok'];
                }
            
            }else if($rows == 1){
                
                return ['response'=>'negative','alert'=>'Username telah digunakan'];
            }

        }

        
        public function sessionCheck(){
            if(!isset($_SESSION['username'])){
                
                return "false";
            }else{
                
                return "true";
            }
        }

        
        public function deniedRequest(){
            if(!isset($denied)){
                return "true";
            }else{
                return "false";
            }
        }

        
        public function logout(){
            session_destroy();
            header("Location:index.php");
        }


        public function querySelect($sql){
            global $con;
            @$query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }

        
        public function select($table){
            global $con;
            $sql = "SELECT * FROM $table";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }

        
        public function selectWhere($table,$where,$whereValues){
            global $con;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectDoubleWhere($table,$where,$whereValues,$where1,$whereValues1){
            global $con;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues' AND $where1 = '$whereValues1'";
            $query = mysqli_query($con,$sql);
            $data = [];
            while ($datas = mysqli_fetch_assoc($query)) {
                $data[] = $datas;
            }

            return $data;
        }

        
        public function selectWhereOptional($table,$where,$whereValues,$optional){
            global $con;
            $sql = "SELECT $optional FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectMax($table,$namaField){
            global $con;
            $sql = "SELECT MAX($namaField) as max FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectMin($table,$namaField){
            global $con;
            $sql = "SELECT MIN($namaField) as min FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectSum($table,$namaField){
            global $con;
            $sql = "SELECT SUM($namaField) as sum FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectSumWhere($table,$namaField,$where){
            global $con;
            $sql = "SELECT SUM($namaField) as sum FROM $table WHERE $where";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
            // mamang
        }

        public function selectCount($table,$namaField){
            global $con;
            $sql = "SELECT COUNT($namaField) as count FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectCountWhere($table,$namaField,$where){
            global $con;
            $sql = "SELECT COUNT($namaField) as count FROM $table WHERE $where";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectAvg($table,$namaField){
            global $con;
            $sql = "SELECT AVG($namaField) as avg FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectBetween($table,$whereparam,$param,$param1){
            global $con;
            $sql = "SELECT * FROM $table WHERE $whereparam BETWEEN '$param' AND '$param1'";
            $query = mysqli_query($con,$sql);

            $sqls = "SELECT SUM(stok_barang) as count FROM $table WHERE $whereparam BETWEEN '$param' AND '$param1'";
            $querys = mysqli_query($con,$sqls);
            $assocs = mysqli_fetch_assoc($querys);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return ['data'=>$data,'jumlah'=>$assocs];
        }

        
        public function search($table,$likeKey,$likeOne){
            global $con;
            $sql = "SELECT * FROM $table WHERE $likeKey like '%$likeOne%'";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;

        }


        
        public function getCountRows($table){
            global $con;
            $sql   = "SELECT * FROM $table";
            $query = mysqli_query($con,$sql);
            $rows  = mysqli_num_rows($query);
            return $rows;
        }

        
        public function delete($table,$where,$whereValues,$redirect){
            global $con;
            $sql = "DELETE FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            if($query){
                return ['response'=>'positive','alert'=>'Berhasil Menghapus Data','redirect'=>$redirect];
            }else{
                echo mysqli_error($con);
                return ['response'=>'negative','alert'=>'Gagal Menghapus Data'];
            }
        }

        public function deletebkp($table,$where,$where1,$where2,$where3,$redirect){
            global $con;
            $sql = "DELETE FROM $table WHERE $where AND $where1 AND $where2 AND $where3";
            $query = mysqli_query($con,$sql);
            if($query){
                return ['response'=>'positive','alert'=>'Berhasil Menghapus Data','redirect'=>$redirect];
            }else{
                echo mysqli_error($con);
                return ['response'=>'negative','alert'=>'Gagal Menghapus Data'];
            }
        }

        public function edit($table,$where,$whereValues){
            global $con;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }   

        public function updateDouble($table,$values,$where,$whereValues,$where1,$whereValues1,$redirect){
            global $con;
            $sql   = "UPDATE $table SET $values WHERE $where = '$whereValues' AND $where1 = '$whereValues1'";
            $query = mysqli_query($con,$sql);
                if($query){
                    return ['response'=>'positive','alert'=>'Berhasil update data','redirect'=>$redirect];
                }else{
                    echo mysqli_error($con);
                    return ['response'=>'negative','alert'=>'Gagaal Update Data'];
                }
        }
        
        
        public function update($table,$values,$where,$whereValues,$redirect){
            global $con;
            $sql   = "UPDATE $table SET $values WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
                if($query){
                    return ['response'=>'positive','alert'=>'Berhasil update data','redirect'=>$redirect];
                }else{
                    echo mysqli_error($con);
                    return ['response'=>'negative','alert'=>'Gagaal Update Data'];
                }
        }

        
        public function insert($table,$values,$redirect=null){
            global $con;
            
            $sql   = "INSERT INTO $table VALUES($values)";
            $query = mysqli_query($con,$sql);
            if($query && !is_null($redirect)){
                return ['response'=>'positive','alert'=>'Berhasil Menambahkan Data','redirect' =>$redirect];
            }else{
                echo mysqli_error($con);
                return ['response'=>'negative','alert'=>'Gagal Menambahkan Data'];
            }
        }

        public function multiInsert($table,array $values,$count){
            global $con;
            for($i = 1;$i <= $count;$i++){
                $sql = "INSERT INTO $table VALUES($values[$i])";
                $error[] = $i;
            }
            if(count($error) < 1){
                return ['response'=>'positive','alert'=>'Berhasil Menambahkan Semua Data'];
            }else{
                return ['response'=>'positive','alert'=>'Error di values ke'.$i];
            }
        }

        
        public function setJoin($tableOne,$tableTwo,$selectData,$whereJoin){
            global $con;
            $sql = "SELECT $selectData FROM $tableOne INNER JOIN $tableTwo ON $whereJoin";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }

        
        public function setJoinThree($tableOne,$tableTwo,$tableThree,$selectData,$whereJoinOne,$whereJoinTwo){
            global $con;
            $sql = "SELECT $selectData FROM $tableOne INNER JOIN $tableTwo ON $whereJoinOne INNER JOIN $tableThree ON $whereJoinTwo";
            echo $sql;
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }
        

        
        public function AuthUser($sessionUser){
            global $con;
            $sql = "SELECT * FROM table_user WHERE username = '$sessionUser'";
            $query = mysqli_query($con,$sql);
            $bigData = mysqli_fetch_assoc($query);
            return $bigData;
        }
 
        
        function validateImage(){
            global $con;
            $name       = $_FILES['fotosoal']['name']; 
            $ukuranFile = $_FILES['fotosoal']['size']; 
            $error      = $_FILES['fotosoal']['error']; 
            $tmpName    = $_FILES['fotosoal']['tmp_name']; 
            

            $folder = 'img/'; 

            $ekstensiGambar = explode('.',$name); 
            $namaGambar = $ekstensiGambar[0]; 
            $ekstensiBelakang = strtolower(end($ekstensiGambar)); 
            $ekstensi = ['jpg','jpeg','png']; 
            $error = array(); 


                if (in_array($ekstensiBelakang, $ekstensi) ==false) { 
                     return ['response'=>'negative','alert'=>'Gambar hanya boleh menggunakan ekstensi jpg,jpeg,png']; 
                }

                if ($ukuranFile > 4000000) { 
                    return ['response'=>'negative','alert'=>'Ukuran gambar terlalu besar']; 
                }


            if (empty($errors)) {
                if (!file_exists('img')) { 
                    mkdir('img',0563);
                }
                
            }
            $name = random_int(1, 999);
            $name = time().$name.".".$ekstensiBelakang;
            move_uploaded_file($tmpName, $folder.$name); 

            return ['types'=>'true','image'=>$name];
        }

        
        
        public function autokode($table,$field,$pre){
            global $con;
            $sqlc   = "SELECT COUNT($field) as jumlah FROM $table";
            $querys = mysqli_query($con,$sqlc);
            $number = mysqli_fetch_assoc($querys);
            if($number['jumlah'] > 0){
                $sql    = "SELECT MAX($field) as kode FROM $table";
                $query  = mysqli_query($con,$sql);
                $number = mysqli_fetch_assoc($query);
                $strnum = substr($number['kode'], 2,3);
                $strnum = $strnum + 1;
                if(strlen($strnum) == 3){ 
                    $kode = $pre.$strnum;
                }else if(strlen($strnum) == 2){ 
                    $kode = $pre."0".$strnum;
                }else if(strlen($strnum) == 1){ 
                    $kode = $pre."00".$strnum;
                }
            }else{
                $kode = $pre."001";
            }

            return $kode;
        }

        public function validateHtml($field){ 
            $field = htmlspecialchars($field);
            return $field;
        }

        public function validateLower($field){ 
            $field = strtolower($field);
            return $field;
        }

        public function toExcel($nameFile){
            
            $dateNow = date("Y-m-d");

            
            $rawSended = header("Content-type : application/vnd-ms-excel");
            
            $GoExport  = header("Content-Disposition : attachment; filename = $dateNow-$nameFile");
            

            if($rawSended == true && $GoExport == true){ 
                
                return ['response'=>'positive','alert'=>'Berhasil Meng Export data'];
            }else{
                
                return ['response'=>'negative','alert'=>'Gagal Melakukan Export']; 
            }
        }   

        public function toPdf(){
            echo "window.print()";
        }

        public function Clone($what,$number){
            for($i = 1;$i <= $number; $i++){
                echo $what;
            }
        }

        public function addComent($table,$post_id,$whoComment,$values){
            global $con;
            $sql = "INSERT INTO $table VALUES('','$post_id','$whoComment',$values)";
            $query = mysqli_query($con,$sql);
            if($query){
                return ['response'=>'positive'];
            }else{
                return ['response'=>'negative'];
            }
        }

        public function validateNumber($field,$alert){
            if (!is_numeric($field)) {
                return ['response'=>'negative','alert'=>$alert]; 
            }
            else{
                return true;
            }
        }
        

        
    }

?>