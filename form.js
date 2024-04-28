
function getMakeID() {
    let make_value = document.options_motorleads.makes.value;
    document.options_motorleads.model.disabled = false;
    
    console.log(make_value);
    let url = "http://localhost/RETO/form.php?make_id="+make_value;

    window.history.pushState({}, '', url);
    location.reload();

}

function getModelID() {
    let make_value = document.options_motorleads.makes.value;
    let model_value = document.options_motorleads.model.value;
    document.options_motorleads.year.disabled = false;
    
    console.log(model_value);
    let url = "http://localhost/RETO/form.php?make_id="+make_value+"&model_id="+model_value;

    window.history.pushState({}, '', url);
    location.reload();
}

function getYearID() {
    let make_value = document.options_motorleads.makes.value;
    let model_value = document.options_motorleads.model.value;
    let year_value = document.options_motorleads.year.value;
    document.options_motorleads.version.disabled = false;
    
    console.log(model_value);
    let url = "http://localhost/RETO/form.php?make_id="+make_value+"&model_id="+model_value+"&year_id="+year_value;

    window.history.pushState({}, '', url);
    location.reload();
}

function getVersionID() {
    let make_value = document.options_motorleads.makes.value;
    let model_value = document.options_motorleads.model.value;
    let year_value = document.options_motorleads.year.value;
    let version_value = document.options_motorleads.version.value;
    document.options_motorleads.color.disabled = false;
    
    console.log(model_value);
    let url = "http://localhost/RETO/form.php?make_id="+make_value+"&model_id="+model_value+"&year_id="+year_value+"&version_id="+version_value;

    window.history.pushState({}, '', url);
    location.reload();
}