(function () {
    console.log("rest API_pays")

    // Function to fetch data based on category
    function fetchData(category) {
        let url = `https://gftnth00.mywhc.ca/tim24/wp-json/wp/v2/posts?categories=?s${category}`;
        fetch(url)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error(
                        "La requête a échoué avec le statut " + response.status
                    );
                }
                return response.json();
            })
            .then(function (data) {
                console.log(data);
                console.log(category);
                let restapi = document.querySelector(".contenu__restapi__pays");
                //let restapiTitle = document.querySelector(".rest-API-title")
                restapi.innerHTML = ''; // Clear previous content
                data.forEach(function (article) {
                  console.log(article.acf+" "+article.data);
                    let titre = article.title.rendered;
                    let contenu = article.content.rendered;
                    let lien = article.link;
                    //let tempMin = article.acf && article.acf.temperature_minimum ? article.acf.temperature_minimum : 'Aucune temp disponible';

                    contenu = truncateContent(contenu, 10);
                    let carte = document.createElement("div");
                    carte.classList.add("restapi__carte");
                    carte.classList.add("carte");
                    carte.innerHTML = `
                        <h2>${titre}</h2>
                        <p>${contenu}</p>
                        <a href="${lien}"> En savoir plus</a>
                    `;
                    restapi.appendChild(carte);
                });
            })
            .catch(function (error) {
                console.error("Erreur lors de la récupération des données :", error);
            });
    }

    // Function to truncate content by chat gpt
    function truncateContent(content, words) {
        return content.split(/\s+/).slice(0, words).join(" ") + '...';
    }

    // Add event listeners to category buttons
    let boutons = document.querySelectorAll(".bouton_filtre");
    boutons.forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            let categorie = bouton.innerText;
            fetchData(categorie);
        });
    });

    // Fetch initial data (category 3 by default)
    fetchData("France");
})();

