document.querySelector("form").addEventListener("submit", function (event) {
  event.preventDefault(); // zamezí odeslání formuláře a zobrazení výchozí stránky
  var poleLengthX = document.getElementById("poleLengthX").value;
  var poleLengthY = document.getElementById("poleLengthY").value;
  var poleSize = [parseInt(poleLengthX), parseInt(poleLengthY)]; // pole s čísly
  console.log(poleSize); // výpis pole do konzole pro kontrolu

  let widthPole = 500 / poleSize[1] - 2; // odečtení 2px šířky ohraničení (.pole border)
  let heightPole = 500 / poleSize[0] - 2; // odečtení 2px výšky ohraničení (.pole border)

  const pole = document.querySelector(".gameArea");
  for (let i = 0; i < poleSize[0]; i++) {
    for (let j = 0; j < poleSize[1]; j++) {
      const div = document.createElement("div");
      div.classList.add("pole");
      div.style.width = widthPole + "px";
      div.style.height = heightPole + "px";
      pole.appendChild(div);
      setTimeout(() => {
        div.classList.add('animate');
      }, 50 * i); // delay pro každý nový prvek
    }
    const div = document.createElement("div");
    div.classList.add("clear");
    pole.appendChild(div);
  }
});
