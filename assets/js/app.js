
// on objet qui contient des fonctions
var app = {

  // // fonction d'initialisation, lancée au chargement de la page

  // init: function () {
  //   console.log('app.init !');
  //   app.addListenerToActions();
  // },

  // // méthode `addListenerToActions` dans l'objet app
  // addListenerToActions: function() {
  //   let openModal = document.getElementById('addListButton');
  //   openModal.addEventListener('click', app.showAddListModal);
  //   /*let closeModal = document.querySelectorAll('close');
  //   console.log(closeModal);
  //   closeModal.addEventListener('click', app.hideModal);*/
  // },

  // showAddListModal: function() {
  //   let openModal = document.getElementById('addListButton');
  //   openModal.classList.add("is-active");
  //   console.log(openModal);

  // }

};


// Bulma does not have JavaScript included, 
// hence custom JavaScript has to be 
// written to open or close the modal 
const modal = document.querySelector('.modal'); 
const btn = document.querySelector('#addListButton'); 
const close = document.querySelector('.delete .close'); 

btn.addEventListener('click', 
                     function () { 
  modal.style.display = 'block' 
}); 


close.addEventListener('click', 
                      function () { 
  modal.style.display = 'none' 
}) 

window.addEventListener('click', 
                        function (event) { 
  if (event.target.className === 
      'button close' || 'button is-success') { 
    modal.style.display = 'none' 
  } 
}); 



// on accroche un écouteur d'évènement sur le document : quand le chargement est terminé, on lance app.init
document.addEventListener('DOMContentLoaded', app.init );