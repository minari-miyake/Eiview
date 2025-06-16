// movies.js
const movies = Array.from({ length: 50 }, (_, i) => ({
  id: i + 1,
  title: `映画タイトル ${i + 1}`,
  image: `https://via.placeholder.com/200x300?text=Movie+${i + 1}`,
  averageRating: (Math.random() * 5).toFixed(1),
}));
