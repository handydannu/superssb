<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// new google analytic: Universal Analytics Tracking Code
function google_analytics($uacct = ''){
    $CI =& get_instance();
    if($uacct != '' || $CI->config->item('google_uacct') != ''){   
        if($CI->config->item('google_uacct') != ''){
            $google_account_id = $CI->config->item('google_uacct');
        }
        if($uacct != ''){
            $google_account_id = $uacct;
        }
        
        $google_analytics_code = '
            <!-- BEGIN Google Analytics Script -->
            <script>
              (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
              })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

              ga(\'create\', \''.$google_account_id.'\', \'auto\');
              ga(\'send\', \'pageview\');
            </script>
            <!-- END Google Analytics Script -->
        ';

        return $google_analytics_code;
    }   
}

function google_analytics_old($uacct = ''){
	$CI =& get_instance();
    if($uacct != '' || $CI->config->item('google_uacct') != ''){   
        if($CI->config->item('google_uacct') != ''){
            $google_account_id = $CI->config->item('google_uacct');
        }
        if($uacct != ''){
            $google_account_id = $uacct;
        }
        
        $google_analytics_code = '
            <!-- BEGIN Google Analytics Script -->
            <script type="text/javascript">
                var _gaq = _gaq || [];
                _gaq.push([\'_setAccount\', \''.$google_account_id.'\']);
                _gaq.push([\'_setDomainName\', \'bisnis.com\']);
                _gaq.push([\'_trackPageview\']);
                
                (function() {
                 var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
                 ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
                 var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
                })();
            </script>
            <!-- END Google Analytics Script -->
        ';

        return $google_analytics_code;
    }   
}

// google analytic with Analytics Tracking Code to Support Display Advertising (Demographics and Interest Reports)
function google_analytics_ads($uacct = ''){
    $CI =& get_instance();
    if($uacct != '' || $CI->config->item('google_uacct') != ''){   
        if($CI->config->item('google_uacct') != ''){
            $google_account_id = $CI->config->item('google_uacct');
        }
        if($uacct != ''){
            $google_account_id = $uacct;
        }
        
        $google_analytics_code = '
            <!-- BEGIN Google Analytics Script -->
            <script type="text/javascript">
                var _gaq = _gaq || [];
                _gaq.push([\'_setAccount\', \''.$google_account_id.'\']);
                _gaq.push([\'_setDomainName\', \'bisnis.com\']);
                _gaq.push([\'_trackPageview\']);
                
                (function() {
                 var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
                 ga.src = (\'https:\' == document.location.protocol ? \'https://\' : \'http://\') + \'stats.g.doubleclick.net/dc.js\';
                 var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
                })();
            </script>
            <!-- END Google Analytics Script -->
        ';

        return $google_analytics_code;
    }   
}

function alexa_pro($domain='bisnis.com'){
    //$CI =& get_instance();
    $alexa = '
        <!-- BEGIN Alexa Pro Script -->
        <script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script>
        <script type="text/javascript">_atrk_opts = { atrk_acct: "uxlue1aw/500ig", domain:"bisnis.com"}; atrk ();</script>
        <noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=uxlue1aw/500ig" style="display:none" height="1" width="1" alt="" /></noscript>
        <!-- END Alexa Pro Script -->
    ';

    return $alexa;
}

function effective_measure(){
    //$CI =& get_instance();
    $em = '
        <!-- BEGIN EFFECTIVE MEASURE CODE -->
        <!-- COPYRIGHT EFFECTIVE MEASURE -->
        <script type="text/javascript">
            (function() {
            var em = document.createElement(\'script\'); em.type = \'text/javascript\'; em.async = true;
            em.src = (\'https:\' == document.location.protocol ? \'https://id-ssl\' : \'http://id-cdn\') + \'.effectivemeasure.net/em.js\';
            var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(em, s);
            })();
        </script>
        <noscript><img src="//id.effectivemeasure.net/em_image" alt="" style="position:absolute; left:-5px;" /></noscript>
        <!--END EFFECTIVE MEASURE CODE -->
    ';

    return $em;
}


?>