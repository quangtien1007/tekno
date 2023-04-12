// const handleCheckedRed = () => {
//     if (document.getElementById("chk_do").checked) {
//         document.getElementById("sl_do").style.display = "block";
//         document.getElementById("gt_do").style.display = "block";
//         document.getElementById("isl_do").disabled = false;
//         document.getElementById("igt_do").disabled = false;
//     } else {
//         document.getElementById("sl_do").style.display = "none";
//         document.getElementById("gt_do").style.display = "none";
//         document.getElementById("isl_do").disabled = true;
//         document.getElementById("igt_do").disabled = true;
//     }
// };
// const handleCheckedBlack = () => {
//     if (document.getElementById("chk_den").checked) {
//         document.getElementById("sl_den").style.display = "block";
//         document.getElementById("gt_den").style.display = "block";
//         document.getElementById("isl_den").disabled = false;
//         document.getElementById("igt_den").disabled = false;
//     } else {
//         document.getElementById("sl_den").style.display = "none";
//         document.getElementById("gt_den").style.display = "none";
//         document.getElementById("isl_den").disabled = true;
//         document.getElementById("igt_den").disabled = true;
//     }
// };
// const handleCheckedYellow = () => {
//     if (document.getElementById("chk_vang").checked) {
//         document.getElementById("sl_vang").style.display = "block";
//         document.getElementById("gt_vang").style.display = "block";
//         document.getElementById("isl_vang").disabled = false;
//         document.getElementById("igt_vang").disabled = false;
//     } else {
//         document.getElementById("sl_vang").style.display = "none";
//         document.getElementById("gt_vang").style.display = "none";
//         document.getElementById("isl_vang").disabled = true;
//         document.getElementById("igt_vang").disabled = true;
//     }
// };
// const handleCheckedWhite = () => {
//     if (document.getElementById("chk_trang").checked) {
//         document.getElementById("sl_trang").style.display = "block";
//         document.getElementById("gt_trang").style.display = "block";
//         document.getElementById("isl_trang").disabled = false;
//         document.getElementById("igt_trang").disabled = false;
//     } else {
//         document.getElementById("sl_trang").style.display = "none";
//         document.getElementById("gt_trang").style.display = "none";
//         document.getElementById("isl_trang").disabled = true;
//         document.getElementById("igt_trang").disabled = true;
//     }
// };
// const handleCheckedBlue = () => {
//     if (document.getElementById("chk_xanh").checked) {
//         document.getElementById("sl_xanh").style.display = "block";
//         document.getElementById("gt_xanh").style.display = "block";
//         document.getElementById("isl_xanh").disabled = false;
//         document.getElementById("igt_xanh").disabled = false;
//     } else {
//         document.getElementById("sl_xanh").style.display = "none";
//         document.getElementById("gt_xanh").style.display = "none";
//         document.getElementById("isl_xanh").disabled = true;
//         document.getElementById("igt_xanh").disabled = true;
//     }
// };
// const handleCheckedPurple = () => {
//     if (document.getElementById("chk_tim").checked) {
//         document.getElementById("sl_tim").style.display = "block";
//         document.getElementById("gt_tim").style.display = "block";
//         document.getElementById("isl_tim").disabled = false;
//         document.getElementById("igt_tim").disabled = false;
//     } else {
//         document.getElementById("sl_tim").style.display = "none";
//         document.getElementById("gt_tim").style.display = "none";
//         document.getElementById("isl_tim").disabled = true;
//         document.getElementById("igt_tim").disabled = true;
//     }
// };
// const handleChecked64 = () => {
//     if (document.getElementById("dl64").checked) {
//         document.getElementById("sl64").style.display = "block";
//         document.getElementById("gt64").style.display = "block";
//         document.getElementById("isl64").disabled = false;
//         document.getElementById("igt64").disabled = false;
//     } else {
//         document.getElementById("sl64").style.display = "none";
//         document.getElementById("gt64").style.display = "none";
//         document.getElementById("isl64").disabled = true;
//         document.getElementById("igt64").disabled = true;
//     }
// };
// const handleChecked128 = () => {
//     if (document.getElementById("dl128").checked) {
//         document.getElementById("sl128").style.display = "block";
//         document.getElementById("gt128").style.display = "block";
//         document.getElementById("isl128").disabled = false;
//         document.getElementById("igt128").disabled = false;
//     } else {
//         document.getElementById("sl128").style.display = "none";
//         document.getElementById("gt128").style.display = "none";
//         document.getElementById("isl128").disabled = true;
//         document.getElementById("igt128").disabled = true;
//     }
// };
// const handleChecked256 = () => {
//     if (document.getElementById("dl256").checked) {
//         document.getElementById("sl256").style.display = "block";
//         document.getElementById("gt256").style.display = "block";
//         document.getElementById("isl256").disabled = false;
//         document.getElementById("igt256").disabled = false;
//     } else {
//         document.getElementById("sl256").style.display = "none";
//         document.getElementById("gt256").style.display = "none";
//         document.getElementById("isl256").disabled = true;
//         document.getElementById("igt256").disabled = true;
//     }
// };
// const handleChecked512 = () => {
//     if (document.getElementById("dl512").checked) {
//         document.getElementById("sl512").style.display = "block";
//         document.getElementById("gt512").style.display = "block";
//         document.getElementById("isl512").disabled = false;
//         document.getElementById("igt512").disabled = false;
//     } else {
//         document.getElementById("sl512").style.display = "none";
//         document.getElementById("gt512").style.display = "none";
//         document.getElementById("isl512").disabled = true;
//         document.getElementById("igt512").disabled = true;
//     }
// };

