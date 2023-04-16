document.querySelector("form").addEventListener("submit", function (event) { 
  event.preventDefault(); //zamezí odeslání formuláře a zobrazení výchozí stránky
  document.querySelector("form").style.display = "none";
  document.querySelector("video").style.display = "none";
  Kompas();
  OtocKompas("nahoru");
  var poleLengthX = document.getElementById("poleLengthX").value;
  var poleLengthY = document.getElementById("poleLengthY").value;
  var poleSize = [parseInt(poleLengthX), parseInt(poleLengthY)];
  console.log("velikost pole: " + poleSize);

  var audio = new Audio('./files/hudbabg.mp3');
  audio.loop = true;
  audio.play();

  let pokladX = getRandomNumber(0, poleLengthX-2);
  let pokladY = getRandomNumber(0, poleLengthY-2);

  console.log("souřadnice pokladu: " + pokladX, pokladY);
  
  let widthPole = 500 / poleLengthX;
  let heightPole = 500 / poleLengthY;

  console.log("šířka pole: "+ widthPole, "výška pole: "+ heightPole);

  const pole = document.querySelector(".gameArea");
  pole.style.backgroundImage = "url(" + "files/map.png" + ")";
  for (let i = 0; i < poleLengthX; i++) {
    for (let j = 0; j < poleLengthY; j++) {
      const div = document.createElement("div");
      div.classList.add("pole");
      div.style.width = widthPole + "px";
      div.style.height = heightPole + "px";
      pole.appendChild(div);
      setTimeout(() => {
        div.classList.add("animate");
      }, 70 * i); //delay pro každý nový prvek
    }
    const div = document.createElement("div");
    div.classList.add("clear");
    pole.appendChild(div);
  }

  let pocetKliknuti = 0;

  const poleDiv = document.querySelectorAll(".pole");
  poleDiv.forEach((pole) => {
    pole.addEventListener("click", () => {
      let index = Array.prototype.indexOf.call(poleDiv, pole);
      let x = index % poleSize[0];
      let y = Math.floor(index / poleSize[0]);
      console.log(x, y);
      pocetKliknuti++;
      if (x < pokladX && y < pokladY) {
        console.log("Doprava dolů");
        OtocKompas("doprava dolů");
      } else if (x > pokladX && y < pokladY) {
        console.log("Doleva dolů");
        OtocKompas("doleva dolů");
      } else if (x < pokladX && y > pokladY) {
        console.log("Doprava nahoru");
        OtocKompas("doprava nahoru");
      } else if (x > pokladX && y > pokladY) {
        console.log("Doleva nahoru");
        OtocKompas("doleva nahoru");
      } else if (x < pokladX && y == pokladY) {
        console.log("Doprava");
        OtocKompas("doprava");
      } else if (x > pokladX && y == pokladY) {
        console.log("Doleva");
        OtocKompas("doleva");
      } else if (x == pokladX && y < pokladY) {
        console.log("Dolů");
        OtocKompas("dolů");
      } else if (x == pokladX && y > pokladY) {
        console.log("Nahoru");
        OtocKompas("nahoru");
      } else if (x == pokladX && y == pokladY) {
        console.log("Nalezeno");
        OtocKompas("nahoru");
        console.log(pocetKliknuti);
        Dokonceno(pocetKliknuti, poleLengthX, poleLengthY);
      }

      if(pole.style.backgroundColor == "red"){
        pocetKliknuti--;
      }

      if(x != pokladX || y != pokladY){
        pole.style.backgroundColor = "red";
      }
    });
  });
});

function Kompas() {
  const kompasDiv = document.createElement("div");
  kompasDiv.classList.add("kompasDiv");
  document.body.appendChild(kompasDiv);

  const kompas = document.createElement("img");
  kompas.src = "files/kompas.png";
  kompas.classList.add("kompas");
  kompasDiv.appendChild(kompas);

  const smer = document.createElement("img");
  smer.src = "files/sipka.png";
  smer.classList.add("kompasSmer");
  kompasDiv.appendChild(smer);
}

function OtocKompas(smersipky) {
  const smer = document.querySelector(".kompasSmer");
  if (smersipky == "nahoru") {
    smer.style.transform = "rotate(0deg)";
  } else if (smersipky == "doprava") {
    smer.style.transform = "rotate(90deg)";
  } else if (smersipky == "doleva") {
    smer.style.transform = "rotate(-90deg)";
  } else if (smersipky == "dolů") {
    smer.style.transform = "rotate(180deg)";
  } else if (smersipky == "doprava dolů") {
    smer.style.transform = "rotate(135deg)";
  } else if (smersipky == "doleva dolů") {
    smer.style.transform = "rotate(-135deg)";
  } else if (smersipky == "doprava nahoru") {
    smer.style.transform = "rotate(45deg)";
  } else if (smersipky == "doleva nahoru") {
    smer.style.transform = "rotate(-45deg)";
  }
}

function Dokonceno(pocet, x, y) {
  document.querySelector(".gameArea").style.display = "none";
  document.querySelector(".kompasDiv").style.display = "none";
  document.querySelector(".done").style.display = "block";
  document.getElementById("poleLength").innerHTML = "Pole: " + x + "x" + y;
  document.getElementById("pocet").innerHTML = pocet + "x";

  // Odeslání dat na server pomocí AJAX požadavku
  $.ajax({
    url: "./server.php", 
    type: "POST",
    name: "savedata",
    data: {
      user_id: 1,
      poleX: x,
      poleY: y,
      click: pocet,
    },
    success: function (response) {
      // V případě úspěšného uložení dat
      console.log("Data byla úspěšně uložena");
    },
    error: function () {
      // V případě chyby při ukládání dat
      console.log("Došlo k chybě při ukládání dat");
    },
  });
}

function getRandomNumber(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}