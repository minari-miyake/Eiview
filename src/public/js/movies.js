const movies = Array.from({ length: 50 }, (_, i) => {
  if (i === 0) {
    return {
      id: 1,
      title: "劇場版『名探偵コナン 隻眼の残像』",
      image: "https://earthcinemas.co.jp/wp-content/uploads/c70ab39c3ef0c66f.jpg", // ← ローカル画像
      averageRating: 4.8,
    };
  }

  return {
    id: i + 1,
    title: `映画タイトル ${i + 1}`,
    image: `https://via.placeholder.com/300x450?text=Movie+${i + 1}`,
    averageRating: parseFloat((Math.random() * 5).toFixed(1)),
  };
});


