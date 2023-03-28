window.onload = viewCompared;
const handleCheckedRed = () =>{
    if(document.getElementById('chk_do').checked)
    {
        document.getElementById('sl_do').style.display = 'block';
        document.getElementById('gt_do').style.display = 'block';
        document.getElementById('isl_do').disabled = false;
        document.getElementById('igt_do').disabled = false;
    }
    else{
        document.getElementById('sl_do').style.display = 'none';
        document.getElementById('gt_do').style.display = 'none';
        document.getElementById('isl_do').disabled = true;
        document.getElementById('igt_do').disabled = true;
    }
}
const handleCheckedBlack = () =>{
    if(document.getElementById('chk_den').checked)
    {
        document.getElementById('sl_den').style.display = 'block';
        document.getElementById('gt_den').style.display = 'block';
        document.getElementById('isl_den').disabled = false;
        document.getElementById('igt_den').disabled = false;
    }
    else{
        document.getElementById('sl_den').style.display = 'none';
        document.getElementById('gt_den').style.display = 'none';
        document.getElementById('isl_den').disabled = true;
        document.getElementById('igt_den').disabled = true;
    }
}
const handleCheckedYellow = () =>{
    if(document.getElementById('chk_vang').checked)
    {
        document.getElementById('sl_vang').style.display = 'block';
        document.getElementById('gt_vang').style.display = 'block';
        document.getElementById('isl_vang').disabled = false;
        document.getElementById('igt_vang').disabled = false;
    }
    else{
        document.getElementById('sl_vang').style.display = 'none';
        document.getElementById('gt_vang').style.display = 'none';
        document.getElementById('isl_vang').disabled = true;
        document.getElementById('igt_vang').disabled = true;
    }
}
const handleCheckedWhite = () =>{
    if(document.getElementById('chk_trang').checked)
    {
        document.getElementById('sl_trang').style.display = 'block';
        document.getElementById('gt_trang').style.display = 'block';
        document.getElementById('isl_trang').disabled = false;
        document.getElementById('igt_trang').disabled = false;
    }
    else{
        document.getElementById('sl_trang').style.display = 'none';
        document.getElementById('gt_trang').style.display = 'none';
        document.getElementById('isl_trang').disabled = true;
        document.getElementById('igt_trang').disabled = true;
    }
}
const handleCheckedBlue = () =>{
    if(document.getElementById('chk_xanh').checked)
    {
        document.getElementById('sl_xanh').style.display = 'block';
        document.getElementById('gt_xanh').style.display = 'block';
        document.getElementById('isl_xanh').disabled = false;
        document.getElementById('igt_xanh').disabled = false;
    }
    else{
        document.getElementById('sl_xanh').style.display = 'none';
        document.getElementById('gt_xanh').style.display = 'none';
        document.getElementById('isl_xanh').disabled = true;
        document.getElementById('igt_xanh').disabled = true;
    }
}
const handleCheckedPurple = () =>{
    if(document.getElementById('chk_tim').checked)
    {
        document.getElementById('sl_tim').style.display = 'block';
        document.getElementById('gt_tim').style.display = 'block';
        document.getElementById('isl_tim').disabled = false;
        document.getElementById('igt_tim').disabled = false;
    }
    else{
        document.getElementById('sl_tim').style.display = 'none';
        document.getElementById('gt_tim').style.display = 'none';
        document.getElementById('isl_tim').disabled = true;
        document.getElementById('igt_tim').disabled = true;
    }
}
const handleChecked64 = () =>{
    if(document.getElementById('dl64').checked)
    {
        document.getElementById('sl64').style.display = 'block';
        document.getElementById('gt64').style.display = 'block';
        document.getElementById('isl64').disabled = false;
        document.getElementById('igt64').disabled = false;
    }
    else{
        document.getElementById('sl64').style.display = 'none';
        document.getElementById('gt64').style.display = 'none';
        document.getElementById('isl64').disabled = true;
        document.getElementById('igt64').disabled = true;
    }
}
const handleChecked128 = () =>{
    if(document.getElementById('dl128').checked)
    {
        document.getElementById('sl128').style.display = 'block';
        document.getElementById('gt128').style.display = 'block';
        document.getElementById('isl128').disabled = false;
        document.getElementById('igt128').disabled = false;
    }
    else{
        document.getElementById('sl128').style.display = 'none';
        document.getElementById('gt128').style.display = 'none';
        document.getElementById('isl128').disabled = true;
        document.getElementById('igt128').disabled = true;
    }
}
const handleChecked256 = () =>{
    if(document.getElementById('dl256').checked)
    {
        document.getElementById('sl256').style.display = 'block';
        document.getElementById('gt256').style.display = 'block';
        document.getElementById('isl256').disabled = false;
        document.getElementById('igt256').disabled = false;
    }
    else{
        document.getElementById('sl256').style.display = 'none';
        document.getElementById('gt256').style.display = 'none';
        document.getElementById('isl256').disabled = true;
        document.getElementById('igt256').disabled = true;
    }
}
const handleChecked512 = () =>{
    if(document.getElementById('dl512').checked)
    {
        document.getElementById('sl512').style.display = 'block';
        document.getElementById('gt512').style.display = 'block';
        document.getElementById('isl512').disabled = false;
        document.getElementById('igt512').disabled = false;
    }
    else{
        document.getElementById('sl512').style.display = 'none';
        document.getElementById('gt512').style.display = 'none';
        document.getElementById('isl512').disabled = true;
        document.getElementById('igt512').disabled = true;
    }
}

