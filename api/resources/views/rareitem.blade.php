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
        <div class="card mdb-color text-center text-white bg-info">
          <img src="https://cdn.shopify.com/s/files/1/2290/7887/products/F0141109603_3_1024x1024.jpg?v=1658733465" />
          <div class="card-body">
            <p id="item1" onclick="addToCart1(this.id)" class="white-text mb-0">Denim Jeans</p>
          </div>
        </div>
        <p id="amount1" class="text-center mt-1">£20</p>
      </div>
      <div class="col-md-3">
        <div class="card mdb-color text-center text-white bg-warning">
          <img
            src="https://www.armani.com/content/images/cms/ycm/resource/blob/588260/a423893d00f9e2f89b49c6fbfa19e47e/made-to-measure-1-column-data.jpg/w1920.jpg" />
          <div class="card-body">
            <p id="item2" onclick="addToCart2(this.id)" class="white-text mb-0">Armani Suit</p>
          </div>
        </div>
        <p id="amount2" class="text-center mt-1">£20</p>
      </div>
      <div class="col-md-3">
        <div class="card text-center text-white bg-primary">
          <img
            src="https://doncarlosshoes.co.uk/image/cache/catalog/shoes/models/fausto/fausto-design-height-increasing-shoes-1-1000x667.JPG" />
          <div class="card-body">
            <p id="item3" onclick="addToCart3(this.id)" class="white-text mb-0">Don Carlos Shoes</p>
          </div>
        </div>
        <p id="amount3" class="text-center mt-1">£20</p>
      </div>
      <div class="col-md-3">
        <div class="card text-center text-white bg-success">
          <img src="https://static-01.daraz.pk/p/b09bdbcdf177602483b4ce6d8b0aa8d6.jpg" />
          <div class="card-body">
            <p id="item4" onclick="addToCart4(this.id)" class="white-text mb-0">Leather Jacket</p>
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
      <label class="border border-success ml-5" style="float: right" class="mr-5">Add to cart</button>
    </div>
    <div>
</body>

<script type="text/javascript">
  function addToCart1(id)
  {
    item =document.getElementById("item1").innerHTML;
    
    amount =document.getElementById("amount1").innerHTML;
        
    let data = {
      name: item,
      price: amount.slice(1,3)
    }

    let json = JSON.stringify(data);

    const api = "http://127.0.0.1:8000/api/super-item"

    let xhr = new XMLHttpRequest();

    xhr.open('POST', api, true)
    xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
    xhr.send(json);

     
    xhr.onload = function () {
    if(xhr.status === 201) {
        alert("successfully sent") 
    }
    if(xhr.status === 500) {
        alert("API error") 
    }
  }
}

  function addToCart2(id)
  {
    item =document.getElementById("item2").innerHTML;
    
    amount =document.getElementById("amount2").innerHTML;
        
    let data = {
      name: item,
      price: amount.slice(1,3)
    }

    let json = JSON.stringify(data);

    const api = "http://127.0.0.1:8000/api/super-item"

    let xhr = new XMLHttpRequest();

    xhr.open('POST', api, true)
    xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
    xhr.send(json);

     
    xhr.onload = function () {
    if(xhr.status === 201) {
        alert("successfully sent") 
    }
    if(xhr.status === 500) {
        alert("API error") 
    }
  }}

  function addToCart3(id)
  {
    item =document.getElementById("item3").innerHTML;
    
    amount =document.getElementById("amount3").innerHTML;
    
    let data = {
      name: item,
      price: amount.slice(1,3)
    }

    let json = JSON.stringify(data);

    const api = "http://127.0.0.1:8000/api/super-item"

    let xhr = new XMLHttpRequest();

    xhr.open('POST', api, true)
    xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
    xhr.send(json);

     
    xhr.onload = function () {
    if(xhr.status === 201) {
        alert("successfully sent") 
    }
    if(xhr.status === 500) {
        alert("API error") 
    }
  }}

  function addToCart4(id)
  {
    item =document.getElementById("item4").innerHTML;
    
    amount =document.getElementById("amount4").innerHTML;

    let data = {
      name: item,
      price: amount.slice(1,3)
    }

    let json = JSON.stringify(data);

    const api = "http://127.0.0.1:8000/api/super-item"

    let xhr = new XMLHttpRequest();

    xhr.open('POST', api, true)
    xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
    xhr.send(json);

     
xhr.onload = function () {
    if(xhr.status === 201) {
        alert("successfully sent") 
    }
    if(xhr.status === 500) {
        alert("API error") 
    }
    }}

</script>

</html>