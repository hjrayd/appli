<?php 
    session_start();
    if(isset($_GET['action'])) {
        switch($_GET['action']) {
    
            //ajouter des produits
            case "add": if (isset($_POST['submit'])){

                if(isset($_FILES['file'])){
                    $tmpName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];

        
                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));
                    //Tableau des extensions que l'on accepte 
                    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                    $maxSize = 400000;

                    if(in_array($extension, $extensions) && $size <= $maxSize && $error==0) {

                    $uniqueName = uniqid('', true);
                    $file= $uniqueName.".".$extension;
                    move_uploaded_file($tmpName, './upload/'.$file);
                   
                }
                else {
                    echo "Une erreur est survenue";
                }

               $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

                    if($name && $price && $qtt) {

                        $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "nbProduit" => $nbProduit,
                        "total" => $price*$qtt,
                        "file" => $file
                        ];
               
                $_SESSION['products'][] = $product;
                $_SESSION['message'] = "Les produits ont bien été ajouté à votre panier.";
                
                    } else {
                        $_SESSION['message'] ="Les produits n'ont pas pu être ajouté à votre panier.";
                        }
                    
                    
                    
                    }

            }
                


                    
        
                header("Location:index.php");
                break;

            //supprimer un produit au choix
                                                            //$product
            case "delete" : if (isset($_SESSION['products'][$_GET['id']])) {
                                                        //$product
                            unset($_SESSION['products'][$_GET['id']]);
                            $_SESSION['message'] ="Le produit a bien été supprimé.";
                                }
                                header("Location:recap.php");
                                break;

            //supprimer tous les produits
            case "clear" : 
                    if (isset($_SESSION['products'])) {
                        unset($_SESSION['products']);   
                        $_SESSION['message'] ="Votre panier a bien été supprimé."; 
                    }
                    header("Location:recap.php");
                    break;

            //Augmenter la quantité d'un produit 
            case "up-qtt" :
                if (isset($_SESSION['products'][$_GET['id']]['qtt'])) {
                    $_SESSION['products'][$_GET['id']]['qtt']++; 
                    $_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['price']* $_SESSION['products'][$_GET['id']]['qtt'];
                }
                header("Location:recap.php");
                break;
            
            //Diminuer la quantité d'un produit
            case "down-qtt" :
                if (isset($_SESSION['products'][$_GET['id']]['qtt'])) {

                    if ($_SESSION['products'][$_GET['id']]['qtt']>1) {
                    $_SESSION['products'][$_GET['id']]['qtt']--; 
                    $_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['price']* $_SESSION['products'][$_GET['id']]['qtt'];
                } else {
                    unset($_SESSION['products'][$_GET['id']]);
                }
                }
                header("Location:recap.php");
                break;

            //ajouter une image
            case "image"; 
            
        }
    }     
    
 //Definir la faille upload -> c'est une faille qui permet d'envoyer des fichiers avec une extension non autorisée
//Donner les etapes pour se proteger de la faille -> On précise quelles extensions on accepte dans notre formulaire, ici avec $extensions on limite la taille des fichiers on hache le nom des fichiers ou uniqid. Utilisation de mimetype
//Mimetype -> extension qui permet de définir la nature et les données d'un fichier. Permet de vérifier qu'un fichier correspond réellement à son extension 
//Uniqid pourquoi ? Permet de générer un identifiant unique afin de ne pas écraser d'autres fichiers posté antérieurement qui pourraient avoir le même nom


   ?>
   
   