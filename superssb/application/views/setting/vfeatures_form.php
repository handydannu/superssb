    <section class="wrapper">
        <div class="row">
            <div class="col-lg-7">
                <section class="panel">
                    <header class="panel-heading">
                        <?php
                        $fields = array('fe_name', 'fe_status');
                        foreach($fields as $field){
                            $EDIT[$field] = isset($EDIT[$field]) ? $EDIT[$field] : $this->session->flashdata($field);
                        }
                        ?>
                        <?php echo ($add_mode==1)? 'ADD' : 'EDIT'; ?> FEATURE
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="formID">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Feature Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="fe_name" class="form-control" value="<?php echo (isset($EDIT['fe_name'])? $EDIT['fe_name'] : ''); ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="Feature Name tidak boleh kosong!">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status</label>
                                <div class="col-md-3">
                                  <select name="status" class="form-control">
                                    <option value="1" <?php echo ($EDIT['fe_status']==1 || $add_mode==1) ? 'selected="selected"' : ''; ?> >Active &nbsp; &nbsp;</option>
                                    <option value="0" <?php echo ($EDIT['fe_status']==0)? 'selected="selected"' : ''; ?> >Non-Active</option>
                                  </select>
                                </div>
                            </div>
                             
                            <div class="position-center">
                                <input type="hidden" name="fid" class="form-control" value="<?php echo (isset($EDIT['fe_id'])? $EDIT['fe_id'] : ''); ?>">
                                <button type="submit" class="btn btn-primary">Submit</button> 
                                <button type="button" class="btn btn-white" id="btn-cancel" onclick="history.back(-1)">Cancel</button>
                            </div>  
                        </form>
                    </div>
                </section>
            </div>            
        </div>
    </section>