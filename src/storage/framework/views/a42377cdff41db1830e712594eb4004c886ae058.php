<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Subscribe to <?php echo e($plan->name); ?></div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?php if(session('error')): ?>
                                    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                                <?php endif; ?>

                                    <form method="POST" action="<?php echo e(route('checkout.process')); ?>" id="checkout-form" class="card-form mt-3 mb-3">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="billing_plan_id" value="<?php echo e($plan->id); ?>">
                                        <input type="hidden" name="payment-method" id="payment-method" value="">
                                        <input class="StripeElement mb-3" id="card-holder-name" name="card_holder_name"
                                               placeholder="Card holder name" required>
                                        <div id="card-element"></div>
                                        <div id="card-errors" role="alert"></div>
                                        <div class="form-group mt-3">
                                            <button class="btn btn-primary pay" id="card-button"
                                                    data-secret="<?php echo e($intent->client_secret); ?>" onclick="">
                                                Pay $<?php echo e(number_format($plan->price /100, 2)); ?>

                                            </button>
                                        </div>
                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://js.stripe.com/v3/"></script>

    <script>

        $(document).ready(function (){
            const stripe = Stripe("<?php echo e(env('STRIPE_KEY')); ?>");

            const elements = stripe.elements();

            let style = {
                base: {
                    color: "#32325d",
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }

            let card = elements.create('card', {style: style})
            card.mount('#card-element');
            let paymentMethod = null;
            $('#checkout-form').on('submit', function (e) {
                if (paymentMethod){
                    return true
                }
                e.preventDefault();
                stripe.confirmCardSetup(
                    "<?php echo e($intent->client_secret); ?>",
                    {
                        payment_method: {
                            card: card,
                            billing_details: {name: $('card-holder-name').val()}
                        }
                    }
                ).then(function (result) {
                    if (result.error){
                        console.log(result);
                    } else {
                        paymentMethod = result.setupIntent.payment_method;
                        $('#payment-method').val(paymentMethod);
                        $('#checkout-form').submit();
                    }
                })
            })
        })

    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <style>
        .StripeElement{
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ashikmahmud/Documents/PhpStrom/laravel-vue/src/resources/views/billing/checkout.blade.php ENDPATH**/ ?>