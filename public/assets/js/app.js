// ==============================
// Navbar Toggle
// ==============================
document.addEventListener("DOMContentLoaded", () => {
    const bar = document.getElementById('bar');
    const close = document.getElementById('close');
    const nav = document.getElementById('navbar');

    if (bar) {
        bar.addEventListener('click', () => nav.classList.add('active'));
    }

    if (close) {
        close.addEventListener('click', () => nav.classList.remove('active'));
    }

    // Scroll-to-top Button
    const toTop = document.querySelector(".to-top");
    window.addEventListener("scroll", () => {
        if (window.pageYOffset > 100) {
            toTop?.classList.add("active");
        } else {
            toTop?.classList.remove("active");
        }
    });

    afficherPanier();
});

// ==============================
// Cart Functionality
// ==============================

// Add product to cart
function ajouterAuPanier(id, name, prix, photo, quantite) {
    const produit = {
        id,
        name,
        prix,
        photo,
        quantite: parseInt(quantite)
    };

    let panier = JSON.parse(localStorage.getItem("panier")) || [];

    // Check if already in cart and update quantity
    const index = panier.findIndex(p => p.id === id);
    if (index !== -1) {
        panier[index].quantite += produit.quantite;
    } else {
        panier.push(produit);
    }

    localStorage.setItem("panier", JSON.stringify(panier));
    alert("Produit ajouté au panier !");
    afficherPanier();
}

// Make the function available globally for HTML event handlers
window.ajouterAuPanier = ajouterAuPanier;

// Display cart items
function afficherPanier() {
    const panierTable = document.getElementById("panier-items");
    const totalPriceEl = document.querySelector(".total-price td:last-child");
    let panier = JSON.parse(localStorage.getItem("panier")) || [];
    let grandTotal = 0;

    if (!panierTable) return;

    panierTable.innerHTML = "";

    panier.forEach(produit => {
        const itemTotal = parseFloat(produit.prix) * produit.quantite;
        grandTotal += itemTotal;

        const row = `
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="${produit.photo}" alt="${produit.name}" width="50">
                        <div>
                            <p>${produit.name}</p>
                            <small>Prix: ${produit.prix}$</small>
                            <br/>
                            <a href="#" onclick="removeProduit('${produit.id}'); return false;">Supprimer</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="${produit.quantite}" min="1" onchange="updateQuantite('${produit.id}', this.value)"></td>
                <td>${itemTotal.toFixed(2)}$</td>
            </tr>
        `;

        panierTable.innerHTML += row;
    });

    if (totalPriceEl) {
        totalPriceEl.innerHTML = `${grandTotal.toFixed(2)}$`;
    }
}

// Update quantity
function updateQuantite(id, quantite) {
    let panier = JSON.parse(localStorage.getItem("panier")) || [];
    const index = panier.findIndex(p => p.id === id);
    if (index !== -1) {
        panier[index].quantite = parseInt(quantite);
        localStorage.setItem("panier", JSON.stringify(panier));
        afficherPanier();
    }
}

// Remove product
function removeProduit(id) {
    let panier = JSON.parse(localStorage.getItem("panier")) || [];
    panier = panier.filter(p => p.id !== id);
    localStorage.setItem("panier", JSON.stringify(panier));
    afficherPanier();
}

// ==============================
// Checkout Function
// ==============================
function validerCommande() {
    const panier = JSON.parse(localStorage.getItem("panier")) || [];

    if (panier.length === 0) {
        // Display a user-friendly message instead of alert
        const panierMessage = document.getElementById("panier-message");
        if (panierMessage) {
            panierMessage.textContent = "Votre panier est vide.";
            panierMessage.style.display = "block";
        }
        return;
    }

    fetch('/checkout', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify({ produits: panier })
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                throw new Error(text || "Erreur lors de la commande");
            });
        }
        return response.json();
    })
    .then(data => {
        // Display a user-friendly message instead of alert
        const panierMessage = document.getElementById("panier-message");
        if (panierMessage) {
            panierMessage.textContent = data.message || "Commande validée !";
            panierMessage.style.display = "block";
        }
        localStorage.removeItem("panier");
        window.location.href = "/checkout";
    })
    .catch(error => {
        console.error("Erreur:", error);
        const panierMessage = document.getElementById("panier-message");
        if (panierMessage) {
            panierMessage.textContent = `Erreur lors de la commande: ${error.message}`;
            panierMessage.style.display = "block";
        }
    });
}

// Make the function available globally for HTML event handlers
window.validerCommande = validerCommande;
