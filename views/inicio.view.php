
<php session_start(); ?>

<link rel="stylesheet" href="path/to/adminlte.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  .content-wrapper {
    background-image: url('images/ocupacional.jpg'); /* Ruta de la imagen de fondo */
    background-size: cover; /* Ajusta el tamaño de la imagen para cubrir completamente el contenedor */
    background-position: center; /* Centra la imagen en el contenedor */
    background-repeat: no-repeat; /* Evita que la imagen se repita */
    height: 100vh; /* Establece una altura mínima para el contenedor */
    color: white; /* Cambia el color del texto a blanco para mejor contraste */

    display: flex;
    justify-content: center; /* Centra el contenido horizontalmente */
    align-items: center; /* Centra el contenido verticalmente */
}



/*
.page-title {
    font-size: 3rem; 
    font-weight: 700;
    letter-spacing: 2px; 
    animation: fadeIn 1s ease-out; 
    color: #00b3ba;
    padding: 20px; 
    margin-bottom: 30px; 
    text-align: center; 
}
*/

.page-title {
    font-size: 3.5rem; /* Aumento del tamaño para un mayor impacto */
    font-weight: 700; /* Negrita para mayor impacto */
    letter-spacing: 2px; /* Espaciado entre letras para darle un toque más estilizado */
    animation: fadeIn 1s ease-out; /* Animación suave para el título */
    color: #007b7f; /* Color azul para reflejar profesionalismo y salud */
    padding: 10px; /* Espaciado alrededor del título */
    text-align: center; /* Centrado del texto */
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Sombra suave para que resalte más */
    margin-bottom: 30px; /* Separación con el contenido que sigue */
  }


.card-custom {
    background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con 80% de opacidad (transparente) */
    color: #333; /* Texto en color oscuro para mayor contraste y legibilidad */
    padding: 30px; /* Espaciado interno */
    border-radius: 15px; /* Bordes redondeados para un look más suave */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); /* Sombra suave para agregar profundidad */
    max-width: 600px; /* Ancho máximo de la tarjeta */
    width: 100%; /* Asegura que la tarjeta ocupe el ancho disponible */
    margin: 0 auto; /* Centrado horizontal */
    text-align: center; /* Centrado de los textos dentro de la tarjeta */
  }


</style>


<body>
    <!-- Contenedor principal 
    <div class="content-wrapper">
        <div class="container">
            <div class="card card-custom">
                <h1 class="page-title">Bienvenidos a <strong>GDS OCUPACIONAL</strong></h1>
            </div>
        </div>
    </div>
-->
    <div class="content-wrapper">
        <!-- Contenido de la página -->
        <div class="container">
            <!-- Card personalizada con fondo blanco y borde redondeado -->
            <div class="card card-custom">
                <h1 class="page-title">BIENVENIDOS A <strong>GDS OCUPACIONAL</strong></h1>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <footer class="main-footer">
        <strong>&copy; 2024 <a href="https://www.facebook.com/MadiSolutions" target="_blank" rel="noopener noreferrer">MadiSolutions</a>.</strong>
        Todos los derechos Reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versión</b> 1.0
        </div>
    </footer>

</body>