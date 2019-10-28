
<?php

//register.php

include('database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$message = '';
$validation_error = '';

if(empty($form_data->fname))
{
 $error[] = 'First Name is Required';
}
else
{
 $data[':fname'] = $form_data->fname;
}
if(empty($form_data->lname))
{
 $error[] = 'Last Name is Required';
}
else
{
 $data[':lname'] = $form_data->lname;
}
if(empty($form_data->age))
{
 $error[] = 'Age is Required';
}
else
{
 $data[':age'] = $form_data->age;
}
if(empty($form_data->email))
{
 $error[] = 'Email is Required';
}
else
{
 if(!filter_var($form_data->email, FILTER_VALIDATE_EMAIL))
 {
  $error[] = 'Invalid Email Format';
 }
 else
 {
  $data[':email'] = $form_data->email;
 }
}

if(empty($form_data->password))
{
 $error[] = 'Password is Required';
}
else
{
 $data[':password'] = password_hash($form_data->password, PASSWORD_DEFAULT);
}

if(empty($error))
{
 $query = "
 INSERT INTO register (fname, lname, age, email, password) VALUES (:fname, :lname, :age, :email, :password)
 ";
 $statement = $connect->prepare($query);
 if($statement->execute($data))
 {
  $message = 'Registration Completed';
 }
}
else
{
 $validation_error = implode(", ", $error);
}

$output = array(
 'error'  => $validation_error,
 'message' => $message
);

echo json_encode($output);


?>