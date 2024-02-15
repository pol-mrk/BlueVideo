<?php
try {
    session_start();
    if ($_SESSION["id_usuarios"]) {
        include_once("./conexion/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueVideo - Inicio</title>
    <!-- <link rel="stylesheet" href="normalize.css"> -->
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="./img/logo_bluevideo (1).png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <aside class="background--banner">
        <?php
            $sql = "SELECT peliculas.id_pelicula AS IdPelicula, peliculas.nombre AS Pelicula, peliculas.descripcion AS Descripcion, peliculas.ano AS Ano,
            genero.nombre AS Genero, peliculas.portada AS Portada, peliculas.trailer AS Trailer, peliculas.pelicula AS Video,
            peliculas.logo AS Logo, directores.nombre_director AS Director, GROUP_CONCAT(actores.nombre_actor SEPARATOR ', ') AS Actor
            FROM peliculas JOIN director_pelicula ON director_pelicula.id_pelicula = peliculas.id_pelicula JOIN directores ON
            directores.id_director = director_pelicula.id_director JOIN actor_pelicula
            ON actor_pelicula.id_pelicula = peliculas.id_pelicula JOIN actores ON actores.id_actor = actor_pelicula.id_actor
            JOIN genero ON genero.id_genero = peliculas.genero GROUP BY peliculas.id_pelicula, peliculas.nombre,
            peliculas.descripcion, peliculas.ano, genero.nombre, peliculas.portada, peliculas.trailer, peliculas.pelicula,
            directores.nombre_director;";
            $stmt1 = $conn->prepare($sql);
            $stmt1->execute();
            $peliculas = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <video id="backgroundVideo" muted autoplay loop poster="./video/sueños de fuga trailer.mp4">
            <source src="./video/sueños de fuga trailer.mp4" type="video/mp4">
            <img id="backgroundImage" src="./img/sueno_de_fuga.jpg" alt="Imagen de fondo">
        </video>
        <div class="banner">
            <div class="menu">
                <nav>
                    <ul class="navegacion navegacion--izquierda">
                        <li class="logo"><a href="#"><img src="./img/texto_bluevideo (1).png" alt="BlueVideo" style="height: 35px; width: 250px;"></a></li>
                        <br>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Peliculas</a></li>
                    </ul>
                </nav>
                <nav>
                    <ul class="navegacion navegacion--derecha">
                        <li><a href="#"><img src="Multimedia/lupa.svg" alt="Lupa"></a></li>
                        <li class="usuario"><a href="#"><img src="Multimedia/user.png" alt="Usuario"></a></li>
                    </ul>
                </nav>
            </div>
            <div class="imagotipo">
                <div class="imagotipo--imagen" style="width: 60%;">
                    <img id="logoImage" src="./img/logo_sueno_de_fuga.jpg" alt="Logo película" style="width:50%;">
                </div>
                <div class="detalles">
                    <p id="detallesText">Dos hombres encarcelados entablan una amistad a lo largo de los años, encontrando consuelo y redención eventual a través de actos de decencia común.</p>
                    <br>
                    <div class="masdetalles">
                       <p id="generoText">Drama</p>
                       <i class="bi bi-dot"></i>
                       <p id="directorText">Frank Darabont</p>
                       <i class="bi bi-dot"></i>
                       <p id="actoresText">Tim Robbins, Morgan Freeman, Matt Damon</p>
                    </div>
                </div>
                <div class="imagotipo--info">
                    <p>⏵Play</p>
                    <br>
                    <!-- Like -->
                    <div class="like-container" pelicula-id="<?php if (isset($pelicula['IdPelicula'])) { echo $pelicula['IdPelicula']; } else {} ?>" usuario-id="<?php echo $_SESSION["id_usuarios"]; ?>" accion="like">
                        <a href="#" class="like-button" onmouseover="mostrarLikeBlanco(this)" onmouseout="ocultarLikeBlanco(this)" onclick="darLike('like')">
                            <img src="./img/like.jpg" alt="">
                        </a>
                        <a href="#" class="like-blanco-button" style="display: none;">
                            <img src="./img/like_blanco.jpg" alt="">
                        </a>
                    </div>
                    
                    <!-- Dislike -->
                    <div class="dislike-container" pelicula-id="<?php if (isset($pelicula['IdPelicula'])) { echo $pelicula['IdPelicula']; } else {} ?>" usuario-id="<?php echo $_SESSION["id_usuarios"]; ?>" accion="dislike">
                        <a href="#" class="dislike-button" onmouseover="mostrarDislikeBlanco(this)" onmouseout="ocultarDislikeBlanco(this)" onclick="darDislike('dislike')">
                            <img src="./img/dislike.jpg" alt="">
                        </a>
                        <a href="#" class="dislike-blanco-button" style="display: none;">
                            <img src="./img/dislike_blanco.png" alt="">
                        </a>
                    </div>
                    <?php
                    
                    ?>
                </div>
            </div>
        </div>
    </aside>
    <main class="catalogos">
        <section class="catalogo--peliculas">
            <h1>Películas Populares</h1>
            <div class="peliculas" id="populares">
                <?php
                    foreach ($peliculas as $pelicula) {
                ?>
                <article class="pelicula">
                    <a href="#" onclick="cambiarVideo('<?php echo $pelicula['Trailer']; ?>', '<?php echo $pelicula['Portada']; ?>', '<?php echo $pelicula['Logo']; ?>', '<?php echo $pelicula['Descripcion']; ?>', '<?php echo $pelicula['Genero']; ?>', '<?php echo $pelicula['Director']; ?>', '<?php echo $pelicula['Actor']; ?>', '<?php echo $pelicula['IdPelicula'] ?>')">
                        <img src="./img/<?php echo $pelicula['Portada']; ?>" alt="">
                    </a>
                </article>
                <?php
                    }
                    $id_pelicula = $pelicula['IdPelicula'];
                    $id_usuarios = $_SESSION["id_usuarios"];
                    $sqlLike = "INSERT INTO likes('usuario', 'like/dislike', 'id_pelicula') VALUES (:id_usuarios, 1, :id_pelicula)";
                    $stmtLike = $conn->prepare($sqlLike);
                    $stmtLike->bindParam(':id_usuarios',$id_usuarios);
                    $stmtLike->bindParam(':id_pelicula',$id_pelicula);
                ?>
            </div>
        </section>
    
        <section class="catalogo--peliculas">
            <h2>Películas de Estreno</h2>
            <div class="peliculas" id="estreno">
                
            </div>
        </section>
        <section class="catalogo--peliculas">
            <h2>Películas más vistas</h2>
            <div class="peliculas" id="vistas">
                
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="footer--contenedor">
            <ul class="iconos">
                <li><a href="#"><img src="Multimedia/facebook.svg" alt="facebook"></a></li>
                <li><a href="#"><img src="Multimedia/instagram.svg" alt="instagram"></a></li>
                <li><a href="#"><img src="Multimedia/github.svg" alt="github"></a></li>
                <li><a href="#"><img src="Multimedia/linkedin.svg" alt="linkedin"></a></li>
            </ul>
            <div class="informacion">
                <p>Preguntas frecuentes</p>
                <p>Prensa</p>
                <p>Formas de ver</p>
                <p>Preferencias de cookies</p>
                <p>Pruebas de velocidad</p>
                <p>Centro de ayuda</p>
                <p>Relaciones con inversionistas</p>
                <p>Terminos de uso</p>
                <p>Informacion corporativa</p>
                <p>Cuenta</p>
                <p>Empleo</p>
                <p>Privacidad</p>
                <p>Contactanos</p>
                <p>Solo en netflix</p>
            </div>
            <p class="idioma">🌎︎ Español</p>
            <p class="contruccion">@capidev 2023</p>
        </div>
    </footer>
    <script>
        // Funcion para pasar los datos de la pelicula seleccionada
        function cambiarVideo(videoSrc, posterSrc, logoSrc, detallesSrc, generoSrc, directorSrc, actoresSrc, idPelicula) {
            // Pasamos el video (trailer)
            var video = document.getElementById('backgroundVideo');
            // Pasamos la imagen de fondo
            var backgroundImg = document.getElementById('backgroundImage');
            // Pasamos el logo
            var logoImg = document.getElementById('logoImage');
            // Pasamos la descripción
            var detallesText = document.getElementById('detallesText');
            // Pasamos el genero
            var generoText = document.getElementById('generoText');
            // Pasamos el director
            var directorText = document.getElementById('directorText');
            // Pasamos los actores (concatenados)
            var actoresText = document.getElementById('actoresText');
            // Pasamos la ruta de la película seleccionada
            video.src = './video/'+videoSrc;
            // Pasamos la ruta de la portada de la película seleccionada
            video.poster = './img/'+posterSrc;
            // Recargamos el video (se aplican los cambios)
            video.load();
            // Reproducimos el nuevo vídeo
            video.play();
            // Pasamos la ruta de la portada de la película seleccionada
            backgroundImg.src = './img/'+posterSrc;
            // Pasamos la ruta del logo de la película seleccionada
            logoImg.src = './img/'+logoSrc;
            // Pasamos todos los detalles de la película seleccionada
            detallesText.textContent = detallesSrc;
            generoText.textContent = generoSrc;
            directorText.textContent = directorSrc;
            actoresText.textContent = actoresSrc;

            // Pasamos la id de la película al botón de Like
            var likeContainer = document.querySelector(".like-container");
            likeContainer.setAttribute("pelicula-id", idPelicula);

            // Pasamos la id de la película al botón de Like
            var dislikeContainer = document.querySelector(".dislike-container");
            dislikeContainer.setAttribute("pelicula-id", idPelicula);
        }
        function darLike(accion) {
            var likeContainer = document.querySelector(".like-container");
            var peliculaId = likeContainer.getAttribute("pelicula-id");
            var usuarioId = likeContainer.getAttribute("usuario-id");

            var url = "./DarLike.php?peliculaId=" + peliculaId + "&usuarioId=" + usuarioId + "&accion=" + accion;
            // Redirecciona a la URL
            window.location.href = url;

            mostrarLikeBlanco(likeContainer);
        }

        function darDislike(accion) {
            var dislikeContainer = document.querySelector(".dislike-container");
            var peliculaId = dislikeContainer.getAttribute("pelicula-id");
            var usuarioId = dislikeContainer.getAttribute("usuario-id");

            var url = "./DarLike.php?peliculaId=" + peliculaId + "&usuarioId=" + usuarioId + "&accion=" + accion;

            // Redirecciona a la URL
            window.location.href = url;
                    
            mostrarDislikeBlanco(dislikeContainer);
        }

        function mostrarLikeBlanco(element) {
            // Seleccionamos el contenedor del like
            var likeContainer = element.parentElement; 
            var likeBlancoButton = likeContainer.querySelector(".like-blanco-button");
            // Mostramos el like en blanco
            likeBlancoButton.style.display = "inline-block";
        }

        function ocultarLikeBlanco(element) {
            // Seleccionamos el contenedor del like
            var likeContainer = element.parentElement;
            var likeBlancoButton = likeContainer.querySelector(".like-blanco-button");
            // Ocultamos el like en blanco
            likeBlancoButton.style.display = "none"; 
        }

        function mostrarDislikeBlanco(element) {
            // Seleccionamos el contenedor del dislike
            var dislikeContainer = element.parentElement;
            var dislikeBlancoButton = dislikeContainer.querySelector(".dislike-blanco-button");
            // Mostramos el dislike en blanco
            dislikeBlancoButton.style.display = "inline-block";
        }

        function ocultarDislikeBlanco(element) {
            // Seleccionamos el contenedor del dislike
            var dislikeContainer = element.parentElement;
            var dislikeBlancoButton = dislikeContainer.querySelector(".dislike-blanco-button");
            // Ocultamos el dislike en blanco
            dislikeBlancoButton.style.display = "none";
        }

    </script>
</body>
</html>
<?php
    }else {
        header("Location: ./login/login.php");
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>