const handleChecked1 = () =>{
    if(document.getElementById('dl1').checked)
    {
        document.getElementById('sl1').style.display = 'block';
        document.getElementById('gt1').style.display = 'block';
        document.getElementById('isl1').disabled = false;
        document.getElementById('igt1').disabled = false;
    }
    else{
        document.getElementById('sl1').style.display = 'none';
        document.getElementById('gt1').style.display = 'none';
        document.getElementById('isl1').disabled = true;
        document.getElementById('igt1').disabled = true;
    }
}

const addToCompare = (product_id) => {
    var id = product_id;
    var name = document.getElementById('name'+id).value;
    var price = document.getElementById('price'+id).value;
    var image = document.getElementById('image'+id).value;
    var url = document.getElementById('url'+id).href;
    // console.log(url);

    var newItem = {
        'id':id,
        'name':name,
        'price':price,
        'image':image,
        'url':url
    }

    if(localStorage.getItem('compare') == null){
        localStorage.setItem('compare','[]');
    }

    var oldData = JSON.parse(localStorage.getItem('compare'));

    var matches = $.grep(oldData,function(obj){
        return obj.id == id;
    })

    if(matches.length){

    } else{
        if(oldData.length<=2){
            oldData.push(newItem);
            $('#row_compare').find('tbody').append(`
                <tr id="row_compare`+id+`">
                <td><img width="100px" src="` +newItem.image+ `"></td>
                <td>` +newItem.name+`</td>
                <td>`+ newItem.price +`</td>
                <td><a href="`+newItem.url+`">Xem sản phẩm</a></td>
                <td><a style="cursor:pointer;" onclick="deleteCompare(`+id+`)">Xóa</a></td></tr>
                `
            )
        }
    }
    localStorage.setItem('compare',JSON.stringify(oldData));
    $('#myModal').modal();
}