// const handleChecked1 = () => {
//     if (document.getElementById("dl1").checked) {
//         document.getElementById("sl1").style.display = "block";
//         document.getElementById("gt1").style.display = "block";
//         document.getElementById("isl1").disabled = false;
//         document.getElementById("igt1").disabled = false;
//     } else {
//         document.getElementById("sl1").style.display = "none";
//         document.getElementById("gt1").style.display = "none";
//         document.getElementById("isl1").disabled = true;
//         document.getElementById("igt1").disabled = true;
//     }
// };
const handleChecked = (mid, dlid) => {
    // console.log(item);
    var inputmsp = document.querySelectorAll(`#` + mid);
    if (document.getElementById(dlid).checked) {
        for (let i = 0; i < inputmsp.length; i++) {
            inputmsp[i].disabled = false;
        }
    } else {
        for (let i = 0; i < inputmsp.length; i++) {
            inputmsp[i].disabled = true;
        }
    }
    if (document.getElementById("dl_null").checked) {
        document.getElementById("dl_1").disabled = true;
        document.getElementById("dl_128").disabled = true;
        document.getElementById("dl_64").disabled = true;
        document.getElementById("dl_256").disabled = true;
        document.getElementById("dl_512").disabled = true;
    } else {
        document.getElementById("dl_1").disabled = false;
        document.getElementById("dl_128").disabled = false;
        document.getElementById("dl_64").disabled = false;
        document.getElementById("dl_256").disabled = false;
        document.getElementById("dl_512").disabled = false;
    }
};
const handleCheckColor = (slel, slid) => {
    if (document.getElementById(slel).checked) {
        document.getElementById(slid).disabled = false;
    } else {
        document.getElementById(slid).disabled = true;
    }
};
const addToCompare = (product_id) => {
    var id = product_id;
    var name = document.getElementById("name" + id).value;
    var price = document.getElementById("price" + id).value;
    var image = document.getElementById("image" + id).value;
    var url = document.getElementById("url" + id).href;
    var tskt = document.getElementById("tskt" + id).value;
    var cate = document.getElementById("cate" + id).value;
    // console.log(url);

    var newItem = {
        id: id,
        name: name,
        price: price,
        image: image,
        url: url,
        tskt: tskt,
        cate: cate,
    };

    if (localStorage.getItem("compare") == null) {
        localStorage.setItem("compare", "[]");
    }

    var oldData = JSON.parse(localStorage.getItem("compare"));

    var matches = $.grep(oldData, function (obj) {
        return obj.id == id;
    });

    var matchesCate = $.grep(oldData, function (obj) {
        return obj.cate != cate;
    });

    if (matches.length) {
        $("#myModal").modal();
    } else if (matchesCate.length) {
        swal("Khum được đôu", "Hai sản phẩm so sánh phải cùng loại!", "error");
    } else {
        if (oldData.length <= 1) {
            oldData.push(newItem);
            $("#row_compare").append(
                `
                    <div class="col-sm-6" id="table_compare` +
                    newItem.id +
                    `">
                    <table class="table table-bordered table_comparee">
                    <thead>
                        <th style="display:flex;justify-content:space-around;">` +
                    newItem.name +
                    ` - ` +
                    new Intl.NumberFormat("it-IT", {
                        style: "currency",
                        currency: "VND",
                    }).format(newItem.price) +
                    `<a style="cursor:pointer;" onClick="deleteCompare(` +
                    newItem.id +
                    `)"><i class="fa-solid fa-xmark fa-lg"></i></a>` +
                    `</th>
                    </thead>
                    <tbody>
                    <td>` +
                    newItem.tskt +
                    `
                    </tbody>
                    <tfoot>
                    <td><a class="primary-btn" style="cursor:pointer;" href="` +
                    newItem.url +
                    `">Mua Ngay</a></td>
                    </tfoot>
                    </table>
                    </div>`
            );
        }
        localStorage.setItem("compare", JSON.stringify(oldData));
        $("#myModal").modal();
    }
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
            var tskt = data[i].tskt;
            $("#row_compare").append(
                `
                    <div class="col-sm-6" id="table_compare` +
                    id +
                    `">
                    <table class="table table-bordered">
                    <thead>
                        <th style="display:flex;justify-content:space-around;">` +
                    name +
                    ` - ` +
                    new Intl.NumberFormat("it-IT", {
                        style: "currency",
                        currency: "VND",
                    }).format(price) +
                    `<a style="cursor:pointer;" onClick="deleteCompare(` +
                    id +
                    `)"><i class="fa-solid fa-xmark fa-lg"></i></a>` +
                    `</th>
                    </thead>
                    <tbody>
                    <td>` +
                    tskt +
                    `
                    </tbody>
                    <tfoot>
                    <td><a class="primary-btn" style="cursor:pointer;" href="` +
                    url +
                    `">Mua Ngay</a></td>
                    </tfoot>
                </table>
                </div>`
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
    setInterval(updateCountdown, 1000);
});
const deleteCompare = (id) => {
    if (localStorage.getItem("compare") != null) {
        var data = JSON.parse(localStorage.getItem("compare"));

        var index = data.findIndex((item) => item.id === id);

        data.splice(index, 1);

        localStorage.setItem("compare", JSON.stringify(data));
        //remove
        document.getElementById("table_compare" + id).remove();
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

    // console.log(newItem);
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

            document.getElementById("wishlist_list").appendChild(el);

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
function updateCountdown() {
    let now = new Date();
    let target = new Date(
        now.getFullYear(),
        now.getMonth(),
        now.getDate() + 30,
        0,
        0,
        0
    );
    let diff = target - now;

    if (diff <= 0) {
        document.querySelector("#countdown").innerHTML = "Expired";
        return;
    }

    let days = Math.floor(diff / 1000 / 60 / 60 / 24);
    let hours = Math.floor(diff / 1000 / 60 / 60) % 24;
    let minutes = Math.floor(diff / 1000 / 60) % 60;
    let seconds = Math.floor(diff / 1000) % 60;

    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;
    document.getElementById("seconds").innerHTML = seconds;
}

updateCountdown();
// var sliderFormat = document.getElementById("slider-formatr");

// noUiSlider.create(sliderFormat, {
//     start: [20000],
//     step: 500,
//     connect: [true, false],
//     range: {
//         min: [1000],
//         max: [550000],
//     },
//     ariaFormat: wNumb({
//         decimals: 3,
//     }),
//     format: wNumb({
//         decimals: 3,
//         thousand: ".",
//         suffix: " $",
//     }),
// });

// // INPUT SUPPORT

// var inputFormat = document.getElementById("input-formatr");

// sliderFormat.noUiSlider.on("update", function (values, handle) {
//     inputFormat.value = values[handle];
// });

// inputFormat.addEventListener("change", function () {
//     sliderFormat.noUiSlider.set(this.value);
// });

