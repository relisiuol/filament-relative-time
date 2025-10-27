import { build } from 'esbuild';

const banner = `/*! filament-relative-time | MIT | build: ${new Date().toISOString()} */`;

await build({
  entryPoints: ['resources/js/index.js'],
  bundle: true,
  minify: true,
  sourcemap: false,
  outfile: 'dist/relative-time.bundle.js',
  format: 'iife',
  target: ['es2020'],
  banner: { js: banner },
  logLevel: 'info',
});