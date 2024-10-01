import withMT from "@material-tailwind/html/utils/withMT";
 
module.exports = withMT({
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
    extend: {},
  },
  plugins: [],
});