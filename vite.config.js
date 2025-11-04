import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss()],
  publicDir: false, // Disable Vite's public directory feature
  build: {
    outDir: "public/assets",
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: "resources/js/main.js",
        style: "resources/css/app.css"
      },
      output: {
        entryFileNames: "js/main.js",
        chunkFileNames: "js/[name].js", 
        assetFileNames: "css/main.css"
      }
    }
  }
});