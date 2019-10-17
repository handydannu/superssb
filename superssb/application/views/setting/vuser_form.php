    <section class="wrapper">
        <div class="row">
            <div class="col-lg-7">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo ($add_mode==1)? 'ADD' : 'EDIT'; ?> USER
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="formID">
                            <input type="hidden" name="uid" class="form-control" value="<?php echo (isset($EDIT['uid'])? $EDIT['uid'] : ''); ?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Full Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="fullname" class="form-control" value="<?php echo (isset($EDIT['nama'])? $EDIT['nama'] : ''); ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="FULL NAME tidak boleh kosong!">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">User Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="username" class="form-control" value="<?php echo (isset($EDIT['username'])? $EDIT['username'] : ''); ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="USERNAME tidak boleh kosong!">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control" data-validation-engine="validate[required]" data-errormessage-value-missing="PASSWORD tidak boleh kosong!">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Re-type Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password2" class="form-control" data-validation-engine="validate[required]" data-errormessage-value-missing="Isi lagi password Anda disini!">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">E-Mail</label>
                                <div class="col-sm-6">
                                    <input type="text" name="email" class="form-control" value="<?php echo (isset($EDIT['email'])? $EDIT['email'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Telpon</label>
                                <div class="col-sm-6">
                                    <input type="text" name="telpon" class="form-control" value="<?php echo (isset($EDIT['telpon'])? $EDIT['telpon'] : ''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Privilege</label>
                                <div class="col-md-2">
                                  <select name="privilege" class="select2-container select2able select2-container-active" id="privilege">
                                    <option value="reporter" <?php echo ((empty($EDIT['privilege']) || $EDIT['privilege'] == 'reporter' || $add_mode == 1)? 'selected="selected"' : '') ?> > Reporter &nbsp; </option>
                                    <option value="editor" <?php echo ((!empty($EDIT['privilege']) && $EDIT['privilege'] == 'editor')? 'selected="selected"' : '') ?> > Editor &nbsp; &nbsp;</option>
                                    <option value="admin" <?php echo ((!empty($EDIT['privilege']) && $EDIT['privilege'] == 'admin')? 'selected="selected"' : '') ?> > Admin &nbsp; &nbsp;</option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status</label>
                                <div class="col-md-2">
                                  <select name="status" class="select2-container select2able select2-container-active" id="userform">
                                    <option value="1" <?php echo (!empty($EDIT['active'])? 'selected="selected"' : '') ?> >Active &nbsp; &nbsp;</option>
                                    <option value="0" <?php echo (empty($EDIT['active'])? 'selected="selected"' : '') ?> >Non-Active</option>
                                  </select>
                                </div>
                            </div>
                             
                            <div class="position-center">
                                <button type="submit" class="btn btn-primary">Submit</button> 
                                <button type="button" class="btn btn-white" id="btn-cancel" onclick="history.back(-1)">Cancel</button>
                            </div>  
                        </form>
                    </div>
                </section>
            </div>            
        </div>
    </section>