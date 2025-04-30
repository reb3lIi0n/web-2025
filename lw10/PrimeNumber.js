function isPrimeNumber(input) {
    function isPrime(n) {
      if (typeof n !== 'number' || n < 2 || !Number.isInteger(n)) {
        return false;
      }
      const limit = Math.sqrt(n);
      for (let i = 2; i <= limit; i++) {
        if (n % i === 0) {
          return false;
        }
      }
      return true;
    }

    if (typeof input === 'number') {
      const result = isPrime(input)
        ? `${input} простое число`
        : `${input} не простое число`;
      console.log(result);
      return;
    }
  
    if (Array.isArray(input)) {
      const primes = [];
      const nonPrimes = [];
  
      input.forEach(n => {
        if (isPrime(n)) primes.push(n);
        else nonPrimes.push(n);
      });
  
      const parts = [];
  
      if (primes.length) {
        const word = primes.length > 1 ? 'простые числа' : 'простое число';
        parts.push(`${primes.join(', ')} ${word}`);
      }
  
      if (nonPrimes.length) {
        const word = nonPrimes.length > 1 ? 'не простые числа' : 'не простое число';
        parts.push(`${nonPrimes.join(', ')} ${word}`);
      }
  
      console.log(parts.join(', '));
      return;
    }
    console.error('Аргумент должен быть числом или массивом чисел');
  }
  isPrimeNumber(3);
  isPrimeNumber(4);
  isPrimeNumber([3, 4, 5]);
  