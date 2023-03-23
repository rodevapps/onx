function diff(first, second) {
	const a = new Set(first);
	const b = new Set(second);

	return [
		...first.filter(x => !b.has(x)),
		...second.filter(x => !a.has(x))
	];
}

const arrA = [ 1, 2, 3, 4, 5 ];
const arrB = [ 4, 5, 6 ];

console.log(diff(arrA, arrB));
