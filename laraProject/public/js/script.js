
//Funzione per confermare l'eliminazione di un elemento 
//(prodotto, centro, tecnico, malfunzionamento)

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-form").forEach(function(form) {
        form.addEventListener("submit", function(e) {

            if (!confirm("Sei sicuro di voler eliminare questo elemento?")) {
                e.preventDefault();
            }
            
        });
    });
});


//Funzione con AJAX per la ricerca dei prodotti
//Quando l'utente scrive nella barra di ricerca e clicca su Cerca, 
//manda una richiesta al server, che aggiorna i prodotti senza ricaricare la pagina.

$(function () { //Esegue questo codice quando la pagina è pronta

    $('#search-form').on('submit', function (e) { //Blocca submit del form
        e.preventDefault();

        let ricerca = $('#search').val(); //Prende il testo scritto dall'utente

        $.ajax({ //Chiamata AJAX - Invia richiesta al server senza ricaricare la pagina
            url: "/products", //Dove viene mandata la richiesta
            type: "GET", //Tipo di richiesta
            data: { search: ricerca }, //Dati che vengono inviati al server
            
            success: function (response) { //Il server Laravel restituisce (response) ciò che ha trovato
                
                let html = ''; //Variabile dove verranno costruiti i prodotti

                $('#search-error').text(''); //Cancella eventuali errori precedenti

                if (response.searchError) { //Se viene generato un errore (es. uso sbagliato di *)
                    $('#search-error').text(response.searchError); //Si mostra nella pagina
                }

                if (response.products.length > 0) { //Controlla se ci sono dei risultati
                    html += '<div class="products-grid">';

                    response.products.forEach(function (product) { //Per ogni prodotto si costruisce la card
                        html += `
                            <article class="product-card">
                                <div class="product-card-image">
                                    <img src="/images/${product.image}" alt="${product.name}">
                                </div>

                                <div class="product-card-content">
                                    <h3 class="product-title">${product.name}</h3>

                                    <a href="/products/${product.id}" class="product-details-btn">
                                        Visualizza dettagli
                                    </a>
                                </div>
                            </article>
                        `;
                    });

                    html += '</div>'; //Chiusura griglia
                } else { //Se non ci sono prodotti
                    html = '<p class="no-products">Nessun prodotto trovato.</p>';
                }
                $('#products-container').html(html); //Sostituisce il contenuto della pagina con i nuovi risultati
            }
        });
    });
});