function countVowels(str) {
  const vowels = "аеёиоуыэюяАЕЁИОУЫЭЮЯ";
  let count = 0;
  for (let i = 0; i < str.length; i++) {
    const char = str[i];
    let isCurrentCharVowel = false;
    for (let j = 0; j < vowels.length; j++) {
        const vowelChar = vowels[j];   
        if (char === vowelChar) {
            isCurrentCharVowel = true;
            break; 
        }
    }
    if (isCurrentCharVowel) {
        count++; 
    }
  }
  return count;
}

  console.log(countVowels("Привет, мир!"));
  console.log(countVowels("Здравствуй, друг!"));
  console.log(countVowels("Бррр... тьфу-тьфу!"));
  