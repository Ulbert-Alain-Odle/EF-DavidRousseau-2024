(function () {
    console.log("rest API_pays");

    // Function to fetch data based on category
    function fetchData(pays) {
        let url = `https://gftnth00.mywhc.ca/tim24/wp-json/wp/v2/posts?search=${pays}&_embed`;
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
                console.log(pays);
                let restapiPays = document.querySelector(".contenue_pays");
                restapiPays.innerHTML = ''; // Clear previous content
                data.forEach(function (article) {
                    console.log(article.acf + " " + article.data);
                    let titre = article.title.rendered;
                    let contenu = article.content.rendered;
                    let lien = article.link;
                    //contenu = truncateContent(contenu, 10);

                    let carte = document.createElement("div");
                    carte.classList.add("restapi__carte__pays");

                    // Obtenir le thumbnail de l'article, ou utiliser une image par défaut
                    let $img = article._embedded && article._embedded['wp:featuredmedia'] 
                        ? article._embedded['wp:featuredmedia'][0].source_url 
                        : 'https://via.placeholder.com/150';

                    //L'image et le site de l'image renvoi à une erreur 504

                    carte.innerHTML = `
                        <h2><a href="${lien}">${titre}</a></h2>
                        <div class="contenu__restapi__pays">
                            <img src="${$img}" alt="Thumbnail de l'article" class="thumbnail">
                            <p>${contenu}</p>
                        </div>
                    `;
                    restapiPays.appendChild(carte);
                });
            })
            .catch(function (error) {
                console.error("Erreur lors de la récupération des données :", error);
            });
    }

    // Function to truncate content
    function truncateContent(content, words) {
        return content.split(/\s+/).slice(0, words).join(" ") + '...';
    }

    // Add event listeners to pays buttons
    let boutons = document.querySelectorAll(".bouton_filtre");
    boutons.forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            let categorie = bouton.innerText;
            fetchData(categorie);
            console.log(categorie);
        });
    });

    // Fetch initial data (pays 3 by default)
    fetchData("France");
})();
