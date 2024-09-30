<div>

    <div class="container text-dark">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <h4><center>Tatvika</center></h4>
                <h6>please complete the payment </h6>
                <form wire:submit.prevent="payment_request" class="shadow bg-white" method="POST">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" wire:click="name" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                        <input type="number" wire:click="phone" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Total Amount :</label>
                        <!-- <input type="number" wire:click="amount" class="form-control" id="exampleFormControlInput1" value="₹{{$this->amount}}"> -->
                        ₹{{$this->totalProductAmount}}
                    </div>
                    <div class="mt-5">
                        <button type="button" class="btn btn-secondary mb-4 mx-5" wire:click="payment_request">Click to Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
