import fs from 'fs';
import path from 'path';
import { sync as globSync } from 'glob';


/**
 * Vite plugin to copy files and add them to manifest.json
 * @param {Object} options - Options for the plugin.
 * @param {string|string[]} options.assetsPath - Required path(s) to the assets folder(s) to copy.
 * @param {string} options.manifestPath - Path to the manifest.json file.
 * @returns {Object} Vite plugin object
 */
export default function viteStaticCopyManifest(options = {}) {
  const { assetsPath, manifestPath = 'public/build/manifest.json' } = options;


  // Ensure assetsPath is provided and is a string or array
  if (!assetsPath || (typeof assetsPath !== 'string' && !Array.isArray(assetsPath))) {
    throw new Error("viteStaticCopyManifest: 'assetsPath' is required and must be a string or an array of strings.");
  }


  // Normalize assetsPath to always be an array
  const assetsPaths = Array.isArray(assetsPath) ? assetsPath : [assetsPath];


  return {
    name: 'viteStaticCopyManifest',
    apply: 'build',
    closeBundle() {
      // Resolve the path to the manifest.json file
      const resolvedManifestPath = path.resolve(__dirname, manifestPath);


      // Ensure the manifest file exists
      if (!fs.existsSync(resolvedManifestPath)) {
        fs.writeFileSync(resolvedManifestPath, JSON.stringify({}));
      }


      // Read the existing manifest
      const manifest = JSON.parse(fs.readFileSync(resolvedManifestPath, 'utf-8'));


      // Loop through each assets path and add files to the manifest
      assetsPaths.forEach((assetsDir) => {
        const resolvedAssetsPath = path.resolve(__dirname, assetsDir);


        // Get all files in the specified directory using globSync
        const files = globSync(`${resolvedAssetsPath}/**/*`, { nodir: true });


        files.forEach((file) => {
          // Calculate the relative path and replace backslashes with forward slashes
          let relativePath = path.relative(path.resolve(__dirname, 'public/build'), file);
          relativePath = relativePath.replace(/\\/g, '/');  // Convert to POSIX format


          // Add to manifest
          manifest[`${relativePath}`] = {
            file: relativePath,
            src: relativePath,
          };
        });
      });


      // Write the updated manifest back to disk
      fs.writeFileSync(resolvedManifestPath, JSON.stringify(manifest, null, 2));
    }
  };
}
