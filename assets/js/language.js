document.addEventListener("DOMContentLoaded", function () {
  const languageSelector = document.getElementById("language");

  const translations = {
    en: {
      aboutUs: "About Us",
      aboutUsContent:
        "We are a dedicated platform committed to connecting pet lovers with top-quality pet products and services. Our mission is to provide a seamless shopping experience for pet owners, ensuring they findeverything they need to keep their pets happy and healthy. Our team is passionate about making it easy for pet owners to access trusted products and services.",
      ourValues: "Our Values",
      ourValuesContent:
        "We believe in transparency, quality, and the well-being of pets and their owners. Our marketplace is built on trust and strives to foster meaningful connections between suppliers and pet enthusiasts.",
      contactUs: "Contact Us",
    },
    de: {
      aboutUs: "Über uns",
      aboutUsContent:
        "Wir sind eine engagierte Plattform, die es sich zur Aufgabe gemacht hat, Tierliebhaber mit qualitativ hochwertigen Produkten und Dienstleistungen für Haustiere zu verbinden. Unser Ziel ist es, Tierhaltern ein nahtloses Einkaufserlebnis zu bieten und sicherzustellen, dass sie alles finden, was sie brauchen, um ihre Haustiere glücklich und gesund zu halten. Unser Team hat es sich zur Aufgabe gemacht, Tierhaltern den Zugang zu vertrauenswürdigen Produkten und Dienstleistungen zu erleichtern.",
      ourValues: "Unsere Werte",
      ourValuesContent:
        "Wir glauben an Transparenz, Qualität und das Wohlbefinden von Haustieren und ihren Besitzern. Unser Marktplatz baut auf Vertrauen auf und ist bestrebt, sinnvolle Verbindungen zwischen Anbietern und Tierliebhabern zu fördern.",
      contactUs: "Kontaktiere uns",
    },
    es: {
      aboutUs: "Sobre nosotros",
      aboutUsContent:
        "Somos una plataforma dedicada a conectar a los amantes de las mascotas con productos y servicios de calidad. Nuestra misión es proporcionar una experiencia de compra sencilla para los dueños de mascotas, asegurando que encuentren todo lo necesario para mantener felices y saludables a sus mascotas. Nuestro equipo está comprometido con facilitar el acceso a productos y servicios de confianza.",
      ourValues: "Nuestros valores",
      ourValuesContent:
        "Creemos en la transparencia, la calidad y el bienestar de las mascotas y sus dueños. Nuestro mercado se basa en la confianza y se esfuerza por fomentar conexiones significativas entre proveedores y entusiastas de las mascotas.",
      contactUs: "Contáctanos",
    },
  };

  languageSelector.addEventListener("change", function () {
    const selectedLanguage = languageSelector.value;

    document.querySelector("h2.title.is-3").textContent =
      translations[selectedLanguage].aboutUs;
    document.querySelectorAll("p.content")[0].textContent =
      translations[selectedLanguage].aboutUsContent;

    document.querySelectorAll("h2.title.is-3")[1].textContent =
      translations[selectedLanguage].ourValues;
    document.querySelectorAll("p.content")[1].textContent =
      translations[selectedLanguage].ourValuesContent;

    document.querySelector("h1.title.is-3").textContent =
      translations[selectedLanguage].contactUs;
  });
});
