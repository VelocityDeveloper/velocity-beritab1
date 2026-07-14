const fs = require("fs-extra");
const archiver = require("archiver");
const path = require("path");
const { globSync } = require("glob");
const packageJson = require("../package.json");

const themeName = packageJson.name;
const themeVersion = packageJson.version;
const projectFolder = path.join(__dirname, "..");
const outputFolder = path.join(projectFolder, "dist");
const tempFolder = path.join(outputFolder, themeName);
const outputFileName = `${themeName}-${themeVersion}.zip`;
const outputPath = path.join(outputFolder, outputFileName);

fs.emptyDirSync(outputFolder);
fs.ensureDirSync(tempFolder);

const files = globSync("**/*", {
  cwd: projectFolder,
  dot: true,
  nodir: true,
  ignore: [
    ".git/**",
    ".github/**",
    ".vscode/**",
    "dist/**",
    "node_modules/**",
    "src/**",
    "package.json",
    "package-lock.json",
  ],
});

files.forEach((file) => {
  fs.copySync(path.join(projectFolder, file), path.join(tempFolder, file));
});

const output = fs.createWriteStream(outputPath);
const archive = archiver("zip", { zlib: { level: 9 } });

output.on("close", () => {
  console.log(`${archive.pointer()} total bytes`);
  console.log(`Release package created: dist/${outputFileName}`);
  fs.removeSync(tempFolder);
});

archive.on("warning", (error) => {
  if (error.code !== "ENOENT") {
    throw error;
  }
  console.warn(error.message);
});

archive.on("error", (error) => {
  throw error;
});

archive.pipe(output);
archive.directory(tempFolder, themeName);
archive.finalize();
