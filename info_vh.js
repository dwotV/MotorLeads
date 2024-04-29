document.addEventListener('DOMContentLoaded', function() {
    makesLogo();
    showChar();
    userData();
    prices();
});

function makesLogo(){
    let makesLogo = urlParams.get('make_id');    
    document.getElementById('makesLogo').src = makesLogo;
}    

function showChar() {
    let url = window.location.href;
    let urlParams = new URLSearchParams(new URL(url).search);
    let makes_value = urlParams.get('makes_id');
    let model_value = urlParams.get('model_id');
    let year_value = urlParams.get('year_id');
    let color_value = urlParams.get('color_id');
    let version_value = urlParams.get('version_id');
    let mileage_value = urlParams.get('mileage');    
    document.getElementById('makes').textContent = makes_value;
    document.getElementById('model').textContent = model_value;
    document.getElementById('year').textContent = year_value;
    document.getElementById('color').textContent = color_value;
    document.getElementById('version').textContent = version_value;
    document.getElementById('mileage').textContent = mileage_value;
}

function userData(){
    let url = window.location.href;
    let urlParams = new URLSearchParams(new URL(url).search);
    let userName = urlParams.get('userName');
    let userPhoto = urlParams.get('userPhoto');    
    document.getElementById('userName').textContent = userName;
    document.getElementById('userName').src = userPhoto;
}

function prices(){
    let url = window.location.href;
    let urlParams = new URLSearchParams(new URL(url).search);
    let sales = urlParams.get('sales');
    let half = urlParams.get('half');
    let purch = urlParams.get('purch');
    let chSales = urlParams.get('chSales');
    let chHalf = urlParams.get('chHalf');
    let chPurch = urlParams.get('chPurch');
    document.getElementById('sales').textContent = sales;
    document.getElementById('half').textContent = half;
    document.getElementById('purch').textContent = purch;
    document.getElementById('chSales').textContent = chSales;
    document.getElementById('chHalf').textContent = chHalf;
    document.getElementById('chPurch').textContent = chPurch;
    
}


    