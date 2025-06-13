const moviesPerPage = 20;
let currentPage = 1;

function renderMovies() {
  const container = document.getElementById("movie-list");
  container.innerHTML = "";

  const start = (currentPage - 1) * moviesPerPage;
  const currentMovies = movies.slice(start, start + moviesPerPage);

  currentMovies.forEach(movie => {
    const stars = "★".repeat(Math.round(movie.averageRating)) + "☆".repeat(5 - Math.round(movie.averageRating));

    const movieCard = document.createElement("div");
    movieCard.className = "bg-white rounded shadow hover:shadow-lg transition p-4";

    movieCard.innerHTML = `
      <h2 class="text-lg font-bold mb-2">${movie.title}</h2>
      <img src="${movie.image}" alt="${movie.title}" class="w-full h-auto mb-2 rounded">
      <p class="text-yellow-500">${stars} <span class="text-sm text-gray-600">(${movie.averageRating})</span></p>
    `;

    container.appendChild(movieCard);
  });
}

function renderPagination() {
  const totalPages = Math.ceil(movies.length / moviesPerPage);
  const pagination = document.getElementById("pagination");
  pagination.innerHTML = "";

  for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement("button");
    btn.textContent = i;
    btn.className = `px-3 py-1 rounded ${i === currentPage ? "bg-blue-500 text-white" : "bg-white border"}`;
    btn.onclick = () => {
      currentPage = i;
      renderMovies();
      renderPagination();
    };
    pagination.appendChild(btn);
  }
}

renderMovies();
renderPagination();
