const fs = require('fs');
const file = process.argv[2];
const buffer = fs.readFileSync(file);
let str = buffer.toString();
let newLineArray = str.split("\n");

console.log(newLineArray.length - 1);
