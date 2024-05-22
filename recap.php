<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Récapitulatif des produits</title>
</head>
<body>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="active"><a class="link-offset-2 link-underline link-underline-opacity-0" href="index.php">Commander</a></li>
            <li class="active"><a class="link-offset-2 link-underline link-underline-opacity-0" href="recap.php">Récapitulatif</a></li>
        </ul>
    </nav>
    <?php 
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])) {
            echo"<p>Aucun produit en session...</p>";
        } 
        else{
            echo"<table class='table'>",
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                        "<th>Supprimer</th>",
                    "<tr>",
                "</thead>",
                "<tbody>";
                    $totalGeneral = 0;
                    $nbProduit = 0;
                    foreach($_SESSION['products'] as $index => $product) {
                    echo "<tr>",
                            "<td>".$index."</td>",
                            "<td>".$product['name']."</td>",
                            "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€.</td>",
                            "<td>"."<button class='btn btn-outline-danger' id ='down' type='submit' name='down' > <a class='link-offset-2 link-underline link-underline-opacity-0' href=traitement.php?action=down-qtt&id=$index>-</a> </button>".$product['qtt']."<button class='btn btn-outline-success' id='up' type='submit' name='up'> <a class='link-offset-2 link-underline link-underline-opacity-0' href=traitement.php?action=up-qtt&id=$index> + </a></button>"."</td>",
                           
                            "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€.</td>",
                            "<td> <a class='link-offset-2 link-underline link-underline-opacity-0' href=traitement.php?action=delete&id=$index> <i class='fa-solid fa-trash'></i> </a> </td>",
                        "</tr>";
                    $totalGeneral += $product['total'];
                    $nbProduit += $product['qtt'];
                }
                    echo "<tr>",
                        "<td colspan=4> Total général : </td>",
                        "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                        $totalGeneral+= $product['total'],
                    "</tr>",
                    "<tr>",
                        "<td colspan=4> Total produits : </td>",
                        "<td><strong>".number_format($nbProduit)."</strong></td>",
                        $nbProduit+= $product['qtt'],
                    "</tr>",
                    "<tr>",
                        "<td colspan=4> Images : </td>",
                         "<td>"."<img a href=traitement.php?action=image>"."</td>",
                    "</tr>",
              "</tbody>",
            "</table>";
            echo "<button class='btn btn-danger' id='deleteAll' type='submit' name='clear'> <a class='text-reset' href=traitement.php?action=clear> Supprimer tout le panier </a> </button>";
        }
        
        if (isset($_SESSION["message"]))
        {
            echo $_SESSION["message"]; 
            unset($_SESSION["message"]); 
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>