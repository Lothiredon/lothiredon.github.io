class ShoppingCart {
  constructor(name, price, count) {
    this.cart = [];
    this.name = name;
    this.price = price;
    this.count = count;
    if (sessionStorage.getItem("shoppingCart")) loadCart();
  }

  saveCart() {
    // Save cart objects
    sessionStorage.setItem("shoppingCart", JSON.stringify(cart));
  }

  loadCart() {
    // Load cart objects
    cart = JSON.parse(sessionStorage.getItem("shoppingCart"));
  }

  // Add to cart
  addItemToCart(name, price, count) {
    for (var item in cart) {
      if (cart[item].name === name) {
        cart[item].count++;
        saveCart();
        return;
      }
    }
    var item = new Item(name, price, count);
    cart.push(item);
    saveCart();
  }

  // Set count from item
  setCountForItem(name, count) {
    for (var i in cart) {
      if (cart[i].name === name) {
        cart[i].count = count;
        break;
      }
    }
  }
  // Remove item from cart
  removeItemFromCart(name) {
    for (var item in cart) {
      if (cart[item].name === name) {
        cart[item].count--;
        if (cart[item].count === 0) {
          cart.splice(item, 1);
        }
        break;
      }
    }
    saveCart();
  }

  // Remove all items from cart
  removeItemFromCartAll(name) {
    for (var item in cart) {
      if (cart[item].name === name) {
        cart.splice(item, 1);
        break;
      }
    }
    saveCart();
  }

  // Clear cart
  clearCart() {
    cart = [];
    saveCart();
  }

  // Count cart
  totalCount() {
    var totalCount = 0;
    for (var item in cart) {
      totalCount += cart[item].count;
    }
    return totalCount;
  }

  // Total cart
  totalCart() {
    var totalCart = 0;
    for (var item in cart) {
      totalCart += cart[item].price * cart[item].count;
    }
    return Number(totalCart.toFixed(2));
  }

  // List cart
  listCart() {
    var cartCopy = [];
    for (var i = 0; i < cart.length; i++) {
      item = cart[i];
      itemCopy = {};
      for (p in item) {
        itemCopy[p] = item[p];
      }
      itemCopy.total = Number(item.price * item.count).toFixed(2);
      cartCopy.push(itemCopy);
    }
  }
}
