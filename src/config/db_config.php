<?php

class dbConfig

{

    protected $dbConnection;

    public $report = array();



    // constructor for setting database connection

    function __construct()

    {

        $pdo = "mysql:host=localhost; dbname=sahl";

        try

        {

            $this->dbConnection = new PDO($pdo,'root','');

            $this->dbConnection->setAttribute(pdo::ATTR_ERRMODE,pdo::ERRMODE_EXCEPTION);

            $this->report['connection_error'] = 'false';

            return $this->dbConnection;

        }

        catch(PDOException $e)

        {

            $this->report['connection_error'] = 'true';

            $this->report['connection_error_message'] = $e->getMessage();

            return $this->report;

        }

    }



    // test if the data is exist in some table

    function isExist($table,$faild,$value)

    {

        $sql = "SELECT $faild from `$table` WHERE $faild='$value'";

        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $result = $prepare->fetchAll(PDO::FETCH_NUM);

            $report['count'] = count($result);

            $report['count_error'] = 'false';

            return $report;

        }

        catch(PDOException $e)

        {

            $report['count_error'] = 'true';

            $report['count_error_message'] = $e->getMessage();

            return $report;

        }

    }



    // insert recored to databse

    function insertData($table,$data)

    {

        // data is an array with table field as keys and

        //table values as array values

        $fields = '`'.implode(array_keys($data),'`,`').'`';

        $values = '\''.implode($data,'\',\'').'\'';

        $sql = "INSERT INTO `$table`($fields) VALUES($values)";

        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $report['insert_data_error'] = 'false';

            return $report;

        }

        catch(PDOException $e)

        {

            $report['insert_data_error'] = 'true';

            $report['insert_data_error_message'] = $e->getMessage();

            return $report;

        }

    }



    //

    function insertRequest($table,$data)

    {

        // data is an array with table field as keys and

        //table values as array values

        $fields = '`'.implode(array_keys($data),'`,`').'`';

        $values = '\''.implode($data,'\',\'').'\'';

        $sql = "INSERT INTO `$table`($fields,`date`,`time`) VALUES($values,NOW(),NOW())";

        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $report['insert_data_error'] = 'false';

            return $report;

        }

        catch(PDOException $e)

        {

            $report['insert_data_error'] = 'true';

            $report['insert_data_error_message'] = $e->getMessage();

            return $report;

        }

    }



    //login function

    function login($table,$email,$email_value,$password,$password_value)

    {

        $sql = "SELECT * FROM `$table` WHERE $email='$email_value' AND $password='$password_value'";

        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

            if(count($result) == 1)

            {

                $report['login_error'] = 'false';

                $report['login_auth'] = 'true';

                $report['login_data'] = $result;

                return $report;

            }

            else

            {

                $report['login_error'] = 'false';

                $report['login_auth'] = 'false';

                return $report;

            }

        }

        catch(PDOException $e)

        {

            $report['login_error'] = 'true';

            $report['login_error_message'] = $e->getMessage();

            return $report;

        }

    }
    //login function

    function loginUser($table,$phone,$phone_value,$password,$password_value)

    {

        $sql = "SELECT * FROM `$table` WHERE $phone=$phone_value AND $password='$password_value'";

        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

            if(count($result) == 1)

            {

                $report['login_error'] = 'false';

                $report['login_auth'] = 'true';

                $report['login_data'] = $result;

                return $report;

            }

            else

            {

                $report['login_error'] = 'false';

                $report['login_auth'] = 'false';

                return $report;

            }

        }

        catch(PDOException $e)

        {

            $report['login_error'] = 'true';

            $report['login_error_message'] = $e->getMessage();

            return $report;

        }

    }




    function updateData($table,$data,$id)

    {

        $dataToUpdate = "";

        foreach($data as $key=>$value)

        {

            $dataToUpdate .= "`$key` = '$value',";

        }

        $dataToUpdate = rtrim($dataToUpdate,",");

        $sql = "UPDATE `$table` SET $dataToUpdate WHERE `id`=$id";

        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $report['update_error'] = 'false';

            $report['update'] = 'true';

            return $report;

        }

        catch(PDOException $e)

        {

            $report['update_error'] = 'true';

            $report['update'] = 'false';

            $report['update_error_message'] = $e->getMessage();

            return $report;

        }

    }
    function updateDataUserActiveSoc($table,$data,$g_id,$code)

    {

        $dataToUpdate = "";

        foreach($data as $key=>$value)

        {

            $dataToUpdate .= "`$key` = '$value',";

        }

        $dataToUpdate = rtrim($dataToUpdate,",");

        $sql = "UPDATE `$table` SET `active`=$data WHERE `g_id`=$g_id AND `code`=$code";

        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $report['update_error'] = 'false';

            $report['update'] = 'true';

            return $report;

        }

        catch(PDOException $e)

        {

            $report['update_error'] = 'true';

            $report['update'] = 'false';

            $report['update_error_message'] = $e->getMessage();

            return $report;

        }

    }

    function updateDataUserActive($table,$data,$phone,$code)

    {

        $dataToUpdate = "";

        foreach($data as $key=>$value)

        {

            $dataToUpdate .= "`$key` = '$value',";

        }

        $dataToUpdate = rtrim($dataToUpdate,",");

        $sql = "UPDATE `$table` SET $dataToUpdate WHERE `phone`=$phone AND `code`=$code";

        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $report['update_error'] = 'false';

            $report['update'] = 'true';

            return $report;

        }

        catch(PDOException $e)

        {

            $report['update_error'] = 'true';

            $report['update'] = 'false';

            $report['update_error_message'] = $e->getMessage();

            return $report;

        }

    }

    function updateDataRate($table,$data,$item_id,$user_id)

    {

        $dataToUpdate = "";

        foreach($data as $key=>$value)

        {

            $dataToUpdate .= "`$key` = '$value',";

        }

        $dataToUpdate = rtrim($dataToUpdate,",");

        $sql = "UPDATE `$table` SET $dataToUpdate WHERE `item_id`=$item_id AND `user_id`=$user_id";

        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $report['update_error'] = 'false';

            $report['update'] = 'true';

            return $report;

        }

        catch(PDOException $e)

        {

            $report['update_error'] = 'true';

            $report['update'] = 'false';

            $report['update_error_message'] = $e->getMessage();

            return $report;

        }

    }



    function fetchData($table,$data='*',$condition='1',$order=1,$start=0,$limit=999999)

    {

        $sql = "SELECT $data FROM $table WHERE $condition ORDER BY ($order) DESC LIMIT $start,$limit";
        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

            if(count($result) > 0)

            {
                $report['fetch_error'] = 'false';

                $report['fetch'] = 'true';

                $report['data'] = $result;

                return $report;
            }
            else

            {
                $report['fetch_error'] = 'false';

                $report['fetch'] = 'false';

                $report['data'] = 'no data';

                return $report;

            }

        }

        catch(PDOException $e)

        {

            $report['fetch_error'] = 'false';

            $report['fetch'] = 'false';

            $report['error_message'] = $e->getMessage();

            return $report;

        }

    }


    function fetchDataDriver($table,$data='*',$condition='1',$order=1,$start=0,$limit=999999)

    {

        $sql = "SELECT $data FROM $table WHERE $condition ORDER BY ($order) DESC LIMIT $start,$limit";
        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

            if(count($result) > 0)

            {
                $report['fetch_error'] = 'false';

                $report['fetch'] = 'true';

                $report['data'] = $result;

                return $result;
            }
            else

            {
                $report['fetch_error'] = 'false';

                $report['fetch'] = 'false';

                $report['data'] = 'no data';

                return $report;

            }

        }

        catch(PDOException $e)

        {

            $report['fetch_error'] = 'false';

            $report['fetch'] = 'false';

            $report['error_message'] = $e->getMessage();

            return $report;

        }

    }
    function fetchDataTwo($table,$data='*',$condition='1', $cond = '1',$order=1,$start=0,$limit=999999)

    {



        $sql = "SELECT $data FROM $table WHERE $condition AND $cond ORDER BY ($order) DESC LIMIT $start,$limit";



        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

            if(count($result) > 0)

            {

                $report['fetch_error'] = 'false';

                $report['fetch'] = 'true';

                $report['data'] = $result;

                return $report;

            }

            else

            {

                $report['fetch_error'] = 'false';

                $report['fetch'] = 'false';

                $report['data'] = 'no data';

                return $report;

            }

        }

        catch(PDOException $e)

        {

            $report['fetch_error'] = 'false';

            $report['fetch'] = 'false';

            $report['error_message'] = $e->getMessage();

            return $report;

        }

    }

    function fetchDataTwoOr($table,$data='*',$condition='1', $cond = '1',$order=1,$start=0,$limit=999999)

    {



        $sql = "SELECT $data FROM $table WHERE $condition OR $cond ORDER BY ($order) DESC LIMIT $start,$limit";



        try

        {

            $prepare = $this->dbConnection->prepare($sql);

            $execute = $prepare->execute();

            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

            if(count($result) > 0)

            {

                $report['fetch_error'] = 'false';

                $report['fetch'] = 'true';

                $report['data'] = $result;

                return $report;

            }

            else

            {

                $report['fetch_error'] = 'false';

                $report['fetch'] = 'false';

                $report['data'] = 'no data';

                return $report;

            }

        }

        catch(PDOException $e)

        {

            $report['fetch_error'] = 'false';

            $report['fetch'] = 'false';

            $report['error_message'] = $e->getMessage();

            return $report;

        }

    }






