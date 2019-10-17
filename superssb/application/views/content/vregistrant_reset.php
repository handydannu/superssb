    <section class="wrapper">
        <div class="row">
            <div class="col-lg-7">
                <section class="panel">
                    <header class="panel-heading">
                        RESET PASSWORD REGISTRANT
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="formID">
                            <input type="hidden" name="uid" class="form-control" value="<?php echo (isset($EDIT['user_id'])? $EDIT['user_id'] : ''); ?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Full Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="fullname" disabled="disabled" class="form-control" value="<?php echo (isset($EDIT['fullname'])? $EDIT['fullname'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" name="username" disabled="disabled" class="form-control" value="<?php echo (isset($EDIT['username'])? $EDIT['username'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">E-Mail</label>
                                <div class="col-sm-6">
                                    <input type="text" name="email" disabled="disabled" class="form-control" value="<?php echo (isset($EDIT['email'])? $EDIT['email'] : ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" id="password" class="form-control" data-validation-engine="validate[required]" data-errormessage-value-missing="PASSWORD tidak boleh kosong!">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Re-type Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password2" class="form-control" data-validation-engine="validate[required,equals[password]]" data-errormessage-value-missing="Ulangi password Anda disini!">
                                </div>
                            </div>
                            
                             
                            <div class="position-center">
                                <button type="submit" class="btn btn-primary">Reset</button> 
                                <button type="button" class="btn btn-white" id="btn-cancel" onclick="history.back(-1)">Cancel</button>
                            </div>  
                        </form>
                    </div>
                </section>
            </div>            
        </div>
    </section>