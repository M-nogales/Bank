var el = document.getElementById('currMoney'); 
var r = document.getElementById('MoneyRange'); 
el.innerText = r.valueAsNumber; 
r.addEventListener('change', () => { 
    el.innerText = r.valueAsNumber; 
}) 
var el1 = document.getElementById('currDays'); 
var r1 = document.getElementById('DaysRange'); 
el1.innerText = r.valueAsNumber; 
r1.addEventListener('change', () => { 
    el1.innerText = r1.valueAsNumber; 
}) 