import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',      // 通常ユーザ用CSS
        'resources/js/app.js',        // 通常ユーザ用JS
      ],
      refresh: true,
    }),
  ],
  server: {
    host: true,
    hmr: {
      host: 'localhost',
    },
  },
});

