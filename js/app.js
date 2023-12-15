



var modal = document.getElementById('simpleModal');
var modalButton = document.getElementById('modalButton');
var closeBtn = document.getElementsByClassName('closeButton')[0];
var alCloseBtn = document.getElementsByClassName('alcloseBtn')[0];


modalButton.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
alCloseBtn.addEventListener('click', closemodule);

function openModal(){
  modal.style.display = 'block';
}

function closeModal(){
  modal.style.display = 'none';
}

function closemodule() {
  modal.style.display = 'none';
}