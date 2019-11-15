# Lavie
TARGET							
"- Build a website allow Sellers register their profile, manage their agencies and products.
- Responsive for small devices (mobile/tablet)"							
GIT FLOW							
"Setting up 2 branches
- master - For deploying production
- development - For handling new features"							
REQUIREMENTS							
"1. Sign Up page for Seller. (URL: /signup)
Seller need to fill all required fields
 - Full name
 - Email (for signing in)
 - Password (minimum 8 character, include letters and numbers)
 - Confirm password (must be same Password)
 - Phone number (maximum 16 characters)
"							
"2. Sign In page (URL: /signin)
 - Seller need to fill correct email and password to sign in
"							
"4. Agency page (URL: /seller/agency)
 - Seller can manage their agencies at this page. Seller need to fill required fields for adding/editing an agency:
    + Agency name
    + Agency address
    + Agency image (multiple images)
 - Displaying list of agencies - We must set 2 buttons, which allows Seller Edit or Remove their agency
"							
"5. Product page (URL: /seller/product)
 - After signed in, Seller must be redirected to Dashboard page.
 - In this page we must have:
    + ""Add product"" button
    + All products should be display 3 items in a row. If seller does not have any products, we would like to show text ""You do not have any products"".
    + Pagination - Maximum for each page is 12 products
 - Adding product: Seller need to fill all required fields and upload images for product (URL: /seller/product/new)
    + Product name (maximum 127 characters)
    + Base price (in USD)
    + Product images (allow seller selects only image types, support multiple images)
    + Category: Select one or multiple categories from the list ()
    + Seller can set Discount rate & Quantity for each agency
 - Displaying product items - A product item displays information below:
    + The first image
    + Product name
    + Lowest of real price from all agency (Real price = Base price - Base price * (Discount rate / 100))
    + An edit button - Seller can edit all information as creating
    + A remove button
"							
"6. Home page (URL: /)

This page must have 5 basic sections:
 - Header
 - Products
 - Best Sales
 - Footer

* HEADER
* PRODUCTS
 - Layout:
    + For desktop, display 4 products per row.
    + For tablet and large mobile devices: display 3 products per row
    + For medium mobile devices: display 2 products per row
    + For small mobile devices: display 1 product per row
    + Filter form must have expansible in mobile device
 - I want to place a Filter form at the top of this section. It must have:
    + Filter by Price range (at least 5 ranges)
    + Filter by Seller
    + Have a select box for choosing order by Price (Real price) (Ascending or Descending)
 - Display all products from system. If have same products from agencies, display product with lowest real price.
 - Each product displays at least. Image, Base Price, Name. If a product have Discount rate, display Discount rate and Real price also.
 - If quantity of product is 0 at all agencies, the product will show ""Out of store"".
 - Have paginator at the bottom, with maximum 12 products per page.
* BEST SALES
 - Display top 12 products have highest Discount rate from system."							
"7. Product Details (URL: /products/{slug}/{productId})

* This page will display all properties of product, includes images, name, description, prices, etc.

* In term of layout, this page should be separate to 2 main columns (9/3 follow Bootstrap grid).
- First column:
  + Support displaying all images of product with a carousel.
  + Support zooming each images of product in the carousel.
  + Display name, seller name, description, real price and discount rate of product.
- Second column: Must have 2 sub-sections. Each sections can scrollable, max height is 80% of screen height
  + Related products: Show 20 another products which have same categories. (except the product users are viewing)
  + Seller products: Show 20 another products of current seller. (except the product users are viewing)

* We must to support a way for searching by Google. The first is optimizing URL. So:
- On creating/editing product: Must have a way to generate and save slug from product name.
"							
"8. Cart page (URL: /cart)

* Place ""Cart"" icon to the header. By clicking to this icon, user will be redirected to ""Cart"" page

* Once a product have been added to cart, we must have a badge at the top right of ""Cart"" icon.
- If the cart have more than 9 product: Display 9+
- If the cart is empty: The badge should be hidden
- Adding product to cart should not make browser refreshing. The badge should be update immediately.

* This page must show all products which were being added by buyer.
- Allow buyer edit quantity of each products, remove product from cart.
- Price estimation
  + Calculating Total price of all products.
  + Calculating Delivery cost:
     ++ With total price from $0.1 to $20: 10% of Total price
     ++ With total price from $20 to $50: 5% of Total price
     ++ With total price larger $50: Free
- Button [Clear Cart]: Clear all products from cart.
- Button [Continue Payment]
  + If buyer signed in: Redirect to ""Payment page""
  + If buyer did not sign in: Redirect to ""Buyer Signing in""
    "							
"9. Signing In for Buyer (URL: buyer/signin)
* Support sign in with Google & Facebook"							
"10. Payment page for Buyer (URL: buyer/payment)
