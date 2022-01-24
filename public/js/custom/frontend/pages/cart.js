/**
 * Add To Cart
 */
function cartItems(data) {
    let cartItem = "";
    // loop over items
    for (let key in data) {
        let element = data[key];

        let customizeText = element.options.hasToppings ? `customize` : "";

        cartItem += `<div class="gold-members p-2 border-bottom">
            <p class="text-gray mb-0 float-right ml-2">&#8377; ${
                element.subtotal
            }</p>
            <span class="count-number float-right">
                <button onclick="decrement('${
                    element.rowId
                }')" class="btn btn-sm left dec"
                     id="${element.rowId}">
                      <i class="icofont-minus"></i>
                 </button>

                <span class="count">${element.qty}</span>

                <button class="btn right inc"  foodId="${element.id}"
                    onclick="increment(event)"
                    hasToppings="${element.options.hasToppings ? 1 : 0}"
                    id="${element.rowId}">
                    <i class="icofont-plus"></i>
                </button>
            </span>
            <div class="media">
                <div class="mr-2"><i class="icofont-ui-press text-${
                    element.options.veg == 1 ? "success" : "danger"
                } food-item"></i></div>
                <div class="media-body">
                    <p class="mt-1 mb-0 text-black">${element.name}
                        <sup class="text-secondary">${customizeText}</sup
                    </p>
                </div>
            </div>
        </div>`;
    }

    return cartItem;
}


function miniCart()
{
    
}
