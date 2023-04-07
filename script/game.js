document.querySelector("form").addEventListener("submit", function (event) {
  event.preventDefault(); //zamezí odeslání formuláře a zobrazení výchozí stránky
  var poleLengthX = document.getElementById("poleLengthX").value;
  var poleLengthY = document.getElementById("poleLengthY").value;
  var poleSize = [parseInt(poleLengthX), parseInt(poleLengthY)];
  console.log(poleSize);

  let pokladX = getRandomNumber(0, poleSize[0]-1);
  let pokladY = getRandomNumber(0, poleSize[1]-1);

  console.log(pokladX, pokladY);

  let widthPole = 500 / poleSize[1] - 2;
  let heightPole = 500 / poleSize[0] - 2;

  const pole = document.querySelector(".gameArea");
  for (let i = 0; i < poleSize[0]; i++) {
    for (let j = 0; j < poleSize[1]; j++) {
      const div = document.createElement("div");
      div.classList.add("pole");
      div.style.width = widthPole + "px";
      div.style.height = heightPole + "px";
      pole.appendChild(div);
      setTimeout(() => {
        div.classList.add("animate");
      }, 70 * i); //delay pro každý nový prvek
      if (i == pokladY && j == pokladX) {
        div.classList.add("poklad");
      }
    }
    const div = document.createElement("div");
    div.classList.add("clear");
    pole.appendChild(div);
  }

  const poleDiv = document.querySelectorAll(".pole");
  poleDiv.forEach((pole) => {
    pole.addEventListener("click", () => {
      let index = Array.prototype.indexOf.call(poleDiv, pole);
      let x = index % poleSize[1];
      let y = Math.floor(index / poleSize[1]);
      console.log(x, y);
      if (x < pokladX && y < pokladY) {
        console.log("Doprava dolů");
        Kompas("doprava dolů");
      } else if (x > pokladX && y < pokladY) {
        console.log("Doleva dolů");
        Kompas("doleva dolů");
      } else if (x < pokladX && y > pokladY) {
        console.log("Doprava nahoru");
        Kompas("doprava nahoru");
      } else if (x > pokladX && y > pokladY) {
        console.log("Doleva nahoru");
        Kompas("doleva nahoru");
      } else if (x < pokladX && y == pokladY) {
        console.log("Doprava");
        Kompas("doprava");
      } else if (x > pokladX && y == pokladY) {
        console.log("Doleva");
        Kompas("doleva");
      } else if (x == pokladX && y < pokladY) {
        console.log("Dolů");
        Kompas("dolů");
      } else if (x == pokladX && y > pokladY) {
        console.log("Nahoru");
        Kompas("nahoru");
      } else if (x == pokladX && y == pokladY) {
        console.log("Nalezeno");
        Kompas("nahoru");
      }
    });
  });
});

Kompas("nahoru");

function Kompas(smersipky){
  const kompasDiv = document.createElement("div");
  kompasDiv.classList.add("kompasDiv");
  document.body.appendChild(kompasDiv);


  const kompas = document.createElement("img");
  kompas.src = "files/kompas.png";
  kompas.classList.add("kompas");
  kompasDiv.appendChild(kompas);

  const smer = document.createElement("img");
  smer.src = "files/rucicka1.png";
  smer.classList.add("kompasSmer");
  kompasDiv.appendChild(smer);
  if(smersipky == "nahoru"){
    smer.style.transform = "rotate(0deg)";
  }else if(smersipky == "doprava"){
    smer.style.transform = "rotate(90deg)";
  }else if(smersipky == "doleva"){
    smer.style.transform = "rotate(-90deg)";
  }else if(smersipky == "dolů"){
    smer.style.transform = "rotate(180deg)";
  }
}

function getRandomNumber(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}
