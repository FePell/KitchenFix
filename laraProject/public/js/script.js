
$(function () { //Esegue questo codice quando la pagina è pronta

    //Conferma eliminazione di un elemento 
    //(prodotto, centro, tecnico, malfunzionamento)
    $('.delete-form').on('submit', function(e) {
        if (!confirm("Sei sicuro di voler eliminare questo elemento?")) {
            e.preventDefault();
        }
    });

    //Ricerca prodotti AJAX 
    $('#search-form').on('submit', function (e) { //Blocca submit del form
        e.preventDefault();

        let ricerca = $('#search').val(); 

        $.ajax({ //Chiamata AJAX - Invia richiesta al server senza ricaricare la pagina
            url: "products", //Dove viene mandata la richiesta
            type: "GET", 
            data: { search: ricerca }, 
            
            success: function (response) { 
                
                let html = ''; //Variabile dove verranno costruiti i prodotti

                $('#search-error').text(''); //Cancella eventuali errori precedenti

                if (response.searchError) {
                    $('#search-error').text(response.searchError); 
                }

                if (response.products.length > 0) { 
                    html += '<div class="products-grid">';

                    response.products.forEach(function (product) { 
                        html += `
                            <article class="product-card">
                                <div class="product-card-image">
                                    <img src="images/${product.image}" alt="${product.name}">
                                </div>

                                <div class="product-card-content">
                                    <h3 class="product-title">${product.name}</h3>

                                    <a href="products/${product.id}" class="product-details-btn">
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