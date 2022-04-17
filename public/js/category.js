let xhr = new XMLHttpRequest();
let subCategory = document.querySelector(`#chosen_subCategory`);
let products_container = document.querySelector(`.products-container`);


// console.log(sub_category.innerHTML);

subCategory.addEventListener('change',function(e){
    let category_id = document.querySelector('#category_id').value;
    xhr.onreadystatechange = function(){
        console.log(this.readyState + "    " + this.status);
        if(this.readyState == 4 && this.status == 200){ 
            products_container.innerHTML=this.responseText;
        }
    }
    xhr.open("POST","/category",true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.send(`subcategory_title=${subCategory.value}&category_id=${category_id}`) ;

});
