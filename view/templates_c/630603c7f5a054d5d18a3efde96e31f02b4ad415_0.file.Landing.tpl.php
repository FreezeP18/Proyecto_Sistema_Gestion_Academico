<?php
/* Smarty version 4.3.1, created on 2023-07-29 19:09:26
  from 'C:\xampp\htdocs\jueves\semana15\proyecto_final_3\view\templates\Landing.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_64c547c6448331_51554095',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '630603c7f5a054d5d18a3efde96e31f02b4ad415' => 
    array (
      0 => 'C:\\xampp\\htdocs\\jueves\\semana15\\proyecto_final_3\\view\\templates\\Landing.tpl',
      1 => 1689546487,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64c547c6448331_51554095 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <title>Colegio Cristopher Steller</title>
        <!-- Meta para poder usar tildes y simbolos especiales -->
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <?php echo '<script'; ?>
 src="js/Principal.js"><?php echo '</script'; ?>
>
    </head>

    <body>
        <!--Logo del colegio-->
        <img class="logo" src="img/Captura de pantalla 2023-06-04 165207.png" alt="Logo institucional">

        <!--Menu-->
        <div class="menu">
            <ul>
                <li><a href="#" onclick="mostrarSeccion('localizacion')">Localización</a></li>
                <li><a href="#" onclick="mostrarSeccion('caracteristicas')">Características</a></li>
                <li><a href="#" onclick="mostrarSeccion('instalaciones')">Instalaciones</a></li>
                <li><a href="#" onclick="mostrarSeccion('servicios')">Servicios</a></li>
                <li><a href="#" onclick="mostrarSeccion('informacion')">Información</a></li>
                <li><a href="#" onclick="mostrarSeccion('proyectos')">Proyectos de escuela</a></li>
                <li><a href="#" onclick="mostrarSeccion('registro_padre')">Formulario de Registro Padres</a></li>
                <li><a href="#" onclick="mostrarSeccion('registro_alumno')">Formulario de Registro Alumnos</a></li>
            </ul>
        </div>

        <!--Div de localizacion-->
        <div id="localizacion" class="seccion">
            <!-- Aquí se mostrará la información de Localización -->
            <div class="localizacion">
                <h3>Ubicacion</h3>
                <img src="https://www.google.com/maps/d/thumbnail?mid=1yCOYMdbSQP7J7aZHxlb1kWkpuRI&hl=es" alt="ubicacion"/>
                <p>Nos ubicamos a mano derecha de sala de ventas amarillo, 50 metros al norte</p>
            </div>
        </div>

        <!--Div de Caracteristicas-->
        <div id="caracteristicas" class="seccion oculto">
            <!-- Aquí se mostrará la información de caraacteristicas -->
            <div class="caracteristicas">
                <h3>Características Generales</h3>

                <h4>Código del Centro Educativo</h4>
                <p>1126320</p>
                <h4>CIF</h4>
                <p>Q412020212</p>
                <h4>Dirección</h4>
                <p>Calle 1, 500 metros oeste</p>
                <h4>Teléfono</h4>
                <p>200154500</p>
                <h4>Móvil</h4>
                <p>888102216</p>
                <h4>Email</h4>
                <p>csteller@gmail.com</p>
                <h4>Modalidad de enseñanza</h4>
                <p>PIP (Programa de Incorporación Progresiva)</p>
                <h4>Educación infantil - 2° ciclo</h4> 
                <p>3 unidades</p>
                <h4>Educación Primaria</h4>
                <p>6 unidades</p>
            </div>
        </div>
        <!--Div de instalaciones-->
        <div id="instalaciones" class="seccion oculto">
            <div class="instalaciones">
                <!--Aquí se mostrará la información de caraacteristicas-->
                <h3>Nuestras Instalaciones</h3>
                <img src="img/12615532305_72cd19f960_b.jpg" alt="imagen institucional 1">
                <img src="img/pngtree-school-building-construction-png-image_3929771.jpg" alt="imagen institucional 2">
                <img src="img/campo-de-fútbol-vacío-y-cancha-baloncesto-en-la-escuela-imagen-del-colegio-246638822.png" alt="imagen institucional 3">
                <img src="img/lovepik-a-pupil-who-plays-the-ball-on-the-court-picture_500603608.jpg" alt="imagen institucional 4">
                <img src="img/Etablissements-scolaires-2-960x540-1.jpg" alt="imagen institucional 5">
            </div>

        </div>

        <div id="servicios" class="seccion oculto">
            <!-- Aquí se mostrará la información de servicios -->
            <div class="servicios">
                <h3>Servicios Estudiantiles</h3>
                <p>¡Bienvenido al Colegio Christopher Steller, un lugar donde la excelencia académica y el bienestar 
                    estudiantil son nuestras principales prioridades! Aquí encontrarás una amplia gama de servicios diseñados para brindarte 
                    una experiencia educativa excepcional y satisfacer todas tus necesidades.
                    Nuestro colegio se enorgullece de ofrecer servicios de alta calidad para asegurar tu comodidad y apoyarte en tu 
                    desarrollo integral. Estos son algunos de los servicios que encontrarás en nuestra institución:</p>
                <ol>
                    <li>Comedor escolar: Nuestro comedor escolar te brinda la oportunidad de disfrutar de comidas saludables y equilibradas preparadas por expertos en nutrición.</li>
                    <li>Enfermería y atención médica: Contamos con un equipo de enfermería altamente capacitado que está disponible para brindarte atención médica en caso de enfermedad o lesiones menores.</li>
                    <li>Transporte escolar: Ofrecemos un servicio de transporte escolar confiable y eficiente que te llevará desde y hacia el colegio.</li>
                    <li>Actividades extracurriculares: Te ofrecemos una amplia variedad de actividades extracurriculares para que puedas explorar tus pasiones e intereses.</li>
                    <li>Apoyo académico personalizado: Ofrecemos servicios de tutoría y apoyo académico adicional para ayudarte a alcanzar tus metas educativas.</li>
                </ol>
                <p>En el Colegio Christopher Steller, nos comprometemos a brindarte una experiencia educativa integral y enriquecedora. 
                    Nuestros servicios están diseñados para garantizar tu comodidad, seguridad y desarrollo académico. ¡Te invitamos a unirte a 
                    nuestra comunidad escolar y descubrir todas las oportunidades que te esperan!
                    Para obtener más información sobre nuestros servicios y explorar todo lo que ofrecemos, te invitamos a comunicarte directamente con nosotros. Estamos aquí para responder 
                    a todas tus preguntas y ayudarte en tu viaje educativo. 
                    ¡Esperamos verte pronto en el Colegio Christopher Steller, donde tus sueños toman vuelo!</p>
            </div>

        </div>

        <!--Div de informacion-->
        <div id="informacion" class="seccion oculto">
            <!-- Aquí se mostrará la información de informacion -->
            <div class="informacion">
                <h3>Informacion General</h3>
                <p>En el Colegio Christopher Steller, nos enorgullece ofrecer una evaluación integral y transparente para 
                    medir el progreso y el rendimiento académico de nuestros estudiantes. Además, contamos con una plataforma electrónica 
                    especializada que permite a los estudiantes y padres acceder fácilmente a información relevante sobre notas y asistencia.</p>
                <h4>Evaluación de los estudiantes:</h4>
                <ul>
                    <li>Trabajos y proyectos: Los estudiantes participan en trabajos y proyectos tanto individuales como en grupo, que les permiten aplicar los conocimientos adquiridos y demostrar su comprensión en diferentes áreas temáticas.</li>
                    <li>Participación en clase: Valoramos la participación activa de los estudiantes en las discusiones en clase, su capacidad para expresar ideas y su respeto hacia los demás. La participación en actividades y debates en clase también forma parte de la evaluación.</li>
                    <li>Tareas: Asignamos tareas regulares que los estudiantes deben completar de manera independiente para consolidar los conceptos enseñados y desarrollar habilidades de estudio y autodisciplina.</li>
                    <li>Evaluación continua: Utilizamos métodos de evaluación continua, como preguntas orales, cuestionarios cortos y ejercicios prácticos, para monitorear el progreso de los estudiantes de forma regular.</li>
                </ul>
                <h4>Plataforma electrónica:</h4>
                <p>Además de nuestra sólida metodología de evaluación, contamos con una plataforma electrónica avanzada que brinda acceso a información académica y de asistencia a los estudiantes y sus padres. A través de esta plataforma, los usuarios pueden ver las notas obtenidas en cada materia, revisar el registro de asistencia y acceder a recursos educativos adicionales. Esta herramienta proporciona una comunicación fluida y transparente entre el colegio, los estudiantes y los padres, promoviendo así una mayor participación en el proceso educativo.</p>

                <p>En el Colegio Christopher Steller, nos esforzamos por brindar una evaluación rigurosa y transparente, además de utilizar tecnología de vanguardia para mejorar la comunicación y el acceso a la información. Creemos que esta combinación de servicios contribuye al éxito académico y al crecimiento personal de nuestros estudiantes.</p>

            </div>

        </div>

        <!--Div de proyectos-->
        <div id="proyectos" class="seccion oculto">
            <div class="proyectos">
                <!-- Aquí se mostrará la información de proyectos -->
                <h3>Proyectos Escolares</h3>
                <p><b>Artes Dramático:</b>  El proyecto de artes dramáticas ofrecido por nuestro centro educativo es una iniciativa diseñada 
                    para inspirar y fomentar la creatividad de los estudiantes a través del arte escénico. Nuestro objetivo es proporcionar a los 
                    participantes una experiencia enriquecedora en el mundo del teatro, que promueva el desarrollo personal y artístico.</p>

                <p><b>Danza:</b> Nuestro centro educativo se enorgullece en ofrecer un innovador proyecto de danza que busca fomentar la 
                    expresión artística, el desarrollo físico y emocional, y el trabajo en equipo entre nuestros estudiantes. Creemos firmemente 
                    en el poder de la danza como una forma de comunicación y exploración personal, y queremos brindar a nuestros estudiantes la 
                    oportunidad de descubrir y desarrollar su talento en este arte.</p>

                <p><b>Deportes:</b> El centro educativo Christopher Steller se enorgullece de ofrecer un proyecto deportivo integral y emocionante que
                    busca fomentar la actividad física, el espíritu deportivo y el desarrollo de habilidades atléticas en sus estudiantes. Nuestro proyecto
                    deportivo se basa en la premisa de que el deporte no solo es una forma de ejercicio físico, sino también una herramienta invaluable para
                    promover el trabajo en equipo, la disciplina, el liderazgo y el bienestar emocional. Nuestro centro educativo cuenta con instalaciones deportivas de 
                    primer nivel, que incluyen un gimnasio completamente equipado, canchas al aire libre, una pista de atletismo y piscinas, entre otras. Estas instalaciones 
                    nos permiten ofrecer una amplia gama de disciplinas deportivas para todos los gustos y habilidades.</p>

                <p><b>Informática:</b> El proyecto educativo de Informática del centro educativo Christopher Steller se enfoca en proporcionar a los estudiantes una formación 
                    integral en el campo de la informática y la tecnología. El objetivo principal es preparar a los alumnos para enfrentar los desafíos del mundo digital en constante 
                    evolución y brindarles las habilidades necesarias para tener éxito en el ámbito profesional y personal.</p>



                <p><b>Musica:</b>  El proyecto educativo de Música ofrecido por el centro educativo Christopher Steller es un programa integral diseñado para desarrollar el talento 
                    musical de los estudiantes y brindarles una educación enriquecedora en este campo. El objetivo principal es fomentar el amor por la música, cultivar habilidades musicales 
                    y promover el desarrollo personal y creativo de los estudiantes.</p>


            </div>

        </div>
        
        <!--Div de Registro-->
        <div id="registro_padre" class="seccion oculto">
            <!-- Aquí se mostrará la información de registro -->
            <div class="registro_padre">
                
                <h2>Formulario Padres</h2>
                <!--utilizar metodo post-->
                <form method="post" action="index.php">
                    <input type="hidden" name="accion" value="validar_registroPadre">
                    <?php echo $_smarty_tpl->tpl_vars['msg3']->value;?>
 
                    <!--input de usuario requerido para no saturar el back end-->
                    <div>
                        <b>Nombre</b>
                        <input type="text" id="nombre_padre" name="nombre_padre" required>
                    </div>
                    <div>
                        <b>Apellidos</b>
                        <input type="text" id="apellido_padre" name="apellido_padre" required>
                    </div>
                    <div>
                        <b>Cedula</b>
                        <input type="text" id="cedula_padre" name="cedula_padre" required>
                    </div>
                    <div>
                        <b>Correo</b>
                        <input type="text" id="correo_padre" name="correo_padre" required>
                    </div>
                    <div>
                        <b>Nombre de Usuario</b>
                        <input type="text" id="user_padre" name="user_padre" required>
                    </div>
                    <!-- input de clave requerido para no saturar el backend-->
                    <div>
                        <b>Clave</b>
                        <input type="password" id="pwd_clave_padre" name="pwd_clave_padre" required>
                    </div>
                    <!--Boton para registrarse-->
                    <div>
                        <input type="submit" value="Registrar">
                    </div>
                </form>
            </div>
        </div>


        <!--Div de Registro-->
        <div id="registro_alumno" class="seccion oculto">
            <!-- Aquí se mostrará la información de registro -->
            <div class="registro_alumno">
                
                <h2>Formulario Alumnos</h2>
                <!--utilizar metodo post-->
                <form method="post" action="index.php">
                    <input type="hidden" name="accion" value="validar_registroAlumno">
                    <?php echo $_smarty_tpl->tpl_vars['msg2']->value;?>
 
                    <!--input de usuario requerido para no saturar el back end-->
                    <div>
                        <b>Nombre de usuario</b>
                        <input type="text" id="user_alumno" name="user_alumno" required>
                    </div>
                    <div>
                        <b>Clave</b>
                        <input type="password" id="pwd_clave_alumno" name="pwd_clave_alumno" required>
                    </div>
                    <div>
                        <b>Nombre</b>
                        <input type="text" id="nombre_alumno" name="nombre_alumno" required>
                    </div>
                    <div>
                        <b>Apellidos</b>
                        <input type="text" id="apellidos_alumno" name="apellidos_alumno" required>
                    </div>
                    <div>
                        <b>Cedula</b>
                        <input type="text" id="cedula_alumno" name="cedula_alumno" required>
                    </div>
                    <!--Boton para registrarse-->
                    <div>
                        <input type="submit" value="Registrar">
                    </div>
                </form>
            </div>
        </div>

        <!--Div del form de log in-->
        <div class="ingresar">
            
            <h2>Ingresar</h2>
            <!--utilizar metodo post-->
            <form method="post" action="index.php">
                <input type="hidden" name="accion" value="validar_login">
                    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
 
                <div>
                    <!--Tipo de usuario a elegir-->
                    <b>Tipo</b>
                    <select id="s_tipo" name="s_tipo">
                        <option value="alumno">Alumno</option>
                        <option value="padre">Padre</option>
                        <option value="profesor">Profesor</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>
                <!--input de usuario requerido para no saturar el back end-->
                <div>
                    <b>Usuario</b>
                    <input type="text" id="txt_usuario" name="txt_usuario" required>
                </div>
                <!-- input de clave requerido para no saturar el backend-->
                <div>
                    <b>Clave</b>
                    <input type="password" id="pwd_clave" name="pwd_clave" required>
                </div>
                <!--Boton para loguearse-->
                <div>
                    <input type="submit" value="Ingresar">
                </div>
            </form>
        </div>
        
        
    </body>
</html>

<?php }
}
