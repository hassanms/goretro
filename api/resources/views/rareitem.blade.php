<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GoRetro Super Rare Items</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid">
    <div class="row mt-5 mx-auto">
      <div class="col-md-3">
        <div id="card1" class="card mdb-color text-center text-white bg-info">
          <img src="https://cdn.shopify.com/s/files/1/2290/7887/products/F0141109603_3_1024x1024.jpg?v=1658733465" />
          <div class="card-body">
            <p id="item1" class="white-text mb-0">Denim Jeans</p>
          </div>
        </div>
        <p id="amount1" class="text-center mt-1">£20</p>
      </div>
      <div class="col-md-3">
        <div id="card2" class="card mdb-color text-center text-white bg-warning">
          <img
            src="https://www.armani.com/content/images/cms/ycm/resource/blob/588260/a423893d00f9e2f89b49c6fbfa19e47e/made-to-measure-1-column-data.jpg/w1920.jpg" />
          <div class="card-body">
            <p id="item2" class="white-text mb-0">Armani Suit</p>
          </div>
        </div>
        <p id="amount2" class="text-center mt-1">£20</p>
      </div>
      <div class="col-md-3">
        <div id="card3" class="card text-center text-white bg-primary">
          <img
            src="https://doncarlosshoes.co.uk/image/cache/catalog/shoes/models/fausto/fausto-design-height-increasing-shoes-1-1000x667.JPG" />
          <div class="card-body">
            <p id="item3" class="white-text mb-0">Don Carlos Shoes</p>
          </div>
        </div>
        <p id="amount3" class="text-center mt-1">£20</p>
      </div>
      <div class="col-md-3">
        <div id="card4" class="card text-center text-white bg-success">
          <img src="https://static-01.daraz.pk/p/b09bdbcdf177602483b4ce6d8b0aa8d6.jpg" />
          <div class="card-body">
            <p id="item4" class="white-text mb-0">Leather Jacket</p>
          </div>
        </div>
        <p id="amount4" class="text-center mt-1">£20</p>
      </div>
    </div>
  </div>
  <div style="width: 70%" class="mx-auto">
    <div class="container-fluid text-center mt-5">
      Because you have over £1000 in your basket you get to choose from a super rare item<br />
      Please choose from one of these 4 Super Rare Items.
      <br /><br />
      Please note if your basket drops below this figure the super rare item will also be removed.
    </div>
    <div class="container-fluid mt-5">
      <span class="border border-success ml-5">No thanks</span>
      <button onclick="addToCart()" style="float: right" class="mr-5">Add to cart</button>
    </div>
    <div>
</body>

<script>
  $(document).ready(function(){
    $("#card1").click(function{

    });
  });

  function addToCart()
  {
      alert("Added Suucessfully")
  }

</script>

</html>