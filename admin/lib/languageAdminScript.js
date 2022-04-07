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
    "back-button": "Back",
    "submit-button": "Send",
    "cancel-button": "Cancel",
    "validate-button": "Validate",
    "yes-title": "Yes",
    "no-title": "No",
    // HOME
    "public-title": "Public",
    "admin-title": "Admin",
    "useraccount-title": "User account",
    "product-title": "Product",
    "compagny-title": "Compagny",
    "warehouse-title": "Warehouse",
    // USER ACCOUNT
    "table-lastname-title": "Name",
    "table-firstname-title": "First name",
    "table-email-title": "E-mail",
    "table-action-title": "Action",
    // PRODUCT
    "informationproduct-title": "Product information",
    "addproduct-title": "Add item",
    "service-title": "Service",
    "warehouseproduct-title": "Products in a warehouse :",
    "notwarehouseproduct-title": "Products not in a warehouse :",
    "image-title": "Image",
    "image-desc": "Choose a file",
    "name-title": "Name",
    "desc-title": "Description",
    "price-title": "Price",
    "discount-title": "Discount",
    "stock-title": "Stock",
    "type-title": "Type",
    "compagny-title": "Compagny",
    "compagny-desc": "Choose a compagny",
    // COMPAGNY
    "addcompagny-title": "Add a compagny",
    "turnover-title": "Turnover",
    "contributioncompagny-title": "This company has paid its dues",
    "notcontributioncompagny-title": "This company has not yet paid its dues",
    "contributionamount-title": "Contribution amount : ",
    "change-button": "Change",
    "productcompagny-title": "All items available to the company :",
    "contributionquestion-title": "Has the company paid the contribution ?",
    "setnewturnover-title": "Fill in the new turnover of the company",
    // WAREHOUSE
    "addwarehouse-title": "Add a warehouse",
    "address-title": "Address",
    "phone-title": "Phone number",
    "warehouse-desc": "All products in the warehouse :",
    "addproduct-desc": "Choose a product to add"
  },

  // French translations
  "fr-FR": {
    // GENERAL
    "delete-button": "Supprimer",
    "back-button": "Retour",
    "submit-button": "Envoyer",
    "cancel-button": "Annuler",
    "validate-button": "Valider",
    "yes-title": "Oui",
    "no-title": "Non",
    // HOME
    "public-title": "Publique",
    "admin-title": "Administrateur",
    "useraccount-title": "Compte utilisateur",
    "product-title": "Produit",
    "compagny-title": "Entreprise",
    "warehouse-title": "Entrepôt",
    // USER ACCOUNT
    "table-lastname-title": "Nom",
    "table-firstname-title": "Prénom",
    "table-email-title": "Mail",
    "table-action-title": "Action",
    // PRODUCT
    "informationproduct-title": "Information du produit",
    "addproduct-title": "Ajouter un article",
    "service-title": "Prestation",
    "warehouseproduct-title": "Produits se trouvant dans un entrepôt :",
    "notwarehouseproduct-title": "Produits ne se trouvant pas dans un entrepôt :",
    "image-title": "Image",
    "image-desc": "Choisir un fichier",
    "name-title": "Nom",
    "desc-title": "Description",
    "price-title": "Prix",
    "discount-title": "Réduction",
    "stock-title": "Stock",
    "type-title": "Type",
    "compagny-title": "Entreprise",
    "compagny-desc": "Choisir une entreprise",
    // COMPAGNY
    "addcompagny-title": "Ajouter une entreprise",
    "turnover-title": "Chiffre d'affaire",
    "contributioncompagny-title": "Cette entreprise a payée sa cotisation",
    "notcontributioncompagny-title": "Cette entreprise n'a pas enore payée sa cotisation",
    "contributionamount-title": "Montant de la cotisation : ",
    "change-button": "Changer",
    "productcompagny-title": "Tous les articles dont dispose l'entreprise :",
    "contributionquestion-title": "L'entreprise a-t-elle payée la cotisation ?",
    "setnewturnover-title": "Renseignez le nouveau chiffre d'affaire de l'entreprise",
    // WAREHOUSE
    "addwarehouse-title": "Ajouter un entrepôt",
    "address-title": "Adresse",
    "phone-title": "Téléphone",
    "product-title": "Produit",
    "warehouse-desc": "Tous les produits se trouvant dans l'entrepôt :",
    "addproduct-desc": "Choisissez un produit à ajouter"
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
