<?php
$emailCheck = false;
$passwordCheck = false;
$passwordConfirmationCheck = false;
$usernameCheck = false;
$errors = [];
$validation_array = [];
//This the validation function
/*
 *   validate_password()
 * =>validate password A password contains at least eight characters
    ,including at least one number and includes both lower and uppercase
     letters and special characters
 */
function validate_password($password)
{
    global $errors, $passwordCheck, $validation_array;
    if (preg_match("
    /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])/", $password)) {
        $passwordCheck = true;
    } else {
        $passwordCheck = false;
        $errors["password"] = "A password contains at least eight characters,including at least one number and includes both lower and uppercase letters and special characters";

    }
    //push every validation to the array and check it
    //using validate_all_parms();
    $validation_array[] = $passwordCheck;
    return $passwordCheck;

}

function validate_username($username)
{
    global $errors, $usernameCheck, $validation_array;
    if (preg_match("
    /^[0-9a-zA-Z_.-]+$/", $username)) {
        $usernameCheck = true;
    } else {
        $usernameCheck = false;
        $errors['username'] = 'username is not valid';
    }

    //push every validation to the array and check it
    //using validate_all_parms();
    $validation_array[] = $usernameCheck;
    return $usernameCheck;
}

function validate_email($email)
{
    global $emailCheck, $errors, $validation_array;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailCheck = true;
    } else {
        $emailCheck = false;
        $errors["email"] = "The email is not valid";
    }
    $validation_array[] = $emailCheck;
    return $emailCheck;


}

function confirm_password($password, $password_confirmation)
{
    global $passwordConfirmationCheck, $errors, $validation_array;
    if ($password_confirmation !== $password) {
        $passwordConfirmationCheck = false;
        $errors["password_confirmation"] = "password doesn't match";

    } else {
        $passwordConfirmationCheck = true;
    }
    $validation_array[] = $passwordConfirmationCheck;
    return $passwordConfirmationCheck;


}

function get_date_of_creation()
{

    $date_of_creation = date('Y-m-d H:i:s');

    return $date_of_creation;
}

function encrypt_password($password)
{
    $hash_format = "$2y$10$";
    $salt = "iusesomecrazystrings98";
    $hashF_and_salt = $hash_format . $salt;
    $password_encrypt = crypt($password, $hashF_and_salt);
    return $password_encrypt;
}

function validate_all_paramters(...$parms)
{
    //put all the parameters in an array
    $validate = true;
    foreach ($parms as $value) {
        //if any of the parms is false it will set $validate false
        if (!$value) {
            $validate = false;
        }

    }
    return $validate;


}

//-----------------------------------------------------------------------------------
/*  checkRepetition_and_showUsers($connection,$repetition,$table_name,$parameters_to_check)
this function fetch all table data and return it when $repetition is false;
$url should be relative to the file functions is required into it;
*/
function checkRepetition_and_showUsers($connection, $repetition, $table_name, $parameters_name = null, $parameters_to_check = null, $url = null)
{
    $statement = $connection->prepare("SELECT * FROM {$table_name}");
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (!$repetition) {
        return $users;
    }
    var_dump($users);
    if ($repetition) {
        $length = count($parameters_name);
        //loop through all the parameters you want to check
        foreach ($users as $user) {


            for ($i = 0; $i < $length; $i++) {
                //if there is any parameter repetition return error to url
                if ($user[$parameters_name[$i]] === $parameters_to_check[$i]) {
                    header("Location:{$url}?{$parameters_name[$i]}={$parameters_name[$i]} is repeated");
                    exit();
                }
            }
        }

    }

}

//-------------------------------------------------------------------------------------------------------------
function crud($connection, $operation, $table_name, $columns, $values)
{
    // $OPERATION=> INSERT UPDATE DELETE SELECT
    //SELECT SELECTS ALL COLUMUNS
    //$columns will be an array the first index will be id
    //$values will be an array the first index will be id
    //WHEN USING THE INSERT DON"T INSERT THE ID
    //DONT USE ID IN INSERT
    //PUT THE ID IN THE FIRST INDEX
    $query = "";
    //delete all the row items
    $length = count($columns) - 1;
    $i = 0;
    if ($operation === "DELETE") {
        $query = "DELETE FROM {$table_name} WHERE  {$columns[0]} = '{$values[0]}'";

    }
    if ($operation === "UPDATE") {
        $query = "UPDATE " . $table_name . " SET";
        $query_values = "";

        for ($i = 0; $i <= $length; $i++) {
            if ($i === 0) continue;
            if ($i === $length) {
                if (is_numeric($values[$i])) {
                    $query_values .= " {$columns[$i]}={$values[$i]} WHERE";
                } else {
                    $query_values .= " {$columns[$i]}='{$values[$i]}' WHERE";
                }

            } else {
                if (is_numeric($values[$i])) {
                    $query_values .= " {$columns[$i]}={$values[$i]},";
                } else {
                    $query_values .= " {$columns[$i]}='{$values[$i]}',";
                }

            }
        }
        $query .= " " . $query_values;
        $query .= " {$columns[0]}={$values[0]}";
    }
    if ($operation === "INSERT") {
        $query = "INSERT INTO " . $table_name;
        $query_values = "VALUES ";

        for ($i = 0; $i <= $length; $i++) {
            if ($i === 0) {
                $query .= "({$columns[$i]},";
                //remove '' when the value is number
                if (is_numeric($values[$i])) {
                    $query_values .= "({$values[$i]} ,";
                } else {
                    $query_values .= "('{$values[$i]}' ,";
                }

            } elseif ($i === $length) {
                $query .= "{$columns[$i]})";
                //remove '' when the value is number
                if (is_numeric($values[$i])) {
                    $query_values .= "{$values[$i]})";
                } else {
                    $query_values .= "'{$values[$i]}')";
                }

            } else {
                $query .= "{$columns[$i]},";
                if (is_numeric($values[$i])) {
                    $query_values .= "{$values[$i]},";
                } else {
                    $query_values .= "'{$values[$i]}',";
                }


            }
        }
        $query .= " " . $query_values;

    }
    $statement = $connection->prepare($query);
    $statement->execute();
}

/*** Function To Get All Records From Any Database Table*/
function getAllFrom($field, $table, $where = NULL, $and = NULL, $orderfield, $ordering = "DESC")
{

    global $con;

    $getAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");

    $getAll->execute();

    $all = $getAll->fetchAll();

    return $all;

}

function getPostData($post, $dataArr)
{
    $returned_data = [];
    if (isset($post[$dataArr[0]])) {
        foreach ($dataArr as $data) {
            $returned_data[] = $post[$data];
        }

    }
    return $returned_data;
}

//session started in this function
//automatic logout of the user after $time
//empty the basket after $basket time
function session_timeout($time,$basket_time)
{

    if (!isset($_SESSION['start'])) {
        $_SESSION['start'] = time();

    }
    if (time() > $_SESSION['start'] + $time*60) {
        $_SESSION['user_loggedin'] = false;
        $_SESSION['admin_loggedin']= false;
        $_SESSION['start'] = time();
    }
    if (time() > $_SESSION['start'] + $basket_time*60) {
        //remove the basket after $basket_time
       unset($_SESSION['shopping_cart']);
        $_SESSION['start'] = time();
    }
}