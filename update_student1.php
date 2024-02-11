<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor updater</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .card {
        border: 2px solid black;
        
        box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        margin-top: 20px;
    }

    .card-header {
    background-color: #007bff;
    color: white;
    text-align: center;
    padding: 10px;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}


    form input[type="text"], button[type="submit"] {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 8px;
    }

    input[type="submit"] {
        font-size: 20px;
        margin-top: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0069d9;
    }

    input[type="submit"]:active {
        background-color: #0062cc;
    }

    input[type="submit"]:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
    }
    .card:hover {
    transform: scale(1.12);
    transition: 2s ease-in-out;
    box-shadow: 0 5px 1500px rgba(0,0,0,0.3);
}
body {
  background-color: grey;
}


</style>

<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4>UPDATE STUDENT INFORMATION</h4>
                    </div>
                    <div class="card-body">

                        <form  method="GET">
                            <div class="row">
                            <div class="col-md-8">
  <input type="text" name="id" value="<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>" class="form-control" placeholder="Enter student ID">
</div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <?php 
                                $host = "127.0.0.1";
                                $username = "root";
                                $password = "";
                                $dbname = "university";
                                    $con = mysqli_connect($host,$username,$password,$dbname
                                );

                                    if(isset($_GET['id']))
                                    {
                                        $id = $_GET['id'];

                                        $query = "SELECT * FROM student WHERE id='$id' ";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                                ?>
                                            <form method="POST">
                                                <div class="form-group mb-3">
                                                    <label for="">Name</label>
                                                    <input type="text" value="<?= $row['name']; ?>" class="form-control" name = "name">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">Department Name</label>
                                                    <input type="text" value="<?= $row['dept_name']; ?>" class="form-control" name = "department">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">Total Credit</label>
                                                    <input type="text" value="<?= $row['tot_cred']; ?>" class="form-control" name = "tot_cred">
                                                </div>
                                                <input type="submit" name="save" value="Update" style="font-size:20px" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                                <script>
    document.getElementById("search-btn").addEventListener("click", function(event) {
        var idInput = document.querySelector("input[name='id']");
        if (idInput.value.trim() == "") {
            alert("Please enter an ID to search for.");
            event.preventDefault();
        }
    });
</script>

                                            </form>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "No Record Found";
                                        }
                                    }
                                
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        $id = $_GET['id'];
                                        $name = $_POST['name'];
                                        $dept_name = $_POST['department'];
                                        $tot_cred = $_POST['tot_cred'];

                                        $sql_query = "UPDATE student SET name = '$name' , dept_name = '$dept_name', tot_cred = '$tot_cred'
                                        WHERE ID = '$id'";
                                          $result = mysqli_query($con, $sql_query);
                                          if ($result) 
                                          {
                                             echo "New Details Entry inserted successfully !";
                                          } 
                                          else
                                          {
                                             echo "Error: " . $sql . "" . mysqli_error($conn);
                                          }
                                    }
                                   
                                ?>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
