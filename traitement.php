<?php 
    session_start();
    if(isset($_GET['action'])) {
        switch($_GET['action']) {
    
            //ajouter des produits
            case "add": if (isset($_POST['submit'])){

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
                        ];

            
                $_SESSION['products'][] = $product;
                $_SESSION['message'] = "Les produits ont bien été ajouté à votre panier.";
                
                    } else {
                        $_SESSION['message'] ="Les produits n'ont pas pu être ajouté à votre panier.";
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
                    unset($_SESSION['products']); 
                }
                }
                header("Location:recap.php");
                break;
        }
            
    }
 
   ?>