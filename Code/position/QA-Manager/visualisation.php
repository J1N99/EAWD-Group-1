<?php
include("../../header.php");
?>

<link rel="stylesheet" href="../../style.css">
<link rel="stylesheet" href="./css/visualisation.css">

    <div class="d-flex" id="wrapper">

        <!--sidebar-->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-secret me-2"></i>Test
            </div>

            <div class="list-group list-group-flush my-3">
                <a href="./dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-tachometer-alt me-2"></i>DashBoard
                </a>

                <a href="./ideas.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Ideas
                </a>

                <a href="./category.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-solid fa-list me-2"></i>Categories
                </a>

                <a href="./overview.php?overview=true" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-solid fa-globe me-2"></i>Overview
                </a>

                <a href="#" class="list-group-item list-group-item-action second-text fw-bold active">                    
                    <i class="fas fa-regular fa-chart-line me-2"></i>Visualisation
                </a>

                <a href="../login.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-sharp fa-regular fa-right-from-bracket me-2"></i>LogOut
                </a>

            </div>
        </div>

        <!--navbar header-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Visualisation</h2>
                </div>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class=" dropdown-toggle primary-text fw-bold" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>QA-Manager Name
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li><a class="dropdown-item" href="#">Profile</a></li>
                              <li><a class="dropdown-item" href="#">Settings</a></li>
                              <li><a class="dropdown-item" href="#">LogOut</a></li>
                            </ul>
                        </li>
                    </ul> 
                </div>
            </nav>

            <!--Content-->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle ms-4 mt-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Select Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li class="d-grid">
                        <button class="border border-0 bg-transparent" onclick="createChart1()">
                            <a class="dropdown-item" id="btnGraph1" href="#">Number of ideas made by each Department</a>
                        </button>                    
                    </li>
                  
                    <li class="d-grid">
                        <button class="border border-0 bg-transparent" onclick="createChart2()">
                            <a class="dropdown-item" id="btnGraph2" href="#">Percentage of ideas by each Department</a>
                        </button>                    
                    </li>

                    <li class="d-grid">
                        <button class="border border-0 bg-transparent" onclick="createChart3()">
                            <a class="dropdown-item" id="btnGraph3" href="#">Number of contributors within each Department</a>
                        </button>                    
                    </li>               
                </ul>
            </div>

        <?php

            $con = new mysqli('localhost','root','','feedbackdb');

            $total1 = $total2 = $total3 = 0;

            $query = $con->query("
                SELECT COUNT(department.department_id) as totalpost, department.department as departmentname
                FROM idea
                LEFT JOIN user ON idea.user_id = user.user_id
                LEFT JOIN department ON user.department = department.department_id
                GROUP BY user.department
            ");

            foreach($query as $data)
            {
                $departmentname[] = $data['departmentname'];
                $totalpost[] = $data['totalpost'];
                $total1 += $data['totalpost'];
            }

            $query2 = $con->query("SELECT COUNT(department.department_id)/(SELECT COUNT(*) FROM idea) * 100  as percentpost, department.department as departmentname
            FROM idea LEFT JOIN user ON idea.user_id = user.user_id
            LEFT JOIN department ON user.department = department.department_id
            GROUP BY user.department");

            foreach($query2 as $data2)
            {
                $departmentnameG2[] = $data2['departmentname'];
                $percentpostG2[] = $data2['percentpost'];
            }

            $total2 = $total1;
            $query3 = $con->query("SELECT COUNT(DISTINCT department.department_id) as contributors, department.department as departmentname
            FROM idea LEFT JOIN user ON idea.user_id = user.user_id
            LEFT JOIN department ON user.department = department.department_id  
            GROUP BY user.department");

            foreach($query3 as $data3)
            {
                $departmentnameG3[] = $data3['departmentname'];
                $contributorsG3[] = $data3['contributors'];
                $total3 += $data3['contributors'];
            }

        ?>
 
        <script>
           const btnGraph1 = document.getElementById('btnGraph1');
            const btnGraph2 = document.getElementById('btnGraph2');
            const btnGraph3 = document.getElementById('btnGraph3');
            const chartContainer = document.getElementById('myChart');

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
                    document.getElementById('postinfo').textContent = "<?php echo 'Total posts: '.$total1?>";
            return new Chart(
                document.getElementById('myChart'),
                config1
            );
            }

            function createChart2() {
                if (Chart.getChart("myChart")){
                    Chart.getChart("myChart").destroy();
                    }
                    document.getElementById('postinfo').textContent = "<?php echo 'Total posts: '.$total2?>";
                return new Chart(
                document.getElementById('myChart'),
                config2
            );
            }

            function createChart3() {
                if (Chart.getChart("myChart")){
                    Chart.getChart("myChart").destroy();
                    }
                    document.getElementById('postinfo').textContent = "<?php echo 'Total contributors: '.$total3?>";
            return new Chart(
                document.getElementById('myChart'),
                config3
            );
            }



        // Add event listeners to the buttons to create the appropriate chart

        </script>

        <div class="container-fluid mt-5">
            <div class="text-center col-md-5">
                <div class="chart-size">
                    <span id="postinfo"></span>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>        
    <script src="../../script.js"></script>

<?php
include("../../footer.php");
?>