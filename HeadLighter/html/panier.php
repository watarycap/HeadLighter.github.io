<?php
session_start();

// Vérifier si un produit a été ajouté
if (isset($_POST['product_name']) && isset($_POST['product_price'])) {
    // Récupérer les détails du produit depuis les données postées
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    // Ajouter le produit au panier
    if (isset($_SESSION['cart'][$productName])) {
        $_SESSION['cart'][$productName]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$productName] = [
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1
        ];
    }
}

// Vider le panier
if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
    $_SESSION['cart'] = [];
}

// Mettre à jour la quantité du produit
if (isset($_POST['update_quantity'])) {
    $productName = $_POST['product_name'];
    $newQuantity = $_POST['new_quantity'];

    if (isset($_SESSION['cart'][$productName])) {
        $_SESSION['cart'][$productName]['quantity'] = $newQuantity;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../CSS/panier.css">
    <link rel="website icon" type="png" href="../Img/Logo.png">
    <meta charset="utf-8">
    <title>HeadLighter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link  href="https://fonts.googleapis.com/css2?family=Dosis&family=Noto+Sans+Chorasmian&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <ul id="BV">
            <li id="logo"><img src="../Img/Logo.png" alt="Image" height="100" width="100"></li>
            <li id="BV1">BIENVENUE CHEZ HEADLIGHTER</li>
        </ul>
        <ul id="nav">
            <li class="nav"><a class="lien" href="accueil.html">ACCUEIL</a></li>
            <li class="nav"><a class="lien" href="contact.html">CONTACT</a></li>
            <li class="nav"><a class="lien" href="boutique.html">BOUTIQUE</a></li>
            <li class="nav"><a class="lien" href="panier.php">PANIER</a></li>
        </ul>
    </header>
    <main>
        <div id="main-image"></div>
        <h1>Panier</h1>

        <?php
        if (!empty($_SESSION['cart'])) {
            // Afficher les produits ajoutés
            $total = 0;

            foreach ($_SESSION['cart'] as $product) {
                echo "<p>Produit ajouté :</p>";
                echo "<p>Nom : " . $product['name'] . "</p>";
                echo "<p>Prix : " . $product['price'] . "€</p>";
                echo "<p>Quantité : " . $product['quantity'] . "</p>";
                echo "<form action=\"panier.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"product_name\" value=\"" . $product['name'] . "\">";
                echo "<input type=\"number\" name=\"new_quantity\" value=\"" . $product['quantity'] . "\">";
                echo "<button type=\"submit\" name=\"update_quantity\">Modifier</button>";
                echo "</form>";

                $subTotal = $product['price'] * $product['quantity'];
                $total += $subTotal;

                echo "<p>Sous-total : " . $subTotal . "€</p>";
                echo "<hr>";
            }

            echo "<p>Total du panier : " . $total . "€</p>";

            if (isset($_POST['checkout'])) {
                // Vérifier le moyen de livraison sélectionné
                $selectedDeliveryMethod = $_POST['livraison'];

                // Effectuer les actions nécessaires en fonction du moyen de livraison sélectionné
                // Par exemple, calculer les frais de livraison, mettre à jour le total du panier, etc.

                // Afficher le formulaire de paiement
                echo "<h2>Interface de paiement</h2>";
                echo "<form action=\"traitement_paiement.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"total\" value=\"" . $total . "\">";
                echo "<input type=\"hidden\" name=\"livraison\" value=\"" . $selectedDeliveryMethod . "\">";
                echo "<label for=\"card_number\">Numéro de carte :</label>";
                echo "<input type=\"text\" id=\"card_number\" name=\"card_number\">";
                echo "<label for=\"card_expiry\">Date d'expiration :</label>";
                echo "<input type=\"text\" id=\"card_expiry\" name=\"card_expiry\">";
                echo "<label for=\"card_cvv\">CVV :</label>";
                echo "<input type=\"text\" id=\"card_cvv\" name=\"card_cvv\">";
                echo "<button type=\"submit\" name=\"pay\">Payer</button>";
                echo "</form>";
            }
        } else {
            echo "<p>Votre panier est vide.</p>";
        }
        ?>
        <form action="panier.php" method="post">
    <!-- ... autres éléments du panier ... -->

    <label for="livraison">Moyen de livraison :</label>
    <select id="livraison" name="livraison">
        <option value="standard">Livraison standard</option>
        <option value="express">Livraison express</option>
    </select>

    <button type="submit" name="clear_cart">Vider le Panier</button>
    <button type="submit" name="checkout">Payer</button>
</form>
    </main>
    <footer></footer>
</body>
</html>
