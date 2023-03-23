<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
</head>
<body>

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


 
<script>

const btnGraph1 = document.getElementById('btnGraph1');
const btnGraph2 = document.getElementById('btnGraph2');
const btnGraph3 = document.getElementById('btnGraph3');
const chartContainer = document.getElementById('nmyChart');

// Define the data for each chart
const data1 = {
  labels: <?php echo json_encode($departmentname) ?>,
  datasets: [{
    label: 'Number of ideas made by each Department',
    data:<?php echo json_encode($totalpost) ?>,
    backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
};

const data2 = {
  labels: <?php echo json_encode($departmentnameG2) ?>,
  datasets: [{
    label: 'Percentage of ideas by each Department',
    data:<?php echo json_encode($percentpostG2) ?>,
    backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
};

const data3 = {
  labels: <?php echo json_encode($departmentnameG3) ?>,
  datasets: [{
    label: 'Number of contributors within each Department',
    data:<?php echo json_encode($contributorsG3) ?>,
    backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
};

const config1 = {
    type: 'bar',
    data: data1,
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {stepSize: 1}
        }
      },
      plugins:{
        legend:{
            labels:{
                boxWidth: 0
            }
        }
      }
    },
  };


  const config3 = {
    type: 'bar',
    data: data3,
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {stepSize: 1}
        }
      },
      plugins:{
        legend:{
            labels:{
                boxWidth: 0
            }
        }
      }
    },
  };

  const config2 = {
    type: 'bar',
    data: data2,
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
                        min: 0,
                        max: 100,
                        callback: function(value){return value+ "%"}
                    }
        }
      },
      plugins:{
        legend:{
            labels:{
                boxWidth: 0
            }
        }
      }
    },
  };

// Define a function to create a new chart with the given data
function createChart1() {
    if (Chart.getChart("myChart")){
          Chart.getChart("myChart").destroy();
        }
  return new Chart(
    document.getElementById('myChart'),
    config1
  );
}

function createChart2() {
    if (Chart.getChart("myChart")){
          Chart.getChart("myChart").destroy();
        }
    return new Chart(
    document.getElementById('myChart'),
    config2
  );
}

function createChart3() {
    if (Chart.getChart("myChart")){
          Chart.getChart("myChart").destroy();
        }
  return new Chart(
    document.getElementById('myChart'),
    config3
  );
}


// Add event listeners to the buttons to create the appropriate chart

</script>
<div>
  <button id="btnGraph1" onclick="createChart1()">Number of ideas made by each Department</button>
  <button id="btnGraph2" onclick="createChart2()">Percentage of ideas by each Department</button>
  <button id="btnGraph3" onclick="createChart3()">Number of contributors within each Department</button>
<div>

<div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>
</body>
</html>