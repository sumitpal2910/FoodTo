/**
 * Show Foods
 */
function showFoods() {
    // send request
    $.ajax({
        url: `${window.location.origin}${window.location.pathname}/data`,
        method: "get",
        dataType: "JSON",
        success: function (res) {
            console.log(res);
            foodList(res.data);
        },
    });
}
showFoods();

/**
 * food list
 */
function foodList(data) {
    $("#showFoods").html("");
    for (let i = 0; i < data.menus.length; i++) {
        const menu = data.menus[i];

        // Menu title
        let menuContent = `
            <div class="bg-white mb-4">
                <h5 id="menu-list-${menu.id}"
                    class="mb-4 pt-3 col-md-12">${menu.title.toUpperCase()}
                    <small class="h6 text-black-50">
                    ${menu.foods.length} ITEMS</small>
                </h5>
                <hr class="food-hr">`;

        for (let j = 0; j < menu.foods.length; j++) {
            const food = menu.foods[j];
            let foodText = `<div class="gold-members pt-3 pl-3 border-bottom "> <div class="row">`;

            foodText += printDetails(food);
            foodText += printImgAndButtons(food, data.cartItems);

            foodText += `</div></div>`;
            menuContent += foodText;
        }

        menuContent += "</div>";

        $("#showFoods").append(menuContent);
    }
}

/**
 * Print Food Details
 */
function printDetails(food) {
    let data = "";

    data = `<div class="col-md-9 row">

        <div class="col-12">
            <i class="icofont-ui-press text-${
                food.veg == 1 ? "success" : "danger"
            } food-item"></i>
        </div>

        <div class="col-12 mt-4px">
            <strong>${food.name}</strong>
        </div>
        <div class="col-12 mt-4px">
            &#8377 ${food.price}
        </div>`;

    if (food.thumbnail) {
        data += `<div class="col-12 mt-4px">
            <small class="text-secondary">
                ${food.description}
            </small>
        </div>`;
    }
    data += `</div>`;

    return data;
}

/**
 * Add To Cart Button
 */
function printImgAndButtons(food, cartItems) {
    let cart = null;
    if (cartItems instanceof Object) {
        cart = cartItems[food.id];
    }

    let data = `<div class="col-md-3">`;

    // image
    if (food.thumbnail) {
        data += `<button class="btn-unset" data-toggle="modal" data-target="#show-food-modal">
                    <img class="img-responsive food-img" src="/storage/${food.thumbnail}"  alt="food img">
                </button>`;
    }

    // after added to cart, its increment decrement button
    if (cart) {
        data += `
        <div
            class="btn add-btn pl-2 pr-2  d-flex justify-content-between add-btn-${
                food.thumbnail ? " with-img" : "no-img"
            }">
            <button onclick="decrement('${cart.rowId}')" class="btn-unset">
                <i class="icofont-minus"></i></button>
            <b> ${cart.qty}</b>
            <button id="${cart.rowId}" foodId="{{$food->id}}" class="btn-unset"
                onclick="increment(event)" hasToppings="${cart.hasToppings}">
                <i class="icofont-plus"></i> </button>
        </div>`;
    } else {
        // food that has toppings, show add toppings modal
        if (food.toppings_count > 0) {
            data += `<button data-toggle="modal" data-target="#customizeModal"
                        class="btn add-btn add-btn-${
                            food.thumbnail ? "with" : "no"
                        }-img" onclick="customize(${food.id})" >Add
                        <sup><i class="icofont-plus"></i></sup>
                    </button>`;
        } else {
            // food that have not any toppings, directly added to cart
            data += `
            <form onsubmit="addToCartForm(event)" class="addToCartForm">
                <input type="hidden" name="restaurant_id" value="${
                    food.restaurant_id
                }">
                <input type="hidden" name="food_id" value="${food.id}">
                <button class="btn addToCart add-btn add-btn-${
                    food.thumbnail ? "with-img" : "no-img"
                }">Add   </button>
            </form>`;
        }
    }

    data += "</div>";
    // if food has no image then show description in full width
    if (!food.thumbnail) {
        data += `<div class="col-12 mt-4px"><small class="text-secondary">${food.description}</small></div>`;
    }

    return data;
}

/**
 * Show Toppings on modal
 */
