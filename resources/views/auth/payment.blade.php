@extends('layouts.app')
@section('content')
	
<form action="/your-charge-code" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
    data-amount="999"
    data-name="ILovePHP.net"
    data-description="Donation"
    data-image="http://www.ilovephp.net/wp-content/uploads/2016/03/small-3.jpg"
    data-locale="auto"
    data-zip-code="true">
  </script>
</form>
@endsection