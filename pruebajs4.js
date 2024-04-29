document.addEventListener('DOMContentLoaded', function() {
    prueba();
});


function prueba(){
    document.getElementById('userName').textContent = 'Gabriel Munguía';
    document.getElementById('userPhoto').src = 'gabriel.png';
    document.getElementById('makesLogo').src = 'toyota.jpg';
    document.getElementById('makes').textContent = 'Toyota';
    document.getElementById('model').textContent = 'Corolla';
    document.getElementById('year').textContent = '2020';
    document.getElementById('color').textContent = 'Azul';
    document.getElementById('version').textContent = 'SE';
    document.getElementById('mileage').textContent = '20,000 km';
    document.getElementById('sales').textContent = '$1,009,895';
    document.getElementById('half').textContent = '$909,895';
    document.getElementById('purch').textContent = '$809,895';
    document.getElementById('chSales').textContent = '-$120,967';
    document.getElementById('chHalf').textContent = '-$100,038';
    document.getElementById('chPurch').textContent = '-$20,040';
    
}