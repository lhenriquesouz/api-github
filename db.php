<?php

try {
  $conn = new PDO("mysql:host=db;dbname=mydb","luis","123");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}