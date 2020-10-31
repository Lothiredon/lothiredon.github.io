<?php
// Prevent direct access to file
defined('shoppingcart') or exit;
// Get the 4 most recent added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Shop - Realm of Lothiredon')?>

<head>
	<script src="https://kit.fontawesome.com/1c0a337638.js" crossorigin="anonymous"></script>
	<link href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
	<script src="../scripts/ResizeSensor.js"></script>
	<script src="../scripts/ElementQueries.js"></script>
	<!--<script src="https://github.com/kswedberg/jquery-smooth-scroll/blob/master/jquery.smooth-scroll.min.js"></script>-->
	<!-- SMOOTH SCROLL -->
	<script>
		$(function() {
			// Select all links with hashes
			$('a[href*="#"]')
			// Remove links that don't actually link to anything
			.not('[href="#"]')
			.not('[href="#0"]')
			.click(function(event) {
				// On-page links
				if (
				location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
				&& 
				location.hostname == this.hostname
				) {
				// Figure out element to scroll to
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				// Does a scroll target exist?
				if (target.length) {
					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
					$('html, body').animate({
					scrollTop: target.offset().top
					}, 1000, function() {
					// Callback after animation
					// Must change focus!
					var $target = $(target);
					$target.focus();
					if ($target.is(":focus")) { // Checking if the target was focused
						return false;
					} else {
						$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
						$target.focus(); // Set focus again
					};
					});
				}
				}
			});
		});
	</script>
	<!-- End of SMOOTH SCROLL -->
	
	<!--Start menu active thing-->
	<script>
		$(document).ready(function() {
			$("ul.menu li a").click(function() {
				$("ul.menu li a").removeClass("menuactive"); //This is important to make only one link active at a time
				// Try without using above line and note the difference

				$(this).addClass("active"); // Add 'active' class to currently clicked element
			});    
		});
    </script>
	<!--End menu active-->
	
	<script>
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();
			var os = $('.section1').offset().top-100;
			var ht = $('.section1').height();
			if(scroll > os + ht){
				$('.menu').addClass('past-main');
			} else {
				$('.menu').removeClass('past-main');
			}

		});
	</script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Lothiredon, Minecraft, Realm of Lothiredon, Creative Server, Minecraft Server">

	<title>Realm of Lothiredon</title>
	<link rel="icon" href="../favicon.ico" type="image/gif" sizes="32x32">
	<link rel="stylesheet" href="stylesheet.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
</head>

<body>

<!--=========================================================-->
<!--=                       SECTION 1                       =-->
<!--=========================================================-->

	<!--=========MENU START=========-->
	<div name="top" class="section1">
		<a id="sec1" class="smooth"></a>

			<!--<div class="menudiv" id="menudiv">
				<ul class="menu">
					<div class="menu-link-wrapper">	
						<li id="menubutton1"><a href="../home/index.html">HOME</a></li>
						<li id="menubutton2"><a href="../commissions/commissions.html">COMMISSIONS</a></li>
						<li id="menubutton3"><a href="../about/about.hmtl">ABOUT</a></li>
						<li id="menubutton4"><a href="../contact/contact.html">CONTACT</a></li>
						<li id="menubutton5"><a href="" class="active">STORE</a></li>
					</div>
					<figure class="shopping-cart" id="shopping-cart">
						<object type="image/svg+xml" data="../img/shopping-cart.svg"></object>
					</figure>
				</ul>
			</div>-->
	<!--=========MENU END=========-->


	<!--=========CURTAIN START=========-->
		<!-- The overlay -->
		<div id="cart-curtain" class="overlay">

			<!-- Button to close the overlay navigation -->
			<div class="cart-header">
				<!--Shopping cart title-->
				<div class="cart-header-wrapper">
					<h1 id="shopping-cart-header">SHOPPING CART</h1>
				</div>

				<!--Close button X-->
				<figure class="closebtn">
					<object type="image/svg+xml" data="../img/cross.svg"></object>
				</figure>
			</div>
			
				<!-- Overlay content -->
			<div class="overlay-content">
				<table class="cart-item-list show-cart table">

					<!--List item
					<li class=cart-item>
						<div class=cart-item-img-wrapper>
							<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature1.jpg">
						</div>
						<div class="cart-item-text-wrapper">	
							<p class="cart-item-title">Test item</p>
							<p class="cart-item-cost">$cost</p>

							<div class="cart-item-quantity">
								<figure class="cart-item-icon plus">
									<object type="image/svg+xml" data="../img/plus.svg"></object>
								</figure>
								<p>8</p>
								<figure class="cart-item-icon minus">
									<object type="image/svg+xml" data="../img/minus.svg"></object>
								</figure>
							</div>
						</div>
					</li>-->

				</table>
			</div>
		</div>
		<!--=========CURTAIN END=========-->
				
			<div class="hero-wrapper">
				<div class="hero-text-wrapper">
					<h1>HIGH QUALITY CONTENT, JUST FOR YOU.</h1>
					<p>FROM TERRAIN TO HUBS TO MINIGAMES, WE'VE GOT IT.</p>
				</div>
			</div>
		</div>
