<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Billing</div>

                    <div class="card-body">
                        <?php if(session('message')): ?>
                            <div class="alert alert-info"><?php echo e(session('message')); ?></div>
                        <?php endif; ?>
                        <?php if(is_null($currentPlan)): ?>
                            You are now on Free Plan. Please choose plan to upgrade:
                            <br/><br/>
                        <?php endif; ?>
                        <div class="row">
                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4 text-center">
                                    <h3><?php echo e($plan->name); ?></h3>
                                    <b>$<?php echo e(number_format($plan->price /100, 2)); ?> / month</b>
                                    <hr/>
                                    <?php if($plan->stripe_plan_id == $currentPlan->stripe_price): ?>
                                        Your current plan.
                                        <br/>
                                        <?php if(!$currentPlan->onGracePeriod()): ?>
                                            <a href="<?php echo e(route('cancel')); ?>" class="btn btn-danger"
                                               onclick="return confirm('Are you sure?')">Cancel plan</a>
                                        <?php else: ?>
                                            Your subscription will end on <?php echo e($currentPlan->ends_at->toDateString()); ?>

                                            <br/><br/>
                                            <a href="<?php echo e(route('resume')); ?>" class="btn btn-primary">Resume
                                                subscription</a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('checkout',$plan->id)); ?>" class="btn btn-primary">
                                            Subscribe to <?php echo e($plan->name); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php if(!is_null($currentPlan)): ?>
                    <br/><br/>
                    <div class="card">
                        <div class="card-header">Payment Methods</div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Brand</th>
                                    <th>Expires at</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($paymentMethod->card->brand); ?></td>
                                        <td><?php echo e($paymentMethod->card->exp_month); ?>

                                            / <?php echo e($paymentMethod->card->exp_year); ?></td>
                                        <td>
                                            <?php if($defaultPaymentMethod->id == $paymentMethod->id): ?>
                                                default
                                            <?php else: ?>
                                                <a href="<?php echo e(route('payment-methods.markDefault', $paymentMethod->id)); ?>">Mark as Default</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                            <br/>
                            <a href="<?php echo e(route('payment-methods.create')); ?>" class="btn btn-primary">Add Payment Method</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ashikmahmud/Documents/PhpStrom/laravel-vue/src/resources/views/billing/index.blade.php ENDPATH**/ ?>