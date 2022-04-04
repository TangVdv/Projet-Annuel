// The locale our app first shows
var defaultLocale;
if (navigator.language == null) {
  defaultLocale = "en-US";
}
else {
  defaultLocale = navigator.language;
}

// The active locale
let locale;

const translations = {
  // English translations
  "en-US": {
    // GENERAL
    "delete-button": "Delete",
    // HOME
    "home-title": "Home",
    "market-title": "Store",
    "logout-title": "LogOut",
    "account-title": "Account",
    "basket-title": "Basket",
    "login-title": "Login",
    "register-title": "Registration",
    "search-bar": "Looking for a product ?",
    "footer-desc-website": "Loyalty Card is an online sales site that allows you to buy products but also services. You have the possibility to take advantage of our loyalty advantages by accumulating points through your purchases. In the same way, you can view your advantages by opening the 3D shop.",
    "footer-desc-project": "Loyalty Card project by : Frédéric Sananes, Kamal Hennou",
    // LOGIN-REGISTER
    "loginPage-title": "Identify yourself :",
    "email-input": "Email",
    "password-input": "Password",
    "lastname-input": "Name",
    "firstname-input": "First name",
    "phone-input": "Phone number",
    "address-input": "Address",
    "connected-checkbox": "Stay connected",
    "password-forgotten-text": "Forgot your password ?",
    "notregisted-question": "You do not have an account ?",
    "alreadyregisted-question": "Already have an account ?",
    "register-button": "Create an account",
    "registerPage-id-title": "Your informations",
    "registerPage-personalInfo-title": "Your personal informations",
    // BASKET
    "basket-title": "Your basket",
    "basket-price": "Total price : ",
    "basket-button": "Finalize the order",
    // MARKET
    "market-button": "Add to cart",
    "outofstock-button": "Sold out"
  },

  // French translations
  "fr-FR": {
    // GENERAL
    "delete-button": "Supprimer",
    // HOME
    "home-title": "Accueil",
    "market-title": "Magasin",
    "logout-title": "Déconnexion",
    "account-title": "Compte",
    "basket-title": "Panier",
    "login-title": "Connexion",
    "register-title": "Inscription",
    "search-bar": "Vous cherchez un produit ?",
    "footer-desc-website": "Loyalty Card est un site de vente en ligne qui vous permet d'acheter des produits mais aussi des prestations. Vous avez la possibilité de profiter de nos avantages de fidélité en accumulant des points à travers vos achats. De la même manière, vous pouvez visualiser vos avantages en ouvrant la boutique 3D.",
    "footer-desc-project": "Loyalty Card, un projet par : Frédéric Sananes, Kamal Hennou",
    // LOGIN-REGISTER
    "loginPage-title": "Identifiez-vous :",
    "email-input": "Adresse mail",
    "password-input": "Mot de passe",
    "lastname-input": "Nom",
    "firstname-input": "Prénom",
    "phone-input": "Numéro de téléphone",
    "address-input": "Adresse",
    "connected-checkbox": "Rester connecté",
    "password-forgotten-text": "Vous avez oublié votre mot de passe ?",
    "notregisted-question": "Vous n'avez pas de compte ?",
    "alreadyregisted-question": "Vous avez déjà un compte ?",
    "register-button": "Créer un compte",
    "registerPage-id-title": "Vos identifiants",
    "registerPage-personalInfo-title": "Vos informations personnelles",
    // BASKET
    "basket-title": "Panier",
    "basket-price": "Prix total : ",
    "basket-button": "Finaliser la commande",
    // MARKET
    "market-button": "Ajouter au panier",
    "outofstock-button": "Rupture de stock"
  },
};

// When the page content is ready...
document.addEventListener("DOMContentLoaded", () => {
  // Translate the page to the default locale
  setLocale(defaultLocale);

  bindLocaleSwitcher(defaultLocale);
});

async function setLocale(newLocale) {
  if (newLocale === locale)
    return;

  locale = newLocale;
  translatePage();
}

function translatePage() {
  document
    .querySelectorAll("[translate-key]")
    .forEach(translateElement);
}

function translateElement(element) {
  const key = element.getAttribute("translate-key");
  const translation = translations[locale][key];
  element.innerText = translation;
  element.placeholder = translation;
}

function bindLocaleSwitcher(initialValue) {
  const switcher = document.querySelector("[translate-switcher]");
  switcher.value = initialValue;
  switcher.onchange = (e) => {
    // Set the locale to the selected option[value]
    setLocale(e.target.value);
  };
}
