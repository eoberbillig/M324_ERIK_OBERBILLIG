// index.js   ← 5 Leerzeichen vor der ersten Zeile

export const sum = (a, b) => {
  return a + b
}

// Verstoss gegen no-unused-vars:
const unusedVar = 100

console.log(sum(1, 2))

// Verstoss gegen eqeqeq:
if (sum(1, 2) == 4) {
  console.log('It equals 4')
}

// Verstoss gegen no-console (wenn diese Regel aktiv ist)
console.log('Debugging message')
