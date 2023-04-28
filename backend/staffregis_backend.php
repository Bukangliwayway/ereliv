<?php
include '../db/db.php';
include '../db/queries.php';

$hashed_password = password_hash("yoshitarogedli", PASSWORD_DEFAULT);
$username = "yoshitaro";
$contact = "09984144907";
$username = "yoshitaro";
$email = "piacentenichcommemoro@gmail.com";
$last = "yoshi";
$first = "taro";


$stmt = $conn->prepare("INSERT into Staff(UserName, Password, ContactNumber, EmailAddress, FirstName,LastName) VALUES (:UserName, :Password, :ContactNumber, :EmailAddress, :FirstName, :LastName)");
$stmt->bindParam(':UserName', $username);
$stmt->bindParam(':Password', $hashed_password);
$stmt->bindParam(':ContactNumber', $contact);
$stmt->bindParam(':EmailAddress', $email);
$stmt->bindParam(':FirstName', $first);
$stmt->bindParam(':LastName', $last);
try {
  $stmt->execute();
  echo "doneee";  
  }catch (PDOException $e) {
    echo $e->getMessage();
  }

