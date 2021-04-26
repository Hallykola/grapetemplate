<?php
                  include_once('db.php');

global $conn;
                  $sql = "SELECT * FROM `data_raw` ";
                  $statement = $conn->prepare($sql);
                  $statement->execute();
                  $data = $statement->get_result()->num_rows;
              
                  $position = $data+1;

                  $sql = "INSERT INTO `data_raw` (`data`,`html`,`components`,`assets`,`css`,`styles`) VALUES (?,?,?,?,?,?)  ";
                  $statement= $conn->prepare($sql);
                  $empty = "hello";
                  $statement->bind_param('ssssss',$empty,$empty,$empty,$empty,$empty,$empty);
                  $statement->execute();
?>