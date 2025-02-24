const modal = document.getElementById("modalInvestimento");
const modalOrcamento = document.getElementById("modalOrcamento");

const btn = document.getElementById("btnModal");
const btnOrcamento = document.getElementById("btnOrcamento");

const span = document.getElementsByClassName("close")[0];
const spanOrcamento = document.getElementsByClassName("closeOrcamento")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

btnOrcamento.onclick = function() {
    modal.style.display = "none";
    modalOrcamento.style.display = "block"
}

spanOrcamento.onclick = function() {
    modalOrcamento.style.display = "none";
  }
