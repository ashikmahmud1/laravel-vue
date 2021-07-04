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
                        You are now on Free Plan. Please choose plan to upgrade
                        <br/><br/>
                        <div class="row">
                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4 text-center">
                                    <h3><?php echo e($plan->name); ?></h3>
                                    <b>$<?php echo e(number_format($plan->price /100, 2)); ?> / month</b>
                                    <hr/>
                                    <a href="<?php echo e(route('checkout',$plan->id)); ?>" class="btn btn-primary">
                                        Subscribe to <?php echo e($plan->name); ?>

                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ashikmahmud/Documents/PhpStrom/laravel-vue/src/resources/views/billing/index.blade.php ENDPATH**/ ?>