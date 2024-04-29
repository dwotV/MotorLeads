<!DOCTYPE html>
<html>
    <head>
        <title>MotorLeads</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="formStyles.css">
        <script src="formPrueba2.js" type="text/JavaScript"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet"/>
    </head>

    <body>
    <form name="datos">
        <table class="navbar" width="100%">
            <tr>
                <td>
                    <table class="logo">
                        <tr>
                            <td>
                                <h2>MotorLeads</h2>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="user">
                        <tr>
                            <td>
                                <img src="https://localhost/RETO/imagenes/user.png" class="userimg">
                            </td>
                            <td>
                                <p>Daniel</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="form" width="70%">
            <tr>
                <td>
                    <table class="selectores">
                        <tr>
                            <td width="300" height="100">
                                <p>Selecciona una Marca</p>
                                <select name="marcas">
                                    <option value=""></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="300" height="100">
                                <p>Selecciona un Modelo</p>
                                <select name="modelos" disabled>
                                    <option value=""></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="300" height="100">
                                <p>Selecciona un Año</p>
                                <select name="anios" disabled>
                                    <option value=""></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="300" height="100">
                                <p>Selecciona una Versión</p>
                                <select name="version" disabled>
                                    <option value=""></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="300" height="100">
                                <p>Selecciona un Kilometraje</p>
                                <input type="text" name="kilometraje">
                            </td>
                        </tr>
                        <tr>
                            <td width="300" height="100">
                                <p>Selecciona un Color</p>
                                <select>
                                    <option value=""></option>
                                    <option value="negro">Negro</option>
                                    <option value="plateado">Plateado</option>
                                    <option value="blanco">Blanco</option>
                                    <option value="rojo">Rojo</option>
                                    <option value="azul">Azul</option>
                                    <option value="amarillo">Amarillo</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Buscar">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
    </body>
</html>