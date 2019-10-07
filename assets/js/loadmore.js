$(function(){
    var page     = 1;
    var host     = window.location.host;
    var total_page = $('#loadmore').data('totalpage')

    if (total_page=='1')
    {
        $("#loadmore").hide();
    }

    $("#loadmore").click(function() {
        //alert('tes');
        var next = page+=1;

        $(this).hide();
        $('#animation_image').show();

        $.ajax({
                type: "GET",
                url: "http://"+host+"/loadmore/testimoni?page="+next,
                cache: false,
                success: function(html){
                    $("#content").append(html);
                    $('#animation_image').hide();
                    
                    if (next==total_page){
                        $("#loadmore").hide();
                    }else{
                        $("#loadmore").show();
                    }
                }
        });
    });
});