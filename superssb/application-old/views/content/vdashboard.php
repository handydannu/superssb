<section class="wrapper">

<div class="row">
    <div class="col-md-4">
        <div class="profile-nav alt">
            <section class="panel">
                <div class="user-heading alt clock-row terques-bg">
                    <h1><?= date('F d') ?></h1>
                    <p class="text-left"><?= date('Y') . ', ' . date('l') ?></p>
                    <p class="text-left"><?= date('h:i A') ?></p>
                </div>
                <ul id="clock">
                    <li id="sec"></li>
                    <li id="hour"></li>
                    <li id="min"></li>
                </ul>

                <ul class="clock-category">
                </ul>

            </section>

        </div>
    </div>
    
    <div class="col-md-2">
        <div class="profile-nav alt">
            <section class="panel text-center">
                <div class="user-heading alt wdgt-row blue-bg">
                    <i class="fa fa-external-link-square"></i>
                </div>

                <div class="panel-body">
                    <div class="wdgt-value">
                        <a href="#">
                            <h1 class="count"><?= (isset($publish['itotal'])) ? format_numbering($publish['itotal']) : 0 ?></h1>
                            <p>Publish</p>
                        </a>
                    </div>
                </div>

            </section>
        </div>
    </div>
    <div class="col-md-2">
        <div class="profile-nav alt">
            <section class="panel text-center">
                <div class="user-heading alt wdgt-row red-bg">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>

                <div class="panel-body">
                    <div class="wdgt-value">
                        <a href="#">
                            <h1 class="count"><?= (isset($draft['itotal'])) ? format_numbering($draft['itotal']) : 0 ?></h1>
                            <p>Draft</p>
                        </a>
                    </div>
                </div>

            </section>
        </div>
    </div>
</div>

<?php if(count($popular_today)>0){ ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Most Viewed 24h
            </header>
            <div class="panel-body">
                <table class="table table-hover general-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Hits</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                        foreach($popular_today as $row){
                            $tgl         = parseDateTime($row['c_created_date']);
                            $article_url = 'http://www.prindonesiamagz.com/read/'.$tgl['year'].$tgl['month'].$tgl['day'].'/'.$row['c_id'].'/'.$row['c_id'].'/'.$row['c_slug'];
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><a href="<?php echo $article_url ?>" target="_blank"><?php echo $row['c_title']; ?></a> </td>
                        <td><?php echo ((empty($row['c_author'])) ? $row['c_author_name'] : $row['authorName']); ?></td>
                        <td><?php echo format_numbering($row['c_hits']); ?></td>
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
<?php } ?>

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Most Viewed This Month
            </header>
            <div class="panel-body">
                <table class="table table-hover general-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Hits</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?php 
                        if(count($popular_month)>0){
                            $i = 1;
                            foreach($popular_month as $row){
                                $tgl         = parseDateTime($row['c_created_date']);
                                $article_url = 'http://www.prindonesiamagz.com/read/'.$tgl['year'].$tgl['month'].$tgl['day'].'/'.$row['c_id'].'/'.$row['c_id'].'/'.$row['c_slug'];
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><a href="<?php echo $article_url ?>" target="_blank"><?php echo $row['c_title']; ?></a> </td>
                        <td><?php echo ((empty($row['c_author'])) ? $row['c_author_name'] : $row['authorName']); ?></td>
                        <td><?php echo format_numbering($row['c_hits']); ?></td>
                    </tr>
                    <?php $i++; }} ?>
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                LATEST SUBSCRIBERS
            </header>
            <div class="panel-body">
                <table class="table table-hover general-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>EMail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                        foreach($subscriber as $row){
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?php echo $row['sub_date']; ?></td>
                        <td><?php echo $row['sub_name']; ?></td>
                        <td><?php echo $row['sub_email']; ?></td>
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<?php/* if(count($inbox)>0){ ?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                INBOX
            </header>
            <div class="panel-body">
                <table class="table table-hover general-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>EMail</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                        foreach($inbox as $row){
                    ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?php echo $row['in_post_date']; ?></td>
                        <td><?php echo $row['in_name']; ?></td>
                        <td><?php echo $row['in_email']; ?></td>
                        <td><?php echo word_limiter(htmlspecialchars_decode($row['in_message'], 5)); ?></td>
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
<?php } */ ?>


</section>