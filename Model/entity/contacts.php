
<?php
    class Contact{
        var $id;
        var $firstChar ;
        var $name;
        var $phone;
        var $email;
        function __construct($id,$name,$phone,$email){
            $this->id=$id;
            $this->firstChar=$name[0];
            $this->name=$name;
            $this->phone = $phone;
            $this->email=$email;
        }
      
     
         static function getListFromDB(){
            //bước 1: mở kết nối vs db
            $conn = new mysqli("localhost","root","","contactsdb")  ;    
            $conn->set_charset("utf8");
            if($conn->connect_error)
              die("kết nối thất bại. Chi tiết lỗi".$conn->connect_error);
            // bước 2: thao tác với db
             //
             $query = "SELECT * FROM contacts ";
             $result = $conn->query($query);
             $rs = array();
             if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    array_push($rs,new Contact(
                        $row["ID"],
                        $row["name"],
                        $row["phone"],
                        $row["email"]
                     )
                    );
                }
             }
            //bước 3 : đóng kết nối db
            $conn->close();
            ksort($rs);
            return  $rs;
        }
         static function getListName(){

             $rs = self::getListFromDB();
             $rs2 = array();
             foreach ($rs as $key => $value) {
                array_push($rs2,strtolower($value->firstChar));
             }
             $result = array_unique($rs2);
             sort($result);
             return  $result;

         }
         static function getListBanhBa()
         {
           $rs=  array();
           $rs = self::getListFromDB();
           $l = count($rs);
           for($i=0; $i <$l-1 ; $i++) { 
            for($j=$i; $j <$l ; $j++) { 
              if(strcmp(strtolower($rs[$i]->name),strtolower($rs[$j]->name))>0)
                  {
                      $tam = $rs[$i];
                      $rs[$i]=$rs[$j];
                      $rs[$j] =$tam;
                  }
            }
           }
             return $rs;
         }
        static function search($str){
                 $rs = self::getListFromDB();
                 $rs2 = array();
                foreach ($rs as $key => $value) {
                  if(strcmp ( strtolower($value->firstChar) ,$str)==0)
                  {
                      array_push($rs2,$value);
                  }
               
             }
             return $rs2;

          }
           // static function getSoLuongRow(){
           //    $rs = self::getListFromDB();
           //    return  count($rs);
           // }
        //     static function getListFromDBPage($page,$limit){
        //       $rs = self::getListBanhBa();
        //       $l = count($rs);
        //       $start = ($page-1)*$limit;
        //       if(($start+$limit)>$l)
        //          $limit = $l;
        //        else
        //           $limit = $start+$limit;
        //       $rs2 = array();
        //       for($i=$start; $i < $limit; $i++) { 
        //          array_push($rs2,$rs[$i]);
        //        }
        //       return $rs2;
        // }
       }
     
?>