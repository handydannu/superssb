
  (function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#dynamic_table').dataTable( {
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : base + "/json",
        "columns": [
          { "data": "c_id" },
          { "data" : function ( data, type, full, meta ) {
              var btn_group='<div class="btn-group">'+
                      '<button class="btn btn-primary btn-sm" type="button" onclick="release_article('+data.c_id+')"> Release </button>'+
                  '</div>';
              return btn_group;
              }, "class": "actions"
          },
          { "data": "c_publish_date"},
          { "data": "c_title" },
          { "data": "c_hits" },
          { "data": function ( data, type, full, meta ) {
                    if( data.c_is_editing =='1'){ 
                      ret='<span class="label label-warning">Editing..</span>'; 
                    }else if( data.c_status =='publish'){ 
                      ret='<span class="label label-success">Publish</span>'; 
                    }else{
                      ret='<span class="label label-default">Draft</span>'; 
                    }
                      return ret;
                  }, "sClass": "hidden-xs" 
          },
          { "data": "ch_name" },
          { "data": "fe_name" },
          { "data": "authorName" },
          { "data": "editorName" }
        ],  
      "lengthMenu": [[20, 50, 100, 200], [20, 50, 100, 200]],
      "order": [[ 0, "desc" ]],  // default order
      "sPaginationType": "full_numbers",
          aoColumnDefs: [
            {
              bSortable: false,
              aTargets: [1]  // kolom #1 tidak bisa sorting
            },
            { "width": "8%", "targets": 1 }
          ]            
    });

    dataTable.fnSetColumnVis([0], false );  // hide kolom #0

}).call(this);

function release_article(id) {
    window.location.href = baseURL + 'locked/release/' + id;
    return false;
}