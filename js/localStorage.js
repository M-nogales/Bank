//coge el valor del dinero nada original para evitar error ir sumando los ditintos tipos de monedas
let saldoOriginal = parseFloat(document.getElementById("saldoTotal").innerText);

function cambiarMoneda() {
  // coge el valor del select
  let seleccionMoneda = document.getElementById("moneda").value;

  //coge el valor ya convertido usando la funcion changeDivisa
  let saldoFinal = changeDivisa(saldoOriginal, seleccionMoneda);

  // cambia el valor del h3 al correcto y le añade el simbolo de la moneda seleccionada
  document.getElementById("saldoTotal").innerText =
    saldoFinal + getSymbol(seleccionMoneda);

  // set item del local storage a la moneda seleccionada
  localStorage.setItem("monedaSeleccionada", seleccionMoneda);
}

function changeDivisa(saldoTotal, moneda) {
  // Factor de conversión según la moneda seleccionada
  switch (moneda) {
    case "Euros":
      return saldoTotal;
    case "Dólares":
      return saldoTotal * 1.1;
    case "Libras":
      return saldoTotal * 0.9;
    case "Yenes":
      return saldoTotal * 160;
    case "Rublos":
      return saldoTotal * 95;
    default:
      return saldoTotal;
  }
}

function getSymbol(moneda) {
  // Símbolo de la moneda según la moneda seleccionada
  switch (moneda) {
    case "Euros":
      return "€";
    case "Dólares":
      return "$";
    case "Libras":
      return "£";
    case "Yenes":
      return "¥";
    case "Rublos":
      return "₽";
    default:
      return "";
  }
}
// debuging
function cambiarMoneda2() {
    console.log("La moneda ha cambiado");
    // Resto del código...
    let seleccionMoneda = document.getElementById("moneda").value;
    console.log("Valor seleccionado: " + seleccionMoneda);
    let saldoTotal = parseFloat(document.getElementById("saldoTotal").innerText);
    console.log(saldoTotal);
}
// cuando la pagina está completamente cargada ejecuta la funcion
window.onload = function () {
    // miramos los items del localstorage para coger la almacenada por defecto
    console.log("La página se ha cargado");
  let monedaAlmacenada = localStorage.getItem("monedaSeleccionada");
  if (monedaAlmacenada) {
    document.getElementById("moneda").value = monedaAlmacenada;
    cambiarMoneda();
  }
};
