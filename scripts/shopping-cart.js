class ShoppingCart {

  // Constructor
  constructor() {
    this.cart = [];
    if (sessionStorage.getItem("shoppingCart")) this.loadCart();
  }

  saveCart() {
    // Save cart objects
    sessionStorage.setItem("shoppingCart", JSON.stringify(this.cart));
  }

  loadCart() {
    // Load cart objects
    this.cart = JSON.parse(sessionStorage.getItem("shoppingCart"));
  }

  // Add to cart
  addItemToCart(name, price, count) {
    for (const item of this.cart) {
      if (item.name === name) {
        item.count++;
        this.saveCart();
        return;
      }
    }
    this.cart.push(new Item(name, price, count));
    this.saveCart();
  }

  // Set count from item
  setCountForItem(name, count) {
    for (const i in this.cart) {
      if (this.cart[i].name === name) {
        this.cart[i].count = count;
        break;
      }
    }
  }

  // Remove item from cart
  removeItemFromCart(name) {
    for (const item in this.cart) {
      if (this.cart[item].name === name) {
        this.cart[item].count--;
        if (this.cart[item].count === 0) {
          this.cart.splice(item, 1);
        }
        break;
      }
    }
    this.saveCart();
  }

  // Remove all items from cart
  removeItemFromCartAll(name) {
    for (const item in this.cart) {
      if (this.cart[item].name === name) {
        this.cart.splice(item, 1);
        break;
      }
    }
    this.saveCart();
  }

  // Clear cart
  clearCart() {
    this.cart = [];
    this.saveCart();
  }

  // Count cart
  totalCount() {
    let totalCount = 0;
    for (const item of this.cart) {
      totalCount += item.count;
    }
    return totalCount;
  }

  // Total cart
  totalCart() {
    let totalCart = 0;
    for (const item of this.cart) {
      totalCart += item.price * item.count;
    }
    return Number(totalCart);
  }

  // List cart
  listCart() {
    const cartCopy = [];
    for (const item of this.cart) {
      let itemCopy = {};
      for (let p in item) {
        itemCopy[p] = item[p];
      }
      itemCopy.total = Number(item.price * item.count);
      cartCopy.push(itemCopy);
    }
    return cartCopy;
  }
}

class Item {
  constructor(name, price, count) {
    this.name = name;
    this.price = price;
    this.count = count;
  }
}

// Create new cart instance
const shoppingCart = new ShoppingCart();

// *****************************************
// Triggers / Events
// *****************************************

// Add item
$(".add-to-cart").click((event) => {
  event.preventDefault();
  shoppingCart.addItemToCart(event.target.dataset["name"], Number(event.target.dataset["price"]), 1);
  displayCart();
});

// Clear items
$(".clear-cart").click(() => {
  shoppingCart.clearCart();
  displayCart();
});

// Delete item button
$(".show-cart").on("click", ".delete-item", (event) => {
  shoppingCart.removeItemFromCartAll(event.target.dataset["name"]);
  displayCart();
});

// -1
$(".show-cart").on("click", ".minus-item", (event) => {
  shoppingCart.removeItemFromCart(event.target.dataset["name"]);
  displayCart();
});

// +1
$(".show-cart").on("click", ".plus-item", (event) => {
  shoppingCart.addItemToCart(event.target.dataset["name"]);
  displayCart();
});

// Item count input
$(".show-cart").on("change", ".item-count", (event) => {
  shoppingCart.setCountForItem(event.target.dataset["name"], Number(event.target.value));
  displayCart();
});

// Display items
function displayCart() {
  let output = "";
  for (const item of shoppingCart.listCart()) {
    output +=
      "<tr>" +
      "<td class='cart-item-title'>" +
      item.name +
      "</td>" +
      "<td class='cart-item-cost'>" +
      item.price.toFixed(2) +
      "</td>" +
      "<td><div class='cart-item-quantity'><button class='minus-item' data-name='" +
      item.name +
      "'>-</button>" +
      "<input type='number' class='item-count' data-name='" +
      item.name +
      "' value='" +
      item.count +
      "'>" +
      "<button class='plus-item' data-name='" +
      item.name +
      "'>+</button></div></td>" +
      "<td><button class='delete-item' data-name='" +
      item.name +
      "'>&times;</button></td>" +
      "<td class='cart-item-total'>" +
      item.total.toFixed(2) +
      "</td>" +
      "</tr>";
  }
  $(".show-cart").html(output);
  $(".total-cart").html(shoppingCart.totalCart());
  $(".total-count").html(shoppingCart.totalCount());
};

// Call display cart function
displayCart();