<!--=========================================================-->
<!--=                       SECTION 2                       =-->
<!--=========================================================-->
	
<div class="section2">
	<a id="sec2" class="smooth"></a>

	<div class="recentlyadded content-wrapper">
		<h2>Recently Added Products</h2>
		<div class="products">
			<?php foreach ($recently_added_products as $product): ?>
			<a href="index.php?page=product&id=<?=$product['id']?>" class="product">
				<?php if (!empty($product['img']) && file_exists('imgs/' . $product['img'])): ?>
				<img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
				<?php endif; ?>
				<span class="name"><?=$product['name']?></span>
				<span class="price">
					<?=currency_code?><?=number_format($product['price'],2)?>
					<?php if ($product['rrp'] > 0): ?>
					<span class="rrp"><?=currency_code?><?=number_format($product['rrp'],2)?></span>
					<?php endif; ?>
				</span>
			</a>
			<?php endforeach; ?>
		</div>
	</div>

	<section class="gallery">
		<!--<div class="container">
		<div class="toolbar">

			<div class="search-wrapper">
				<input type="search" placeholder="Search for products">
				<div class="counter">
					Total products: <span>12</span>
				</div>
			</div>

			<ul class="view-options">
				<li class="zoom">
					<input type="range" min="200" max="400" value="300" class="range blue">
				</li>
				<li class="show-grid active">
					<button disabled>
					<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/grid-view.svg" alt="grid view">  
					</button>
				</li>
				<li class="show-list">
					<button>
					<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/list-view.svg" alt="list view">  
					</button>
				</li>
			</ul>

		</div>-->

		<!--===========================-->
		<!--=     Grid view start     =-->
		<!--===========================-->

		<!--<ol class="image-list grid-view">

			<li>
				<figure>
					<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature1.jpg" alt="">
					<div class="figcaption-wrapper">
						<figcaption>
							<p>Product #</p>
							<p>Product # description</a></p>
							<p class="product-cost">$10.00</p>
							<div class="add-to-cart-wrapper">
								<a href="#" data-name="Testmap 1" data-price="10.00" class="add-to-cart">Purchase</a>
							</div>
						</figcaption>
					</div>
				</figure>
			</li>

			<li>
				<figure>
					<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature1.jpg" alt="">
					<div class="figcaption-wrapper">
						<figcaption>
							<p>Product #</p>
							<p>Product # description</a></p>
							<p class="product-cost">$10.00</p>
							<div class="add-to-cart-wrapper">
								<a href="#" data-name="Testmap 1" data-price="10.00" class="add-to-cart">Purchase</a>
							</div>
						</figcaption>
					</div>
				</figure>
			</li>

			<li>
				<figure>
					<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature1.jpg" alt="">
					<div class="figcaption-wrapper">
						<figcaption>
							<p>Product #</p>
							<p>Product # description</a></p>
							<p class="product-cost">$10.00</p>
							<div class="add-to-cart-wrapper">
								<a href="#" data-name="Testmap 1" data-price="10.00" class="add-to-cart">Purchase</a>
							</div>
						</figcaption>
					</div>
				</figure>
			</li>

			<li>
				<figure>
					<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature1.jpg" alt="">
					<div class="figcaption-wrapper">
						<figcaption>
							<p>Product #</p>
							<p>Product # description</a></p>
							<p class="product-cost">$10.00</p>
							<div class="add-to-cart-wrapper">
								<a href="#" data-name="Testmap 1" data-price="10.00" class="add-to-cart">Purchase</a>
							</div>
						</figcaption>
					</div>
				</figure>
			</li>

			<li>
				<figure>
					<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature1.jpg" alt="">
					<div class="figcaption-wrapper">
						<figcaption>
							<p>Product #</p>
							<p>Product # description</a></p>
							<p class="product-cost">$10.00</p>
							<div class="add-to-cart-wrapper">
								<a href="#" data-name="Testmap 1" data-price="10.00" class="add-to-cart">Purchase</a>
							</div>
						</figcaption>
					</div>
				</figure>
			</li>

			<li>
				<figure>
					<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature1.jpg" alt="">
					<div class="figcaption-wrapper">
						<figcaption>
							<p>Product #</p>
							<p>Product # description</a></p>
							<p class="product-cost">$10.00</p>
							<div class="add-to-cart-wrapper">
								<a href="#" data-name="Testmap 1" data-price="10.00" class="add-to-cart">Purchase</a>
							</div>
						</figcaption>
					</div>
				</figure>
			</li>

			<li>
				<figure>
					<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature1.jpg" alt="">
					<div class="figcaption-wrapper">
						<figcaption>
							<p>Product #</p>
							<p>Product # description</a></p>
							<p class="product-cost">$10.00</p>
							<div class="add-to-cart-wrapper">
								<a href="#" data-name="Testmap 1" data-price="10.00" class="add-to-cart">Purchase</a>
							</div>
						</figcaption>
					</div>
				</figure>
			</li>

			<li>
				<figure>
					<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature1.jpg" alt="">
					<div class="figcaption-wrapper">
						<figcaption>
							<p>Product #</p>
							<p>Product # description</a></p>
							<p class="product-cost">$10.00</p>
							<div class="add-to-cart-wrapper">
								<a href="#" data-name="Testmap 1" data-price="10.00" class="add-to-cart">Purchase</a>
							</div>
						</figcaption>
					</div>
				</figure>
			</li>

		</ol>-->

		<?php
		// Prevent direct access to file
		defined('shoppingcart') or exit;
		// Get all the categories from the database
		$stmt = $pdo->query('SELECT * FROM categories');
		$stmt->execute();
		$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Get the current category from the GET request, if none exists set the default selected category to: all
		$category = isset($_GET['category']) ? $_GET['category'] : 'all';
		$category_sql = '';
		if ($category != 'all') {
			$category_sql = 'JOIN products_categories pc ON pc.category_id = :category_id AND pc.product_id = p.id JOIN categories c ON c.id = pc.category_id';
		}
		// Get the sort from GET request, will occur if the user changes an item in the select box
		$sort = isset($_GET['sort']) ? $_GET['sort'] : 'sort3';
		// The amounts of products to show on each page
		$num_products_on_each_page = 8;
		// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
		$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
		// Select products ordered by the date added
		if ($sort == 'sort1') {
			// sort1 = Alphabetical A-Z
			$stmt = $pdo->prepare('SELECT p.* FROM products p ' . $category_sql . ' ORDER BY p.name ASC LIMIT :page,:num_products');
		} elseif ($sort == 'sort2') {
			// sort2 = Alphabetical Z-A
			$stmt = $pdo->prepare('SELECT p.* FROM products p ' . $category_sql . ' ORDER BY p.name DESC LIMIT :page,:num_products');
		} elseif ($sort == 'sort3') {
			// sort3 = Newest
			$stmt = $pdo->prepare('SELECT p.* FROM products p ' . $category_sql . ' ORDER BY p.date_added DESC LIMIT :page,:num_products');
		} elseif ($sort == 'sort4') {
			// sort4 = Oldest
			$stmt = $pdo->prepare('SELECT p.* FROM products p ' . $category_sql . ' ORDER BY p.date_added ASC LIMIT :page,:num_products');
		} else {
			// No sort was specified, get the products with no sorting
			$stmt = $pdo->prepare('SELECT p.* FROM products p ' . $category_sql . ' LIMIT :page,:num_products');
		}
		// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
		if ($category != 'all') {
			$stmt->bindValue(':category_id', $category, PDO::PARAM_INT);
		}
		$stmt->bindValue(':page', ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
		$stmt->bindValue(':num_products', $num_products_on_each_page, PDO::PARAM_INT);
		$stmt->execute();
		// Fetch the products from the database and return the result as an Array
		$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Get the total number of products
		$stmt = $pdo->prepare('SELECT COUNT(*) FROM products p ' . $category_sql);
		if ($category != 'all') {
			$stmt->bindValue(':category_id', $category, PDO::PARAM_INT);
		}
		$stmt->execute();
		$total_products = $stmt->fetchColumn()
		?>

		<div class="products content-wrapper">

			<h1>Products</h1>

			<div class="products-header">
				<p><?=$total_products?> Products</p>
				<form action="" method="get" class="products-form">
					<input type="hidden" name="page" value="products">
					<label class="category">
						Category
						<select name="category">
							<option value="all"<?=($category == 'all' ? ' selected' : '')?>>All</option>
							<?php foreach ($categories as $c): ?>
							<option value="<?=$c['id']?>"<?=($category == $c['id'] ? ' selected' : '')?>><?=$c['name']?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<label class="sortby">
						Sort by
						<select name="sort">
							<option value="sort1"<?=($sort == 'sort1' ? ' selected' : '')?>>Alphabetical A-Z</option>
							<option value="sort2"<?=($sort == 'sort2' ? ' selected' : '')?>>Alphabetical Z-A</option>
							<option value="sort3"<?=($sort == 'sort3' ? ' selected' : '')?>>Newest</option>
							<option value="sort4"<?=($sort == 'sort4' ? ' selected' : '')?>>Oldest</option>
						</select>
					</label>
				</form>
			</div>

			<div class="products-wrapper">
				<?php foreach ($products as $product): ?>
				<a href="index.php?page=product&id=<?=$product['id']?>" class="product">
					<?php if (!empty($product['img']) && file_exists('imgs/' . $product['img'])): ?>
					<img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
					<?php endif; ?>
					<span class="name"><?=$product['name']?></span>
					<span class="price">
						<?=currency_code?><?=number_format($product['price'],2)?>
						<?php if ($product['rrp'] > 0): ?>
						<span class="rrp"><?=currency_code?><?=number_format($product['rrp'],2)?></span>
						<?php endif; ?>
					</span>
				</a>
				<?php endforeach; ?>
			</div>

			<div class="buttons">
				<?php if ($current_page > 1): ?>
				<a href="index.php?page=products&p=<?=$current_page-1?>&category=<?=$category?>&sort=<?=$sort?>">Prev</a>
				<?php endif; ?>
				<?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
				<a href="index.php?page=products&p=<?=$current_page+1?>&category=<?=$category?>&sort=<?=$sort?>">Next</a>
				<?php endif; ?>
			</div>

		</div>

		<!--===========================-->
		<!--=      Grid view end      =-->
		<!--===========================-->

		</div>
	</section>

</div>
<!--Grid script implement-->

<?=template_footer()?>