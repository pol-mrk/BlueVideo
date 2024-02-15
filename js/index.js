// const urls = [
//     'https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=3105be1aedb18e8d02e7ad7a1b180bef',
//     'https://api.themoviedb.org/3/discover/movie?certification_country=US&certification.lte=G&sort_by=popularity.desc&api_key=3105be1aedb18e8d02e7ad7a1b180bef',
//     'https://api.themoviedb.org/3/discover/movie?with_genres=18&primary_release_year=2014&api_key=3105be1aedb18e8d02e7ad7a1b180bef'
// ];
// const peliculasBD = JSON.parse(document.currentScript.getAttribute('pdopeliculas'));
// window.addEventListener('DOMContentLoaded',()=>{
//     // Catalogo uno (Películas Populares)
//     const populares = document.getElementById('populares');
//     peliculasBD.forEach(pelicula => {
//         const article = document.createElement('article');
//         article.classList.add('pelicula');

//         const img = document.createElement('img');
//         img.src = './img/'+pelicula.Portada; // Ajusta la propiedad según la estructura de tu array

//         article.append(img);
//         populares.append(article);
//     });

//     // Catalogo dos (Películas de Estreno)
//     const estrenos = document.getElementById('estreno');
//     peliculasBD.forEach(pelicula => {
//         const article = document.createElement('article');
//         article.classList.add('pelicula');

//         const img = document.createElement('img');
//         img.src = './img/'+pelicula.Portada; // Ajusta la propiedad según la estructura de tu array

//         article.append(img);
//         estrenos.append(article);
//     });

//     // Catalogo tres (Películas más vistas)
//     const vistas = document.getElementById('vistas');
//     peliculasBD.forEach(pelicula => {
//         const article = document.createElement('article');
//         article.classList.add('pelicula');

//         const img = document.createElement('img');
//         img.src = './img/'+pelicula.Portada; // Ajusta la propiedad según la estructura de tu array

//         article.append(img);
//         vistas.append(article);
//     });
// });