const path = require("path");
const fs = require("fs");

function rowsFromTextFile(filePath) {
  const pathInput = path.join(__dirname, filePath);
  const file = fs.readFileSync(pathInput, "utf8");
  const rows = file.split("\n").map((row) => row.trim());

  return rows;
}

module.exports = { rowsFromTextFile };