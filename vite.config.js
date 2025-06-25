import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import path from 'path';


export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.jsx',
            refresh: true,
        }),
        react(),
    ],
    server: {
        host:'0.0.0.0',
        port: 5173,
        strictPort:true,
        cors:true,
        hmr:{
            host:'localhost'
        },
    },
    resolve: {
  alias: {
    "react-router-dom": path.resolve(__dirname, "node_modules/react-router-dom")
  },
}

});
