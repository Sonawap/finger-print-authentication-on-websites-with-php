<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Match Record</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">   
                <h5 class="mb-3">Application Number: <strong><?php echo $admin->getUserInfoByApp($app)["Application_no"] ?></strong></h5>
                <h5 class="mb-3">Surname: <strong><?php echo $admin->getUserInfoByApp($app)["surname"] ?></strong></h5>
                <h5 class="mb-3">First Name:<strong><?php echo $admin->getUserInfoByApp($app)["firstname"] ?></strong></h5>
                <h5 class="mb-3">Other Names:<strong><?php echo $admin->getUserInfoByApp($app)["othername"] ?></strong></h5>
                <h5 class="mb-3">Sex:<strong><?php echo $admin->getUserInfoByApp($app)["sex"] ?></strong></h5>
                <h5 class="mb-3">Age:<strong><?php echo $admin->getUserInfoByApp($app)["age"] ?></strong></h5>
            </div>
            <div class="col-md-3 text-center">
                <?php if($admin->getUserInfoByApp($app)["photo"] ) :?>
                    <img src="<?php echo "../photos/" . $admin->getUserInfoByApp($app)['photo'] ?>" width="200" height="200">
                <?php else : ?>
                    <h4 class="text-center">No Image found</h4>
                <?php endif ?>
            </div>

            <div class="col-md-6">
                <h5 class="mb-3">Nationality:<strong><?php echo $admin->getUserInfoByApp($app)["nationality"] ?></strong></h5>
            </div>

            <div class="col-md-6">
                <h5 class="mb-3">Residential State:<strong><?php echo $admin->getUserInfoByApp($app)["rstate"] ?></strong></h5>
            </div>

            <div class="col-md-6">
                <h5 class="mb-3">Residential LGA:<strong><?php echo $admin->getUserInfoByApp($app)["rlga"] ?></strong></h5>
            </div>

            <div class="col-md-6">
                <h5 class="mb-3">Residential Town:<strong><?php echo $admin->getUserInfoByApp($app)["rtown"] ?></strong></h5>
            </div>


            <div class="col-md-6">
                <h5 class="mb-3">Occupation:<strong><?php echo $admin->getUserInfoByApp($app)["occupation"] ?></strong></h5>
            </div>


            <div class="col-md-6">
                <h5 class="mb-3">State of Birth:<strong><?php echo $admin->getStateName($admin->getUserInfoByApp($app)["sbirth"])['name'] ?></strong></h5>
            </div>


            <div class="col-md-6">
                <h5 class="mb-3">LGA of Birth:<strong><?php echo $admin->getUserInfoByApp($app)["lgabirth"] ?></strong></h5>
            </div>


            <div class="col-md-6">
                <h5 class="mb-3">Disabled:<strong><?php echo $admin->getUserInfoByApp($app)["disable"] ?></strong></h5>
            </div>


            <div class="col-md-6">
                <h5 class="mb-3">Work Status:<strong><?php echo $admin->getUserInfoByApp($app)["work"] ?></strong></h5>
            </div>

            <div class="col-md-6">
                <?php if($admin->checkUserComplete($admin->getUserInfoByApp($app)["id"])) : ?>
                    <h5 class="mb-3">Registration Status:<strong> Completed </strong></h5>
                    <?php else: ?>
                        <h5 class="mb-3">Registration Status:<strong> Incomplete </strong></h5>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>