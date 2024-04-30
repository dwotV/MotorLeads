// Obtener y mostrar las marcas
fetch('connect.php?url=https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/makes')
    .then(response => response.json())
    .then(data => {
        const marcas = document.datos.querySelector('select[name="marcas"]');
        
        // Crear opciones basadas en los datos obtenidos
        data.forEach(function(item) {
            const option = document.createElement('option');

            option.value = item.id;
            option.textContent = item.name;
            marcas.appendChild(option);
        });

        // Cuando se selecciona una marca, obtener y mostrar los modelos correspondientes
        marcas.addEventListener('change', function() {
            document.querySelector('select[name="modelos"]').removeAttribute('disabled');

            var marcaId = this.value;
            
            if (marcaId) {
                var modelosURL = 'connect.php?url=https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/makes/' + marcaId + '/models';

                fetch(modelosURL)
                    .then(response => response.json())
                    .then(modelosData => {
                        const selectModelos = document.querySelector('select[name="modelos"]');
                        
                        // Limpiar opciones anteriores del select de modelos
                        selectModelos.innerHTML = '';

                        modelosData.unshift("Seleccionar");

                        // Crear opciones basadas en los modelos obtenidos
                        modelosData.forEach(function(modelo) {
                            const option = document.createElement('option');
                            option.value = modelo.id;
                            option.textContent = modelo.name;
                            selectModelos.appendChild(option);
                        });

                        selectModelos.addEventListener('change', function() {
                            document.querySelector('select[name="anios"]').removeAttribute('disabled');

                            var modelID = this.value;

                            if (selectModelos) {
                                var aniosURL = 'connect.php?url=https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/models/' + modelID + '/years';
                                fetch(aniosURL)
                                    .then(response => response.json())
                                    .then(aniosData => {
                                        const selectAnios = document.querySelector('select[name="anios"]');

                                        // Limpiar opciones anteriores del select de modelos
                                        selectAnios.innerHTML = '';

                                        aniosData.unshift("Seleccionar");

                                        // Crear opciones basadas en los modelos obtenidos
                                        aniosData.forEach(function(anio) {
                                            const option = document.createElement('option');
                                            option.value = anio.id;
                                            option.textContent = anio.name;
                                            selectAnios.appendChild(option);
                                        });

                                        selectAnios.addEventListener('change', function() {
                                            document.querySelector('select[name="version"]').removeAttribute('disabled');

                                            var anioID = this.value;

                                            if (selectAnios) {
                                                var versionesURL = 'connect.php?url=https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/models/' + modelID + '/years/' + anioID + '/vehicles';
                                                fetch(versionesURL)
                                                    .then(response => response.json())
                                                    .then(versionesData => {
                                                        const selectVersiones = document.querySelector('select[name="version"]');

                                                        // Limpiar opciones anteriores del select de modelos
                                                        selectVersiones.innerHTML = '';

                                                        versionesData.unshift("Seleccionar");

                                                        // Crear opciones basadas en los modelos obtenidos
                                                        versionesData.forEach(function(version) {
                                                            const option = document.createElement('option');
                                                            option.value = version.id;
                                                            option.textContent = version.version;
                                                            selectVersiones.appendChild(option);
                                                        });
                                                        
                                                        selectVersiones.addEventListener('change', function() {
                                                            document.querySelector('input[name="kilometraje"]').removeAttribute('disabled');
                
                                                            var versionID = this.value;

                                                            if (selectVersiones) {
                                                                const inputKilometro = document.querySelector('input[name="kilometraje"]');

                                                                inputKilometro.addEventListener('change', function() {
                                                                    document.querySelector('select[name="color"]').removeAttribute('disabled');
                        
                                                                    var kilometraje = this.value;

                                                                    if (inputKilometro) {
                                                                        const selectColor = document.querySelector('select[name="color"]');
                                                                        selectColor.addEventListener('change', function() {
                                                                        var color = this.value;
                                                                            
                                                                            if (selectColor) {
                                                                                form = document.getElementById("datos");
                                                                                form.action = "http://localhost/MotorLeads-main/grafica.php?version=" + versionID + "&km=" + kilometraje + "&color=" + color;
                                                                            }
                                                                        });
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    })
                                                    .catch(error => console.error('Error al obtener las versiones de la API:', error));
                                            }
                                        });

                                    })
                                    .catch(error => console.error('Error al obtener los años de la API:', error));
                            }
                        });
                    })
                    .catch(error => console.error('Error al obtener los modelos de la API:', error));
            }
        });
    })
    .catch(error => console.error('Error al obtener las marcas de la API:', error));

function validateForm() {
    const marca = document.datos.marcas.value;
    const modelo = document.datos.modelos.value;
    const anio = document.datos.anios.value;
    const version = document.datos.version.value;
    const kilometraje = document.datos.kilometraje.value;
    const color = document.datos.color.value;

    if (marca == "" || modelo == "" || anio == "" || version == "" || kilometraje == "" || color == "" || version == undefined) {
        alert("Por favor, complete todos los campos.");
        return false;
    }
    return true;
}

function campos_normales(){
    document.datos.marcas.style.background="white";
}