<?php 
  $con = new mysqli('localhost:3307','root','','feedbackdb');
  $query = $con->query("
    SELECT COUNT(user.department) as totalpost, user.department as departmentname
    FROM idea
    LEFT JOIN user ON idea.user_id = user.user_id
    GROUP BY user.department
  ");

  foreach($query as $data)
  {
    $departmentname[] = $data['departmentname'];
    $totalpost[] = $data['totalpost'];
  }

  $query2 = $con->query("SELECT COUNT(user.department)/(SELECT COUNT(*) FROM idea) * 100  as percentpost, user.department as departmentname
  FROM idea LEFT JOIN user ON idea.user_id = user.user_id
  GROUP BY user.department");

    foreach($query2 as $data2)
    {
    $departmentnameG2[] = $data2['departmentname'];
    $percentpostG2[] = $data2['percentpost'];
    }

  $query3 = $con->query("SELECT COUNT(DISTINCT idea.user_id) as contributors, user.department as departmentname
  FROM idea LEFT JOIN user ON idea.user_id = user.user_id
  GROUP BY user.department");

    foreach($query3 as $data3)
    {
    $departmentnameG3[] = $data3['departmentname'];
    $contributorsG3[] = $data3['contributors'];
    }

?>