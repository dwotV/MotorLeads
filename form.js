function getMakeID() {
    let make_value = document.options_motorleads.makes.value;
    if (make_value !== "") {
        document.options_motorleads.model.disabled = false;
        updateURL();
    }
    else {
        document.options_motorleads.model.disabled = true;
        document.options_motorleads.year.disabled = true;
        document.options_motorleads.version.disabled = true;
    }
}

function getModelID() {
    let model_value = document.options_motorleads.model.value;
    if (model_value !== "") {
        document.options_motorleads.year.disabled = false;
        updateURL();
    }
    else {
        document.options_motorleads.year.disabled = true;
        document.options_motorleads.version.disabled = true;
    }
}

function getYearID() {
    let year_value = document.options_motorleads.year.value;
    if (year_value !== "") {
        document.options_motorleads.version.disabled = false;
        updateURL();
    } else {
        document.options_motorleads.version.disabled = true;
    }
}

function getVersionID() {
    let version_value = document.options_motorleads.version.value;
    if (version_value !== "") {
        document.options_motorleads.color.disabled = false;
        updateURL();
    }
    else {
        document.options_motorleads.color.disabled = true;
    }
}

function updateURL() {
    let make_value = document.options_motorleads.makes.value;
    let model_value = document.options_motorleads.model.value;
    let year_value = document.options_motorleads.year.value;
    let version_value = document.options_motorleads.version.value;

    let url = "http://localhost/RETO/form.php?make_id=" + make_value;

    if (model_value !== "") {
        url += "&model_id=" + model_value;
    }
    if (year_value !== "") {
        url += "&year_id=" + year_value;
    }
    if (version_value !== "") {
        url += "&version_id=" + version_value;
    }

    window.history.pushState({}, '', url);
    window.location.reload();
}

function saveSelectedValues() {
    localStorage.setItem('make_value', document.options_motorleads.makes.value);
    localStorage.setItem('model_value', document.options_motorleads.model.value);
    localStorage.setItem('year_value', document.options_motorleads.year.value);
    localStorage.setItem('version_value', document.options_motorleads.version.value);
}

function restoreSelectedValues() {
    document.options_motorleads.makes.value = localStorage.getItem('make_value') || "";
    document.options_motorleads.model.value = localStorage.getItem('model_value') || "";
    document.options_motorleads.year.value = localStorage.getItem('year_value') || "";
    document.options_motorleads.version.value = localStorage.getItem('version_value') || "";
    
    if (document.options_motorleads.makes.value !== "") {
        document.options_motorleads.model.disabled = false;
    }
    if (document.options_motorleads.model.value !== "") {
        document.options_motorleads.year.disabled = false;
    }
    if (document.options_motorleads.year.value !== "") {
        document.options_motorleads.version.disabled = false;
    }
    if (document.options_motorleads.version.value !== "") {
        document.options_motorleads.color.disabled = false;
    }
}

window.onload = function() {
    restoreSelectedValues();
};

window.onbeforeunload = function() {
    saveSelectedValues();
};