function viewCompared(){
    if(localStorage.getItem('compare')!=null){
        var data =  JSON.parse(localStorage.getItem('compare'));

        for(i=0;i<data.length;i++){
            var id = data[i].id;
            var name = data[i].name;
            var image = data[i].image;
            var price = data[i].price;
            var url = data[i].url;
            $('#row_compare').find('tbody').append(`
                <tr id="row_compare`+id+`">
                <td><img width="100px" src="` +image+ `"></td>
                <td>` +name+`</td>
                <td>`+ price +`</td>
                <td><a href="`+url+`">Xem sản phẩm</a></td>
                <td onclick="deleteCompare(`+id+`)"><a style="cursor:pointer;" >Xóa</a></td></tr>
                `
            )
        }
    }
}
$( document ).ready(function() {
    console.log( "ready!" );
    viewCompared();
    var oldWishlist = JSON.parse(localStorage.getItem('wishlist'));
    let counter = 0;
    for (let i = 0; i < oldWishlist.length; i++) {
        if (oldWishlist[i]) counter++;
    }
    $('#wishlist-qty').append(
        counter ? counter : '0'
    )
});
const deleteCompare = (id) =>{
    if(localStorage.getItem('compare')!=null){
        var data =  JSON.parse(localStorage.getItem('compare'));

        var index = data.findIndex(item => item.id === id);

        data.splice(index, 1);

        localStorage.setItem("compare",JSON.stringify(data));
        //remove
        document.getElementById("row_compare"+id).remove();
    }
}

const addToWishlist = (product_id) => {
    var id = product_id;
    var name = document.getElementById('name'+id).value;
    var price = document.getElementById('price'+id).value;
    var image = document.getElementById('image'+id).value;
    var url = document.getElementById('url'+id).href;
    // alert(name);

    var newItem = {
        'id':id,
        'name':name,
        'price':price,
        'image':image,
        'url':url
    }

    if(localStorage.getItem('wishlist') == null){
        localStorage.setItem('wishlist','[]');
    }

    var oldWishlist = JSON.parse(localStorage.getItem('wishlist'));

    var matches = $.grep(oldWishlist,function(obj){
        return obj.id == id;
    })

    if(matches.length){

    } else{
        if(oldWishlist.length<=15){
            oldWishlist.push(newItem);
            let counter = 0;
            for (let i = 0; i < oldWishlist.length; i++) {
                if (oldWishlist[i]) counter++;
            }

            if(document.getElementById("wishlist-qty")){
                document.getElementById("wishlist-qty").remove();
            }

            const el = document.createElement('div');
            el.setAttribute('id','wishlist-qty');
            el.classList.add('qty');

            document.getElementById('wishlist_list').append(el);

            $('#wishlist-qty').append(
                counter ? counter : '0'
            )
            // table_wishlist
        }
    }
    localStorage.setItem('wishlist',JSON.stringify(oldWishlist));

    // $('#myModal').modal();
}
window.onload = viewWishlist;
function viewWishlist(){
    if(localStorage.getItem('wishlist')!=null){
        var data =  JSON.parse(localStorage.getItem('wishlist'));

        for(i=0;i<data.length;i++){
            var id = data[i].id;
            var name = data[i].name;
            var image = data[i].image;
            var price = data[i].price;
            var url = data[i].url;
            $('#table_wishlist').find('tbody').append(`
                <tr id="row_wishlist`+id+`">
                <td><img width="100px" src="` +image+ `"></td>
                <td>` +name+`</td>
                <td>`+ price +`</td>
                <td><a href="`+url+`">Xem sản phẩm</a></td>
                <td onclick="deleteWishlist(`+id+`)"><a style="cursor:pointer;" >Xóa</a></td></tr>
                `
            )
        }
    }
}

const deleteWishlist = (id) =>{
    if(localStorage.getItem('wishlist')!=null){
        var data =  JSON.parse(localStorage.getItem('wishlist'));

        var index = data.findIndex(item => item.id === id);

        data.splice(index, 1);

        localStorage.setItem("wishlist",JSON.stringify(data));
        //remove
        document.getElementById("row_wishlist"+id).remove();
    }
}
const deleteAllWishlist = () =>{
    if(localStorage.getItem('wishlist')!=null){
        var data = [];
        localStorage.setItem("wishlist",JSON.stringify(data));
        document.getElementById("body_wishlist").remove();
    }
}
