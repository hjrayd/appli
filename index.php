<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <title>Ajout produit</title>
    </head>
    <body>
    
        <h1>Ajouter un produit</h1>
        <form action="traitement.php" method="post">
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
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>