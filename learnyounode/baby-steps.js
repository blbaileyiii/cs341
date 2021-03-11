let myArgs = process.argv.slice(2);

let sum = 0;
myArgs.forEach(arg => sum += parseInt(arg));

console.log(sum);