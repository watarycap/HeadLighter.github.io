// Récupérer tous les boutons "Ajouter au panier"
var addToCartButtons = document.querySelectorAll(".add-to-cart");

// Écouter le clic sur chaque bouton
addToCartButtons.forEach(function(button) {
  button.addEventListener("click", function(event) {
    // Récupérer les détails du produit
    var product = button.parentNode;
    var productName = product.querySelector("h2").textContent;
    var productPrice = parseFloat(product.querySelector("p:nth-of-type(3)").textContent.replace("Prix: ", ""));

    // Créer un élément li pour le produit ajouté au panier
    var cartItem = document.createElement("li");
    cartItem.textContent = productName;

    // Ajouter l'élément li au panier
    var cartItems = document.getElementById("cart-items");
    cartItems.appendChild(cartItem);

    // Mettre à jour le total du prix
    var totalPriceElement = document.getElementById("total-price");
    var totalPrice = parseFloat(totalPriceElement.textContent.replace("Total: €", ""));
    totalPrice += productPrice;
    totalPriceElement.textContent = "Total: €" + totalPrice.toFixed(2);

    // Empêcher le comportement par défaut du lien
    event.preventDefault();
  });
});

// Gérer le clic sur le bouton "Payer"
var checkoutButton = document.getElementById("checkout");
checkoutButton.addEventListener("click", function() {
  // Réinitialiser le panier et le total du prix
  var cartItems = document.getElementById("cart-items");
  cartItems.innerHTML = "";

  var totalPriceElement = document.getElementById("total-price");
  totalPriceElement.textContent = "Total: €0.00";

  // Afficher un message de confirmation ou effectuer d'autres actions (par exemple, rediriger vers une page de paiement)
  alert("Merci pour votre achat !");
});
