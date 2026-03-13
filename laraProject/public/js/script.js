
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