function customize(foodId) {
    $.ajax({
        url: url(`foods/${foodId}/toppings`),
        method: "GET",
        success: function (res) {
            let data = res.data;
            let foodType =
                data.veg == 1
                    ? `<i class="icofont-ui-press text-success food-item"></i>`
                    : `<i class="icofont-ui-press text-danger food-item"></i>`;

            let toppings = "";
            // loop over toppings
            for (let i = 0; i < data.toppings.length; i++) {
                const element = data.toppings[i];

                toppings += `
                <label class="row topping-label">
                    <div class="col-md-2 d-flex justify-content-around align-items-center  pr-0">
                        <i class="icofont-ui-press food-item text-${
                            element.veg == 1 ? "success" : "danger"
                        }"></i>

                       <input type="checkbox" ${
                           element.status == 0 || element.left_qty < 1
                               ? "disabled"
                               : ""
                       }
                             name="toppings[${element.id}]">
                    </div>

                    <div class="col-md-7 pl-0">
                        <h6 class="topping-name"> ${
                            element.name
                        } </h6><span class="text-secondary">
                            &#8377;${element.price}</span>
                    </div>

                    <div class="col-md-3">
                        <span class="text-secondary">${
                            element.status == 0 || element.left_qty < 1
                                ? "unavailable"
                                : ""
                        }</span>
                    </div>
                </label>`;
            }

            // append to parent
            $("#showToppingsList").html(toppings);
            $("#foodName").html(`${foodType} &nbsp; Customize "${data.name}"`);
            $("#foodPrice").html(`Total &#8377;${data.price}`);
            $("#foodId").val(data.id);
            $("#restaurantId").val(data.restaurant_id);
        },
    });
}

/**
 * Add To Cart
 */
function addToCartForm(e) {
    e.preventDefault();

    let data = new FormData(e.target);

    // set locastorage
    if (!localStorage.getItem("cartRestaurantId")) {
        localStorage.setItem("cartRestaurantId", data.get("restaurant_id"));
    }

    // check if restaurant id is same or not
    if (localStorage.getItem("cartRestaurantId") == data.get("restaurant_id")) {
        addToCart(data);
    } else {
        // show alert
        Swal.fire({
            title: "Already Food in Cart",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Start Fresh",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#customizeModal").modal("hide");
                addToCart(data);
                localStorage.setItem(
                    "cartRestaurantId",
                    data.get("restaurant_id")
                );
            }
        });
    }
}

/**
 * Add to cart request
 */
function addToCart(data) {
    $.ajax({
        url: url("carts"),
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (res) {
            showCart();
            showFoods();
        },
    });
}

/**
 * Show Product in Cart
 */
function showCart() {
    // send ajax request
    $.ajax({
        url: url("carts"),
        method: "get",
        dataType: "json",
        success: function (res) {
            console.log(res);
            let cartItem = "";
            let restaurant =
                res.data.length > 0
                    ? Object.values(res.data)[0].options.restaurant_name
                    : "";

            // append to parent
            $("#cartItems").html(cartItems(res.data));
            $("#cartCount").text(`${res.count} ITEMS`);
            $("#cartRestaurant").text(`From ${restaurant}`);
            $("#cartTotal").html(`&#8377;${res.total}`);
        },
    });
}

showCart();

/**
 * Increment Cart item
 */
function increment(event) {
    // if click on icon get parent
    var btn = $(event.target).is("button")
        ? $(event.target)
        : $(event.target).parent();

    // get all attribute
    let hasToppings = $(btn).attr("hasToppings");
    let foodId = $(btn).attr("foodId");
    let rowId = $(btn).attr("id");

    // check it has toppings or not
    if (hasToppings == 1) {
        Swal.fire({
            title: "Want same customization?",
            showCancelButton: false,
            showDenyButton: true,
            confirmButtonColor: "#3085d6",
            denyButtonColor: "#32a852",
            confirmButtonText: "Customize",
            denyButtonText: `Yes`,
        }).then((result) => {
            if (result.isConfirmed) {
                $("#customizeModal").modal("show");
                customize(foodId);
            } else if (result.isDenied) {
                incrementRequest(rowId);
            }
        });
    } else {
        incrementRequest(rowId);
    }
}

/**
 * Increment Request
 */
function incrementRequest(rowId) {
    let data = new FormData();
    data.append("rowId", rowId);

    // send request
    $.ajax({
        url: url("carts/increment"),
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (res) {
            showCart();
            showFoods();
        },
    });
}

/**
 * Decrement
 */
function decrement(rowId) {
    let data = new FormData();
    data.append("rowId", rowId);

    // send request
    $.ajax({
        url: url("carts/decrement"),
        method: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (res) {
            showCart();
            showFoods();
        },
    });
}
