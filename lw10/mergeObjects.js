function mergeObjects(obj1, obj2) {
    const mergedObject = {};
    for (const key in obj1) {
      mergedObject[key] = obj1[key];
    }
    for (const key in obj2) {
      mergedObject[key] = obj2[key];
    }
    return mergedObject;
  }
  console.log(mergeObjects({ a: 1, b: 5 }, { b: 3, c: 4 }));