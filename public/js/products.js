let xhr = new XMLHttpRequest();
let category = document.querySelector(`#category`);
let sub_category = document.querySelector(`#sub_category`);
// let btn = document.querySelector(`#addImagebtn`);
category.addEventListener('change',function(e){
    let category_id  = category.value;
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){ 
            sub_category.innerHTML=this.responseText;          
        }
    }

    xhr.open("post","/admin/products/create",true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.send(`category_id=${category_id}`);

});
