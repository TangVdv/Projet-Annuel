// The locale our app first shows
var defaultLocale = sessionStorage.getItem('locale');
if (defaultLocale == null) {
  if (navigator.language == null) {
    defaultLocale = "en-US";
  }
  else {
    defaultLocale = navigator.language;
  }
}

// The active locale
let locale;

import {translations} from './language.js';

document.addEventListener("DOMContentLoaded", () => {
  // Translate the page to the default locale
  setLocale(defaultLocale);
  switchElement();

  bindLocaleSwitcher(defaultLocale);
});

async function setLocale(newLocale) {
  if (newLocale === locale)
    return;

  locale = newLocale;
  sessionStorage.setItem('locale', locale);
  translatePage();
}

function translatePage() {
  document
    .querySelectorAll("[translate-key]")
    .forEach(translateElement);
}

function switchElement(){
  const select = document.getElementById('select-language');
  Object.keys(translations).forEach(key => {

    var opt = document.createElement('option');
    opt.value = key;
    opt.innerHTML = translations[key]["locale"];
    select.appendChild(opt);
  });

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
