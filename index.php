<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <title>Ajout produit</title>
    </head>
    <body>
        
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="active"><a  href="index.php">Commander</a></li> 
            <li class="active"><a  href="recap.php">Récapitulatif</a></li>
        </ul>
    </nav>


       

        <h1>Ajouter un produit</h1>
        <form action="traitement.php?action=add" method="post"  enctype= "multipart/form-data">
            <p>
                <label class="form-label" >
                    Nom du produit : 
                    <input class="form-control" type="text" name="name">
                </label>
            </p>
            <p>
                <label class="form-label">
                    Prix du produit : 
                    <input class="form-control" type="number" step="any" name="price">
                </label>
            </p>
            <p>
                <label class="form-label">
                    Quantitée désirée : 
                    <input class="form-control" type="number" name="qtt" value="1">
                </label>
            </p>
            <p>
            <p>
                <label for="file">Fichier</label>
                <input type="file" name="file">  
            </p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </form>

         <?php
            if (isset($_SESSION["message"]))
            {
                echo $_SESSION["message"]; 
                unset($_SESSION["message"]); 
            }
          
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body> 
</html>