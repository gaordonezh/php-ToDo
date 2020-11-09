<?php
$con = new mysqli('localhost','root','','cursophp');
if(!empty($_POST)){
    $descrip = $_POST['description'];
    $save = $con -> query("INSERT INTO tasks(descrip, done) VALUES('$descrip', '0')");
    Header("Location: /todoPHP/");
}
if(!empty($_REQUEST['del']) && $_REQUEST['action']=='erase'){
    $id = $_REQUEST['del'];
    $del = $con -> query("DELETE FROM tasks WHERE id='$id' ");
    Header("Location: /todoPHP/");
}
if(!empty($_REQUEST['down']) && $_REQUEST['action']=='check'){
    $id = $_REQUEST['down'];
    $up = $con -> query("UPDATE tasks SET done='1' WHERE id='$id' ");
    Header("Location: /todoPHP/");
}
if(!empty($_REQUEST['up']) && $_REQUEST['action']=='subir'){
    $id = $_REQUEST['up'];
    $up = $con -> query("UPDATE tasks SET done='0' WHERE id='$id' ");
    Header("Location: /todoPHP/");
}
?>

<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="icon" type="image/ico" href="icon.ico">
    <title>Todo!</title>
    <style> body{ background-color: #343a40; } .icons a{ margin: 0 5px; font-size: 18px; color: white; } .icons a:hover{ color: #17a2b8; } .container{margin-top: 20px;border: 1px solid #17a2b8;border-radius: 20px;}
    </style>
</head>
<body>
    <section class="container table-dark">
        <article class="alert text-center">
            <h1 style="color:#17a2b8">TO DO <i class="fa fa-list"></i></h1>
        </article>
        <article class="row">
            <form action="/todoPHP/" class="col-lg-12" method="POST">
                <div class="col-lg-12">
                    <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                </div>
                <div class="col-lg-12 text-center">
                    <br>
                    <button class="btn btn-outline-info" name="btn"><i class="fa fa-send"></i> Save</button>
                    <br><br>
                </div>
            </form>
        </article>
        <article class="table-responsive">
            <table class="table table-hover table-dark">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col" colspan="3"  style="color:#17a2b8">EN LISTA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $extraer = $con->query("SELECT id, descrip FROM tasks WHERE done='0' ");
                    while($data = $extraer -> fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $data['descrip']; ?></td>
                            <th scope="row" class="text-center icons">
                                <a href="/todoPHP/index.php?del=<?php echo $data['id']; ?>&action=erase"><i class="fa fa-trash"></i></a>
                                <a href="/todoPHP/index.php?down=<?php echo $data['id']; ?>&action=check"><i class="fa fa-check"></i></a>
                            </th>
                        </tr>
                        <?php
                    }
                    ?>                    
                </tbody>
            </table>
        </article>
        <article>
        <br> <br>
        </article>
        <article class="table-responsive">
            <table class="table table-hover table-dark">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col" colspan="3"  style="color:#17a2b8">COMPLETADO</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $extraer2 = $con->query("SELECT id, descrip FROM tasks WHERE done='1' ");
                    while($data2 = $extraer2 -> fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $data2['descrip']; ?></td>
                            <th scope="row" class="text-center icons">
                                <a href="/todoPHP/index.php?del=<?php echo $data2['id']; ?>&action=erase"><i class="fa fa-trash"></i></a>
                                <a href="/todoPHP/index.php?up=<?php echo $data2['id']; ?>&action=subir"><i class="fa fa-arrow-up"></i></a>
                            </th>
                        </tr>
                        <?php
                    }
                    ?>   
                    
                </tbody>
            </table>
        </article>
    </section>
</body>
</html>