<div class="container">


    <!--  <- yang lama  my col = ,  col-lg-7 = untuk lebar dari colum/kotanya -->
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <!-- mx auto fungsinya sama kaya di css margin auto  m = margin  x = sumbu x -->
        <div class="card-body p-2">
            <!-- Nested Row within Card Body -->
            <div class="row">

                <div class="col-lg">
                    <div class="p-3">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/register'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="full name" value="<?= set_value('name') ?>">
                                <?= form_error('name', ' <small class="text-danger ml-3">', '</small>'); ?>

                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email') ?>">
                                <?= form_error('email', ' <small class="text-danger ml-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', ' <small class="text-danger ml-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>

                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url() ?>auth">Already have an account? Login!</a>
                            <!--  base_url() ?>auth"    fungsinya untuk masuk ke auth di controller dan dia akan masuk ke index login-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>