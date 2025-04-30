function uniqueElements(arr) {
    const counts = {};
    arr.forEach(el => {
      const key = String(el);
      counts[key] = (counts[key] || 0) + 1;
    });
    return counts;
  }
  console.log(uniqueElements(['привет', 'hello', 1, '1']));
  console.log(uniqueElements([2, 2, '2', '2', 'тест', 'ТЕСТ', 'тест']));