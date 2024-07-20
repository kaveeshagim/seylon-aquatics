module.exports = {
    apps: [
      {
        name: "laravel-vite",
        script: "npm",
        args: "run dev",
        watch: false,
        env: {
          NODE_ENV: "development"
        }
      }
    ]
  };
  