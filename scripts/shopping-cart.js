class ShoppingCart {
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
    for (var item in this.cart) {
      if (this.cart[item].name === name) {
        this.cart[item].count++;
        this.saveCart();
        return;
      }
    }
    var item = new Item(name, price, count);
    this.cart.push(item);
    this.saveCart();
  }

  // Set count from item
  setCountForItem(name, count) {
    for (var i in this.cart) {
      if (this.cart[i].name === name) {
        this.cart[i].count = count;
        break;
      }
    }
  }
  // Remove item from cart
  removeItemFromCart(name) {
    for (var item in this.cart) {
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
    for (var item in this.cart) {
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
    var totalCount = 0;
    for (var item in this.cart) {
      totalCount += this.cart[item].count;
    }
    return totalCount;
  }

  // Total cart
  totalCart() {
    var totalCart = 0;
    for (var item in this.cart) {
      totalCart += this.cart[item].price * this.cart[item].count;
    }
    return Number(totalCart.toFixed(2));
  }

  // List cart
  listCart() {
    var cartCopy = [];
    for (var i = 0; i < this.cart.length; i++) {
      let item = this.cart[i];
      let itemCopy = {};
      for (let p in item) {
        itemCopy[p] = item[p];
      }
      itemCopy.total = Number(item.price * item.count).toFixed(2);
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
$(".add-to-cart").click(function (event) {
  event.preventDefault();
  var name = $(this).data("name");
  var price = Number($(this).data("price"));
  shoppingCart.addItemToCart(name, price, 1);
  displayCart();
});

// Clear items
$(".clear-cart").click(function () {
  shoppingCart.clearCart();
  displayCart();
});

// Delete item button
$(".show-cart").on("click", ".delete-item", function (event) {
  var name = $(this).data("name");
  shoppingCart.removeItemFromCartAll(name);
  displayCart();
});

// -1
$(".show-cart").on("click", ".minus-item", function (event) {
  var name = $(this).data("name");
  shoppingCart.removeItemFromCart(name);
  displayCart();
});

// +1
$(".show-cart").on("click", ".plus-item", function (event) {
  var name = $(this).data("name");
  shoppingCart.addItemToCart(name);
  displayCart();
});

// Item count input
$(".show-cart").on("change", ".item-count", function (event) {
  var name = $(this).data("name");
  var count = Number($(this).val());
  shoppingCart.setCountForItem(name, count);
  displayCart();
});

// Display items
var displayCart = function () {
  var cartArray = shoppingCart.listCart();
  var output = "";
  for (var i in cartArray) {
    output +=
      "<tr>" +
      "<td class='cart-item-title'>" +
      cartArray[i].name +
      "</td>" +
      "<td class='cart-item-cost'>(" +
      cartArray[i].price +
      ")</td>" +
      "<td><div class='cart-item-quantity'><button class='minus-item' data-name=" +
      cartArray[i].name +
      ">-</button>" +
      "<input type='number' class='item-count' data-name='" +
      cartArray[i].name +
      "' value='" +
      cartArray[i].count +
      "'>" +
      "<button class='plus-item' data-name=" +
      cartArray[i].name +
      ">+</button></div></td>" +
      "<td><button class='delete-item' data-name=" +
      cartArray[i].name +
      ">&times;</button></td>" +
      "<td class='cart-item-total'>" +
      cartArray[i].total +
      "</td>" +
      "</tr>";
  }
  $(".show-cart").html(output);
  $(".total-cart").html(shoppingCart.totalCart());
  $(".total-count").html(shoppingCart.totalCount());
};

// Call display cart function
displayCart();
