let currentScreen = "diary";


function showScreen(screen){
  document.getElementById(currentScreen).classList.remove("active");
  document.getElementById(screen).classList.add("active");
  currentScreen = screen;
  if(screen === "dashboard") drawChart();
}


const ctx = document.getElementById('macroChart').getContext('2d');
let chart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['Carbs', 'Protein', 'Fat'],
    datasets: [{
      data: [0,0,0],
      backgroundColor: ['#4CAF50', '#2196F3', '#FF5722']
    }]
  }
});
function drawChart(){
  chart.data.datasets[0].data = [macros.C, macros.P, macros.F];
  chart.update();
}


const foodDummy = {
  "123": { name:"Apple", C:25, P:0, F:0 },
  "456": { name:"Chicken", C:0, P:27, F:3 },
  "789": { name:"Rice", C:45, P:4, F:1 }
};


function scanBarcode() {
  const code = document.getElementById('barcodeInput').value;
  const result = foodDummy[code];
  if(result){
    if(result.C+result.P+result.F <= 100){
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "";

        let fields = {
          foodName: result.name,
          carbs: result.C,
          protein: result.P,
          fat: result.F
        };

        for (let key in fields){
          let input = document.createElement("input");
          input.type = "hidden";
          input.name = key;
          input.value = fields[key];
          form.appendChild(input);
        }

        document.body.appendChild(form);
        form.submit();
    }
    document.getElementById('scanResult').textContent =
      `${result.name} (C:${result.C}/P:${result.P}/F:${result.F})`;
  } else {
    document.getElementById('scanResult').textContent = 'Food not found';
  }
}
