<section class="wrapper">

<!--mini statistics start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Filter Data
            </header>
            <div class="panel-body">
                <div class="position-left">
                    <form class="form-horizontal" role="form" action="" method="GET">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 col-sm-3 control-label">Author</label>
                        <div class="col-lg-5">
                            <?= option_dropdown2('uid',$author,''); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-3 col-sm-3 control-label">Editor</label>
                        <div class="col-lg-5">
                            <?= option_dropdown2('post_editor',$editor,''); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-3 col-sm-3 control-label">Start Month</label>
                        <div class="col-lg-3">
                            <?= option_dropdown('m1',$month,date('m')) ?>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="y2" class="form-control" value="<?= date('Y') ?>">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-3 col-sm-3 control-label">End Month</label>
                        <div class="col-lg-3">
                            <?= option_dropdown('m2',$month,date('m')) ?>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="y2" class="form-control" value="<?= date('Y') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-8">
                            <button type="submit" class="btn btn-danger">Show</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </section>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">

    </div>
</div>


</section>