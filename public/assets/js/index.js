window.onload = viewCompared;

const addToCompare = (product_id) => {
    var id = product_id;
    var name = document.getElementById("name" + id).value;
    var price = document.getElementById("price" + id).value;
    var image = document.getElementById("image" + id).value;
    var url = document.getElementById("url" + id).href;
    // console.log(url);

    var newItem = {
        id: id,
        name: name,
        price: price,
        image: image,
        url: url,
    };

    if (localStorage.getItem("compare") == null) {
        localStorage.setItem("compare", "[]");
    }

    var oldData = JSON.parse(localStorage.getItem("compare"));

    var matches = $.grep(oldData, function (obj) {
        return obj.id == id;
    });

    if (matches.length) {
    } else {
        if (oldData.length <= 2) {
            oldData.push(newItem);
            $("#row_compare")
                .find("tbody")
                .append(
                    `
                <tr id="row_compare` +
                        id +
                        `">
                <td><img width="100px" src="` +
                        newItem.image +
                        `"></td>
                <td>` +
                        newItem.name +
                        `</td>
                <td>` +
                        new Intl.NumberFormat("it-IT", {
                            style: "currency",
                            currency: "VND",
                        }).format(newItem.price) +
                        `</td>
                <td><a href="` +
                        newItem.url +
                        `">Xem sản phẩm</a></td>
                <td><a style="cursor:pointer;" onclick="deleteCompare(` +
                        id +
                        `)">Xóa</a></td></tr>
                `
                );
        }
    }
    localStorage.setItem("compare", JSON.stringify(oldData));
    $("#myModal").modal();
};

function viewCompared() {
    if (localStorage.getItem("compare") != null) {
        var data = JSON.parse(localStorage.getItem("compare"));

        for (i = 0; i < data.length; i++) {
            var id = data[i].id;
            var name = data[i].name;
            var image = data[i].image;
            var price = data[i].price;
            var url = data[i].url;
            $("#row_compare")
                .find("tbody")
                .append(
                    `
            <tr id="row_compare` +
                        id +
                        `">
            <td><img width="100px" src="` +
                        image +
                        `"></td>
            <td>` +
                        name +
                        `</td>
            <td>` +
                        new Intl.NumberFormat("it-IT", {
                            style: "currency",
                            currency: "VND",
                        }).format(price) +
                        `</td>
            <td><a href="` +
                        url +
                        `">Xem sản phẩm</a></td>
            <td onclick="deleteCompare(` +
                        id +
                        `)"><a style="cursor:pointer;" >Xóa</a></td></tr>
            `
                );
        }
    }
}
$(document).ready(function () {
    console.log("ready!");
    viewCompared();
    var oldWishlist = JSON.parse(localStorage.getItem("wishlist"));
    let counter = 0;
    for (let i = 0; i < oldWishlist.length; i++) {
        if (oldWishlist[i]) counter++;
    }
    $("#wishlist-qty").append(counter ? counter : "0");
});
const deleteCompare = (id) => {
    if (localStorage.getItem("compare") != null) {
        var data = JSON.parse(localStorage.getItem("compare"));

        var index = data.findIndex((item) => item.id === id);

        data.splice(index, 1);

        localStorage.setItem("compare", JSON.stringify(data));
        //remove
        document.getElementById("row_compare" + id).remove();
    }
};

const addToWishlist = (product_id) => {
    var id = product_id;
    var name = document.getElementById("name" + id).value;
    var price = document.getElementById("price" + id).value;
    var image = document.getElementById("image" + id).value;
    var url = document.getElementById("url" + id).href;
    // alert(name);

    var newItem = {
        id: id,
        name: name,
        price: price,
        image: image,
        url: url,
    };

    if (localStorage.getItem("wishlist") == null) {
        localStorage.setItem("wishlist", "[]");
    }

    var oldWishlist = JSON.parse(localStorage.getItem("wishlist"));

    var matches = $.grep(oldWishlist, function (obj) {
        return obj.id == id;
    });

    if (matches.length) {
    } else {
        if (oldWishlist.length <= 15) {
            oldWishlist.push(newItem);
            let counter = 0;
            for (let i = 0; i < oldWishlist.length; i++) {
                if (oldWishlist[i]) counter++;
            }

            if (document.getElementById("wishlist-qty")) {
                document.getElementById("wishlist-qty").remove();
            }

            const el = document.createElement("div");
            el.setAttribute("id", "wishlist-qty");
            el.classList.add("qty");

            document.getElementById("wishlist_list").append(el);

            $("#wishlist-qty").append(counter ? counter : "0");
            // table_wishlist
            window.FlashMessage.success("Đã thêm vào yêu thích!");
        }
    }
    localStorage.setItem("wishlist", JSON.stringify(oldWishlist));
};
window.onload = viewWishlist;
function viewWishlist() {
    if (localStorage.getItem("wishlist") != null) {
        var data = JSON.parse(localStorage.getItem("wishlist"));

        for (i = 0; i < data.length; i++) {
            var id = data[i].id;
            var name = data[i].name;
            var image = data[i].image;
            var price = data[i].price;
            var url = data[i].url;
            $("#table_wishlist")
                .find("tbody")
                .append(
                    `
                <tr id="row_wishlist` +
                        id +
                        `">
                <td><img width="100px" src="` +
                        image +
                        `"></td>
                <td>` +
                        name +
                        `</td>
                <td>` +
                        new Intl.NumberFormat("it-IT", {
                            style: "currency",
                            currency: "VND",
                        }).format(price) +
                        `</td>
                <td><a href="` +
                        url +
                        `">Xem sản phẩm</a></td>
                <td onclick="deleteWishlist(` +
                        id +
                        `)"><a style="cursor:pointer;" >Xóa</a></td></tr>
                `
                );
        }
    }
    var number = 123132312;
    console.log(
        new Intl.NumberFormat("de-DE", {
            style: "currency",
            currency: "EUR",
        }).format(number)
    );
}

const deleteWishlist = (id) => {
    if (localStorage.getItem("wishlist") != null) {
        var data = JSON.parse(localStorage.getItem("wishlist"));

        var index = data.findIndex((item) => item.id === id);

        data.splice(index, 1);

        localStorage.setItem("wishlist", JSON.stringify(data));
        //remove
        document.getElementById("row_wishlist" + id).remove();
    }
};
const deleteAllWishlist = () => {
    if (localStorage.getItem("wishlist") != null) {
        var data = [];
        localStorage.setItem("wishlist", JSON.stringify(data));
        document.getElementById("body_wishlist").remove();
    }
};

const openChat = () => {
    document.getElementById("chat-area").style.display = "block";
};
const hideChat = () => {
    document.getElementById("chat-area").style.display = "none";
};
