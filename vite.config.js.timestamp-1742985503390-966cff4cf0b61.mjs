// vite.config.js
import { defineConfig } from "file:///C:/Users/migue/Desktop/ppp/Cesar_Miguel/node_modules/vite/dist/node/index.js";
import laravel, { refreshPaths } from "file:///C:/Users/migue/Desktop/ppp/Cesar_Miguel/node_modules/laravel-vite-plugin/dist/index.js";
import vue from "file:///C:/Users/migue/Desktop/ppp/Cesar_Miguel/node_modules/@vitejs/plugin-vue/dist/index.mjs";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: ["resources/js/app.js"],
      refresh: [
        ...refreshPaths,
        "resources/views/**",
        "routes/**",
        "resources/markdown/**"
      ]
    }),
    vue({
      template: {
        transformAssetUrls: {
          // The Vue plugin will re-write asset URLs, when referenced
          // in Single File Components, to point to the Laravel web
          // server. Setting this to `null` allows the Laravel plugin
          // to instead re-write asset URLs to point to the Vite
          // server instead.
          base: null,
          // The Vue plugin will parse absolute URLs and treat them
          // as absolute paths to files on disk. Setting this to
          // `false` will leave absolute URLs un-touched so they can
          // reference assets in the public directly as expected.
          includeAbsolute: false
        }
      }
    })
  ]
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxtaWd1ZVxcXFxEZXNrdG9wXFxcXHBwcFxcXFxDZXNhcl9NaWd1ZWxcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIkM6XFxcXFVzZXJzXFxcXG1pZ3VlXFxcXERlc2t0b3BcXFxccHBwXFxcXENlc2FyX01pZ3VlbFxcXFx2aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vQzovVXNlcnMvbWlndWUvRGVza3RvcC9wcHAvQ2VzYXJfTWlndWVsL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSBcInZpdGVcIjtcbmltcG9ydCBsYXJhdmVsLCB7IHJlZnJlc2hQYXRocyB9IGZyb20gXCJsYXJhdmVsLXZpdGUtcGx1Z2luXCI7XG5pbXBvcnQgdnVlIGZyb20gXCJAdml0ZWpzL3BsdWdpbi12dWVcIjtcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgcGx1Z2luczogW1xuICAgIGxhcmF2ZWwoe1xuICAgICAgaW5wdXQ6IFtcInJlc291cmNlcy9qcy9hcHAuanNcIl0sXG4gICAgICByZWZyZXNoOiBbXG4gICAgICAgIC4uLnJlZnJlc2hQYXRocyxcbiAgICAgICAgXCJyZXNvdXJjZXMvdmlld3MvKipcIixcbiAgICAgICAgXCJyb3V0ZXMvKipcIixcbiAgICAgICAgXCJyZXNvdXJjZXMvbWFya2Rvd24vKipcIixcbiAgICAgIF0sXG4gICAgfSksXG4gICAgdnVlKHtcbiAgICAgIHRlbXBsYXRlOiB7XG4gICAgICAgIHRyYW5zZm9ybUFzc2V0VXJsczoge1xuICAgICAgICAgIC8vIFRoZSBWdWUgcGx1Z2luIHdpbGwgcmUtd3JpdGUgYXNzZXQgVVJMcywgd2hlbiByZWZlcmVuY2VkXG4gICAgICAgICAgLy8gaW4gU2luZ2xlIEZpbGUgQ29tcG9uZW50cywgdG8gcG9pbnQgdG8gdGhlIExhcmF2ZWwgd2ViXG4gICAgICAgICAgLy8gc2VydmVyLiBTZXR0aW5nIHRoaXMgdG8gYG51bGxgIGFsbG93cyB0aGUgTGFyYXZlbCBwbHVnaW5cbiAgICAgICAgICAvLyB0byBpbnN0ZWFkIHJlLXdyaXRlIGFzc2V0IFVSTHMgdG8gcG9pbnQgdG8gdGhlIFZpdGVcbiAgICAgICAgICAvLyBzZXJ2ZXIgaW5zdGVhZC5cbiAgICAgICAgICBiYXNlOiBudWxsLFxuXG4gICAgICAgICAgLy8gVGhlIFZ1ZSBwbHVnaW4gd2lsbCBwYXJzZSBhYnNvbHV0ZSBVUkxzIGFuZCB0cmVhdCB0aGVtXG4gICAgICAgICAgLy8gYXMgYWJzb2x1dGUgcGF0aHMgdG8gZmlsZXMgb24gZGlzay4gU2V0dGluZyB0aGlzIHRvXG4gICAgICAgICAgLy8gYGZhbHNlYCB3aWxsIGxlYXZlIGFic29sdXRlIFVSTHMgdW4tdG91Y2hlZCBzbyB0aGV5IGNhblxuICAgICAgICAgIC8vIHJlZmVyZW5jZSBhc3NldHMgaW4gdGhlIHB1YmxpYyBkaXJlY3RseSBhcyBleHBlY3RlZC5cbiAgICAgICAgICBpbmNsdWRlQWJzb2x1dGU6IGZhbHNlLFxuICAgICAgICB9LFxuICAgICAgfSxcbiAgICB9KSxcbiAgXSxcbn0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUFtVCxTQUFTLG9CQUFvQjtBQUNoVixPQUFPLFdBQVcsb0JBQW9CO0FBQ3RDLE9BQU8sU0FBUztBQUVoQixJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUMxQixTQUFTO0FBQUEsSUFDUCxRQUFRO0FBQUEsTUFDTixPQUFPLENBQUMscUJBQXFCO0FBQUEsTUFDN0IsU0FBUztBQUFBLFFBQ1AsR0FBRztBQUFBLFFBQ0g7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLE1BQ0Y7QUFBQSxJQUNGLENBQUM7QUFBQSxJQUNELElBQUk7QUFBQSxNQUNGLFVBQVU7QUFBQSxRQUNSLG9CQUFvQjtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxVQU1sQixNQUFNO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxVQU1OLGlCQUFpQjtBQUFBLFFBQ25CO0FBQUEsTUFDRjtBQUFBLElBQ0YsQ0FBQztBQUFBLEVBQ0g7QUFDRixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
