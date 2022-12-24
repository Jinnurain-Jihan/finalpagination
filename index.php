<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        ul{
            margin:0;
            padding:0;
            list-style-type: none;
        }
        li{
            float:left;
            overflow:hidden;
            margin-right:5px;
        }
        a{
            text-decoration:none;
            padding:13px 15px;
            color:#000;
            background:#ccc;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <h1 class="mb-4 text-center text-info">Students Information</h1>
            <div class="col-12">
                <?php 
                $con=mysqli_connect("localhost","root","","pegination");
                $perPage=5;
                $result=mysqli_query($con,"SELECT * FROM students");
                $totalData=mysqli_num_rows($result);
                $totalPage=ceil($totalData/$perPage);
                if(isset($_GET['page'])){
                    $page=$_GET['page'];
                }else{
                    $page=1;
                }
                $limit=($page-1)*$perPage;
                $result=mysqli_query($con,"SELECT * FROM students LIMIT " .$limit .','.$perPage);
                while($row=mysqli_fetch_assoc($result)){
                echo $row["id"].".".$row["name"]."<br>";
                }
                if($page>1){?>
                 <a href='index.php?page=<?= $page-1 ?>'class="btn btn-secondary">Previous</a>
                <?php 
                }else{?>
                <a href='javascript:avoid(0)'class="btn btn-secondary disabled" >Previous</a>
                <?php
                }
                for($i=1;$i<=$totalPage;$i++){
                ?>
                    <a href='index.php?page=<?= $i?>'class="btn btn-primary <?= $page==$i ? 'active':'' ?>"><?= $i ?></a>

                <?php 
                }
                if(($i >$page) && ($page<$totalPage)){?>
                    <a href='index.php?page=<?= $page+1 ?>'class="btn btn-secondary">Next</a>
                   <?php 
                   }else{?>
                   <a href='javascript:avoid(0)'class="btn btn-secondary disabled" >Next</a>
                   <?php
                   }
                ?>
            </div>
        </div>
    </div>
</body>
</html>