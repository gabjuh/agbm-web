// var products = [{
//     "name": "Pizza",
//     "price": "10",
//     "quantity": "7"
//   }, {
//     "name": "Cerveja",
//     "price": "12",
//     "quantity": "5"
//   }, {
//     "name": "Hamburguer",
//     "price": "10",
//     "quantity": "2"
//   }, {
//     "name": "Fraldas",
//     "price": "6",
//     "quantity": "2"
//   }];
//   console.log(products);
//   var b = JSON.parse(products); //unexpected token o


var object = {'Apple':1,'Banana':8,'Pineapple':null};
//convert object keys to array
var k = Object.keys(object);
//convert object values to array
var v = Object.values(object);

var array = [];

array.push(k + v);

console.log(array);


const object1 = {
    a: 'somestring',
    b: 42
  };
  
  for (const [key, value] of Object.entries(object1)) {
    // console.log(`${key}: ${value}`);

    var arr = `${key}: ${value}`;

    console.log(arr);
    console.log(typeof arr);

    var arrrray = [];

    a = arrr Object.a(arr);
    console.log(a);



  }