<?php

$DB_HOST = '127.0.0.1';
$DB_PORT = '3306';
$DB_USER = 'root';
$DB_PASSWORD = 'password';
$DB_DATABASE = 'LutfianRahdiansyah_IF4_Kepegawaian';
global $conn;
  $conn = mysqli_connect($DB_HOST,  $DB_USER, $DB_PASSWORD,$DB_DATABASE, $DB_PORT);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }



function findAll($table,$extra ="",$column = "*", $condition = false)
{
   global $conn;
  $q = "SELECT $column FROM $table";
  if ($extra) {
    $q .= " $extra";
  }
  if ($condition) {
    $q .= " WHERE $condition";
  }
  $result = mysqli_query($conn, $q);
  if (!$result) {
    die("Error in query: " . mysqli_error($conn));
  }
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function findById($table,$id, $column = "*")
{
  global  $conn;
  $q = "SELECT $column FROM $table WHERE id = $id";
  $result = mysqli_query($conn, $q);
  if (!$result) {
    die("Error in query: " . mysqli_error($conn));
  }
  $row = mysqli_fetch_assoc($result);
  return $row;
}

function insert($table,$data)
{
  global  $conn;
  $q = "INSERT INTO $table (";
  $q .= implode(", ", array_keys($data));
  $values = array_values($data);
  foreach ($values as $key => $value) {
    if((int)($value) == $value){
      $values[$key] = $value;
    }else{
      $values[$key] = "'$value'";
    }

  }
  $q .= ") VALUES (" . implode(", ", $values) . ")";
  $result = mysqli_query($conn, $q);
  return $result;
}

function update($table,$data, $id)
{
  global  $conn;
  $q = "UPDATE $table SET ";
  foreach ($data as $key => $value) {
    if((int)($value) == $value){
      $q .= "$key = $value, ";
    }else{
      $q .= "$key = '$value', ";
    }
  }
  $q = rtrim($q, ", ");
  $q .= " WHERE id = $id";
  $result = mysqli_query($conn, $q);
  if (!$result) {
    die("Error in query: " . mysqli_error($conn));
  }
  return $result;
}

function delete($table,$id)
{
  global  $conn;
  $q = "DELETE FROM $table WHERE id = $id";
  var_dump($q);
  $result = mysqli_query($conn, $q);
  if (!$result) {
    die("Error in query: " . mysqli_error($conn));
  }
  return $result;
}
