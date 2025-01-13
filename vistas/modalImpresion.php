<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Mantenimiento de Equipo de Cómputo</title>
    <link rel="stylesheet" href="../assets/css/impresion.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Reporte de Mantenimiento de Equipo de Cómputo</h1>
        </header>

        <!-- Formulario de Reporte de Mantenimiento -->
        <form id="formReporte">

            <!-- Información General -->
            <div class="section cuadro">
                <h2>1. Información General</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="titulo_reporte">Título del Reporte:</label>
                        <input type="text" id="titulo_reporte" name="titulo_reporte" value="Reporte de Mantenimiento de Computadora">
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora">Fecha y Hora:</label>
                        <input type="datetime-local" id="fecha_hora" name="fecha_hora">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre_tecnico">Nombre del Técnico:</label>
                        <input type="text" id="nombre_tecnico" name="nombre_tecnico">
                    </div>
                    <div class="form-group">
                        <label for="identificacion_equipo">Identificación del Equipo:</label>
                        <input type="text" id="identificacion_equipo" name="identificacion_equipo">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="ubicacion_equipo">Ubicación del Equipo:</label>
                        <input type="text" id="ubicacion_equipo" name="ubicacion_equipo">
                    </div>
                </div>
            </div>

            <!-- Objetivo del Mantenimiento -->
            <div class="section cuadro">
                <h2>2. Objetivo del Mantenimiento</h2>
                <textarea id="objetivo_mantenimiento" name="objetivo_mantenimiento" placeholder="Describa el objetivo del mantenimiento" rows="4"></textarea>
            </div>

            <!-- Descripción del Estado Inicial -->
            <div class="section cuadro">
                <h2>3. Descripción del Estado Inicial</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="condicion_fisica">Condición Física del Equipo:</label>
                        <textarea id="condicion_fisica" name="condicion_fisica" placeholder="Describa la condición física del equipo" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="problemas_reportados">Problemas Reportados:</label>
                        <textarea id="problemas_reportados" name="problemas_reportados" placeholder="Describa los problemas reportados" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="diagnostico_preliminar">Diagnóstico Preliminar:</label>
                        <textarea id="diagnostico_preliminar" name="diagnostico_preliminar" placeholder="Describa el diagnóstico preliminar" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Actividades Realizadas -->
            <div class="section cuadro">
                <h2>4. Actividades Realizadas</h2>
                <textarea id="actividades" name="actividades" rows="5" placeholder="Ingrese las actividades realizadas, separadas por saltos de línea"></textarea>
            </div>

            <!-- Resultados Obtenidos -->
            <div class="section cuadro">
                <h2>5. Resultados Obtenidos</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="estado_final_equipo">Estado Final del Equipo:</label>
                        <textarea id="estado_final_equipo" name="estado_final_equipo" rows="3" placeholder="Describa el estado final del equipo después del mantenimiento"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="problemas_no_resueltos">Problemas No Resueltos:</label>
                        <textarea id="problemas_no_resueltos" name="problemas_no_resueltos" rows="3" placeholder="Describa si existen problemas no resueltos"></textarea>
                    </div>
                </div>
            </div>

            <!-- Recomendaciones -->
            <div class="section cuadro">
                <h2>6. Recomendaciones</h2>
                <textarea id="recomendaciones" name="recomendaciones" rows="5" placeholder="Ingrese las recomendaciones para el equipo, separadas por saltos de línea"></textarea>
            </div>

            <!-- Conclusiones -->
            <div class="section cuadro">
                <h2>7. Conclusiones</h2>
                <textarea id="conclusiones" name="conclusiones" rows="4" placeholder="Describa las conclusiones del mantenimiento realizado"></textarea>
            </div>

            <!-- Firmas -->
            <footer>
                <div class="form-row">
                    <div class="form-group">
                        <label for="firma_tecnico">Firma del Técnico:</label>
                        <input type="text" id="firma_tecnico" name="firma_tecnico">
                    </div>
                    <div class="form-group">
                        <label for="firma_responsable">Firma del Responsable:</label>
                        <input type="text" id="firma_responsable" name="firma_responsable">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fecha_revision">Fecha de Próxima Revisión:</label>
                    <input type="date" id="fecha_revision" name="fecha_revision">
                </div>
            </footer>

            <!-- Botón para Generar Reporte -->
            <div class="form-group">
                <button type="button" id="btnGenerarReporte">Generar Reporte</button>
            </div>
        </form>
    </div>

    <!-- Sección para la vista previa del reporte -->
    <div id="reporteImprimible" style="display: none;">
        <h2>Reporte de Mantenimiento de Equipo de Cómputo</h2>
        <h3>1. Información General</h3>
        <p><strong>Título del Reporte:</strong> <span id="titulo_reporte_view"></span></p>
        <p><strong>Fecha y Hora:</strong> <span id="fecha_hora_view"></span></p>
        <p><strong>Nombre del Técnico:</strong> <span id="nombre_tecnico_view"></span></p>
        <p><strong>Identificación del Equipo:</strong> <span id="identificacion_equipo_view"></span></p>
        <p><strong>Ubicación del Equipo:</strong> <span id="ubicacion_equipo_view"></span></p>

        <h3>2. Objetivo del Mantenimiento</h3>
        <p id="objetivo_mantenimiento_view"></p>

        <h3>3. Descripción del Estado Inicial</h3>
        <p id="condicion_fisica_view"></p>
        <p id="problemas_reportados_view"></p>
        <p id="diagnostico_preliminar_view"></p>

        <h3>4. Actividades Realizadas</h3>
        <p id="actividades_view"></p>

        <h3>5. Resultados Obtenidos</h3>
        <p id="estado_final_equipo_view"></p>
        <p id="problemas_no_resueltos_view"></p>

        <h3>6. Recomendaciones</h3>
        <p id="recomendaciones_view"></p>

        <h3>7. Conclusiones</h3>
        <p id="conclusiones_view"></p>

        <h3>Firmas</h3>
        <p><strong>Técnico:</strong> <span id="firma_tecnico_view"></span></p>
        <p><strong>Responsable:</strong> <span id="firma_responsable_view"></span></p>
        <p><strong>Fecha de Revisión:</strong> <span id="fecha_revision_view"></span></p>
    </div>

    <script>
        document.getElementById('btnGenerarReporte').addEventListener('click', function () {
            // Obtener los valores del formulario
            document.getElementById('titulo_reporte_view').textContent = document.getElementById('titulo_reporte').value;
            document.getElementById('fecha_hora_view').textContent = document.getElementById('fecha_hora').value;
            document.getElementById('nombre_tecnico_view').textContent = document.getElementById('nombre_tecnico').value;
            document.getElementById('identificacion_equipo_view').textContent = document.getElementById('identificacion_equipo').value;
            document.getElementById('ubicacion_equipo_view').textContent = document.getElementById('ubicacion_equipo').value;
            document.getElementById('objetivo_mantenimiento_view').textContent = document.getElementById('objetivo_mantenimiento').value;
            document.getElementById('condicion_fisica_view').textContent = document.getElementById('condicion_fisica').value;
            document.getElementById('problemas_reportados_view').textContent = document.getElementById('problemas_reportados').value;
            document.getElementById('diagnostico_preliminar_view').textContent = document.getElementById('diagnostico_preliminar').value;
            document.getElementById('actividades_view').textContent = document.getElementById('actividades').value;
            document.getElementById('estado_final_equipo_view').textContent = document.getElementById('estado_final_equipo').value;
            document.getElementById('problemas_no_resueltos_view').textContent = document.getElementById('problemas_no_resueltos').value;
            document.getElementById('recomendaciones_view').textContent = document.getElementById('recomendaciones').value;
            document.getElementById('conclusiones_view').textContent = document.getElementById('conclusiones').value;
            document.getElementById('firma_tecnico_view').textContent = document.getElementById('firma_tecnico').value;
            document.getElementById('firma_responsable_view').textContent = document.getElementById('firma_responsable').value;
            document.getElementById('fecha_revision_view').textContent = document.getElementById('fecha_revision').value;

            // Mostrar la vista previa para impresión
            window.print();
        });
    </script>
</body>
</html>
