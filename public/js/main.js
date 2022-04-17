let xhr = new XMLHttpRequest();
let products = document.querySelectorAll(`.cart_quantity`);
// let quantity = document.querySelectorAll(`.quantity`);
let prices = document.querySelectorAll(`.price`);
let orgin_product = document.querySelectorAll(`.product_quantity`);
let total_price_contiainer = document.querySelector(`.total`);
// console.log(document.querySelectorAll(`.quantity`));
// alert(products[2].value);
// console.log(products[0].value);

    function calculateTotalPrice(){
        totalPrice = 0;
        for(let i = 0 ; i < products.length;i++){
            totalPrice += parseInt( products[i].value) * parseInt(prices[i].id);
        }
        return totalPrice;
    }
// alert(totalPrice);
total_price_contiainer.innerHTML = `Total Price : ${calculateTotalPrice()}$`;
// console.log(orgin_product[0].value);
// console.log(prices[0].id );
for(let i=0; i<products.length;i++){
    products[i].addEventListener('change',function(e){
        old_quantity = products[i].value;

        if(parseInt( products[i].value)>parseInt(orgin_product[i].value)){
            products[i].value = orgin_product[i].value;           
        }else if(parseInt( products[i].value)<0){
            products[i].value = 0;
        }

        let id = e.target.id.substr(7);
        let price = document.querySelector(`.price${id}`).id;
        let user_id = document.querySelector(`.user_id${id}`).value;
        let product_id = document.querySelector(`.product_id${id}`).value;
        document.querySelector(`.sub_total${id}`).innerHTML = `${ price * e.target.value}$`;
        total_price_contiainer.innerHTML = `Total Price: ${calculateTotalPrice()}$`
        // recalculating the total price
        // totalPrice = totalPrice - old_quantity *  prices[i].id;
        console.log(old_quantity);

        // alert(user_id);

        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                let res = this.responseText;
                // console.log(res);
            }
        }

        xhr.open("POST","/update_quantity",true);
        // xhr.setRequestHeader("Content-type", "application/x-www-from-urlencoded");
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xhr.send(`quantity=${e.target.value}&user_id=${user_id}&product_id=${product_id}`);

    });
}