// 
//
//
//     function fetchJoin($data,$table1,$table2,$joinCondition, $condition, $order)
//
//     {
//
//         $sql = "SELECT $data FROM $table1 INNER JOIN $table2 ON $joinCondition WHERE $condition ORDER BY ($order) DESC";
//
// //		$sql = "SELECT $data from $table1 JOIN $table2 ON $joinCondition WHERE $condition ORDER BY ($order) DESC";
//
//         try{
//
//             $prepare = $this->dbConnection->prepare($sql);
//
//             $execute = $prepare->execute();
//
//             $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
//
//             if(count($result)>0)
//
//             {
//
//                 $report['fetch_error'] = 'false';
//
//                 $report['fetch'] = 'true';
//
//                 $report['data'] = $result;
//
//                 return $report;
//
//             }
//
//             else
//
//             {
//
//                 $report['fetch_error'] = 'false';
//
//                 $report['fetch'] = 'false';
//
//                 $report['data'] = 'no data';
//
//                 return $report;
//
//             }
//
//         }
//
//         catch(PDOException $e)
//
//         {
//
//             $report['fetch_error'] = 'false';
//
//             $report['fetch'] = 'false';
//
//             $report['error_message'] = $e->getMessage();
//
//             return $report;
//
//         }
//
//     }
//
//
//
//
//
//
//
//
//
//     function deleteData($table,$condition)
//
//     {
//
//         $sql = "DELETE FROM `$table` WHERE $condition";
//
//         try
//
//         {
//
//             $prepare = $this->dbConnection->prepare($sql);
//
//             $execute = $prepare->execute();
//
//             $report['delete_error'] = 'false';
//
//             return $report;
//
//         }
//
//         catch(PDOException $e)
//
//         {
//
//             $report['delete_error'] = 'true';
//
//             $report['delete_error_meassge'] = $e->getMessage();
//
//             return $report;
//
//         }
//
//     }

}
