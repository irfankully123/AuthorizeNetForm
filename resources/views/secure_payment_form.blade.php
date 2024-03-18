<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.usebootstrap.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: aliceblue;
        }

        .container {
            max-width: 960px;
        }

        .lh-condensed {
            line-height: 1.25;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <title>Payment Form</title>
</head>
<body>
<div>
    <img src="{{asset('images/mediumsmall.png')}}" alt="" width="200" height="150">
</div>
<div class="container">
    <div class=" text-center">
        <img class="d-block mx-auto mb-4"
             src="https://seeklogo.com/images/A/authorize-net-logo-7F5F4ADCBB-seeklogo.com.png" alt="" width="200"
             height="150">
        <h2>Checkout form</h2>
        <p class="lead">Please Enter Your Card Details Below</p>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Product Detail</span>

            </h4>
            <ul class="list-group mb-3 sticky-top">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Item</h6>
                        <small id="item" class="text-muted"> </small>
                    </div>
                    <span id="price" class="text-muted"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Description</h6>
                        <small id="description" class="text-muted"></small>
                    </div>

                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Qty</h6>
                        <small class="text-muted">1</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Taxable</h6>
                        <small class="text-muted">N</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong id="total">$2995.00</strong>
                    <span id="discount" class="text-danger"><span>
                </li>
                <div class="mb-3 my-2">
                    <label for="couponCode">Code</label>
                    <input type="text" class="form-control" id="couponCode" name="couponCode" placeholder="Enter code">
                    
                </div>
                <div class="mb-3 my-2">
                   <button onclick="resetValues()" type="button" class="btn btn-primary">Remove Coupon</button>
                </div>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing information</h4>
            <form action="{{route('process.payment')}}" method="post">
                @csrf
                <input type="hidden" id="hiddenprice" name="price" value="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" id="firstName"
                               placeholder="First Name">
                        @error('firstName')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName"
                               placeholder="Last Name">
                        @error('lastName')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" placeholder="you@example.com">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="1234 Main St">
                    @error('address')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="company">Company <span class="text-muted">(optional)</span></label>
                    <input type="text" class="form-control @error('company') is-invalid @enderror" name="company" id="company" placeholder="Company Name">
                    @error('company')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="country">Country <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('country') is-invalid @enderror" name="country" id="country" placeholder="Country Name">
                    @error('country')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="city">City <span class="text-danger">*</span></label>
                        <input class="form-control @error('city') is-invalid @enderror" name="city" placeholder="City Name" id="city">
                        @error('city')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State <span class="text-danger">*</span></label>
                        <input class="form-control @error('state') is-invalid @enderror " name="state" placeholder="State Name" id="state">
                        @error('state')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip <span class="text-danger">*</span></label>
                        <input type="number" name="zip" class="form-control @error('zip') is-invalid @enderror" id="zip" placeholder="Zip Code">
                        @error('zip')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3">Payment Information</h4>
                <div class="row mx-1">
                    <img class="d-block mx-1 mb-4" src="https://secure.authorize.net/gateway/content/V.gif"
                         alt="Visa">
                    <img class="d-block mx-1  mb-4" src="https://secure.authorize.net/gateway/content/MC.gif"
                         alt="Mastercard">
                    <img class="d-block mx-1  mb-4" src="https://secure.authorize.net/gateway/content/Amex.gif"
                         alt="Amex">
                    <img class="d-block mx-1 mb-4" src="https://secure.authorize.net/gateway/content/Disc.gif"
                         alt="Disc">
                    <img class="d-block mx-1 mb-4" src="https://secure.authorize.net/gateway/content/JCB.gif"
                         alt="JCB">
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="ccname">Name on card</label>
                        <input type="text" class="form-control " id="ccname" placeholder="Card Name">
                        <small class="text-muted">Full name as displayed on card</small>

                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="ccnumber">Credit card number</label>
                        <input type="number" class="form-control @error('cardNumber') is-invalid @enderror" id="ccnumber" name="cardNumber"
                               placeholder="xxxxxxxxxxxxxxxx">
                        @error('cardNumber')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount"
                               placeholder="Enter Amount">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" class="form-control @error('expirationDate') is-invalid @enderror" id="cc-expiration" name="expirationDate"
                               placeholder="YYYY-MM">
                        @error('expirationDate')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="number" class="form-control  @error('cardCode') is-invalid @enderror" name="cardCode" id="cc-cvv" placeholder="CVV">
                        @error('cardCode')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Proceed</button>
            </form>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">Powered by Action Tech Solutions, LLC</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="https://travelbeyondhere.club/">Travel Beyond Here</a></li>
        </ul>
    </footer>
</div>
<script src="https://cdn.usebootstrap.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">

    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);
    const param1Value = params.get('product');
    var item = document.getElementById('item');
    var price = document.getElementById('price');
    var description = document.getElementById('description');
    var total = document.getElementById('total');
    var totalElement = document.getElementById("total");
    var couponCodeElement = document.getElementById("couponCode");
    var couponRedeemed = false;
    var hiddenPriceInput = document.getElementById("hiddenprice");
    
    var discount=document.getElementById("discount");

    function updateTotal(amount) {
        if (totalElement && hiddenPriceInput) {
            var currentTotal = parseFloat(totalElement.innerText.replace('$', ''));
            var newTotal = currentTotal + amount;
            totalElement.innerText = '$' + newTotal.toFixed(2);
            hiddenPriceInput.value = newTotal.toFixed(2);
        }
    }
   const actualValues=document.getElementById("");
    document.addEventListener("DOMContentLoaded", function() {
        couponCodeElement.addEventListener("input", function(event) {
            if (couponRedeemed) {
                return;
            }
            var value = event.target.value;
            switch (value) {
                case "TBH500":
                    couponCodeElement.classList.remove("is-invalid");
                    Swal.fire({
                        icon: 'success',
                        title: 'Coupon Activated',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    updateTotal(-500);
                    discount.innerText="-500";
                    
                    couponRedeemed = true;
                    break;
                case "TBH1K":
                    couponCodeElement.classList.remove("is-invalid");
                    Swal.fire({
                        icon: 'success',
                        title: 'Coupon Activated',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    updateTotal(-1000);
                    discount.innerText="-1000";
                    couponRedeemed = true;
                    break;
                case "TBH2K":
                    couponCodeElement.classList.remove("is-invalid");
                    Swal.fire({
                        icon: 'success',
                        title: 'Coupon Activated',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    updateTotal(-2000);
                    discount.innerText="-2000";
                    couponRedeemed = true;
                    break;
                default:
                    couponCodeElement.classList.add("is-invalid");
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        var amountInput = document.getElementById("amount");
        var totalElement = document.getElementById("total");
        var hiddenPriceInput = document.getElementById("hiddenprice");

        amountInput.addEventListener("input", function(event) {
            var enteredAmount = parseFloat(event.target.value);
            if (!isNaN(enteredAmount)) {
                updateTotal(enteredAmount);
            }
        });

        function updateTotal(amount) {
            if (totalElement) {
                totalElement.innerText = '$' + amount.toFixed(2);
                hiddenPriceInput.value = amount.toFixed(2);
            }
        }
    });

    function resetValues() {
        couponCodeElement.value = ""; 
        couponCodeElement.classList.remove("is-invalid");
        var itemPriceElement = document.getElementById("itemprice");
        var itemPriceValue = itemPriceElement.innerText.replace('$', '').trim(); 
        totalElement.innerText = '$' + itemPriceValue; 
        hiddenPriceInput.value = itemPriceValue; 
        discount.innerText = "";
        couponRedeemed = false;
    }

    switch (parseInt(param1Value)) {
        case 1:
            item.innerText = "TBH1CondoWeeks";
            price.innerText = "$2995.00";
            description.innerText = "LIFETIME (1 Condo Week) TBH (1 Condo Week)";
            total.innerText = "$2995.00";
            hiddenprice.value = "2995.00";
            break;
        case 2:
            item.innerText = "TBH4CondoWeeks";
            price.innerText = "$5995.00 ";
            description.innerText = "LIFETIME (4 Condo Weeks)";
            total.innerText = "$5995.00";
            hiddenprice.value = "5995.00";
            break;
        case 3:
            item.innerText = "TBH3CondoWeeks";
            price.innerText = "$3995.00";
            description.innerText = "LIFTTIME  (3 Condo Weeks) TBH 3 Condo Weeks";
            total.innerText = "$3995.00";
            hiddenprice.value = "3995.00";
            break;
        default:
            item.innerText = "TBH1CondoWeeks";
            price.innerText = "$2995.00";
            description.innerText = "LIFETIME (1 Condo Week) TBH (1 Condo Week)";
            total.innerText = "$2995.00";
            hiddenprice.value = "2995.00";
    }
</script>
</body>
</html>
