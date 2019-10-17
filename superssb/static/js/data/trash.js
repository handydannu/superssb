
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
                      '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button">Actions <span class="caret"></span></button>'+
                      '<ul role="menu" class="dropdown-menu">'+
                          '<li><a href="javascript:;" onclick="restore_data('+data.c_id+')"><i class="fa fa-pencil"></i> Restore </a></li>'+
                          '<li><a href="javascript:;" onclick="delete_data('+data.c_id+')"><i class="fa fa-trash-o"></i> Permanent Delete</a></li>'+
                      '</ul>'+
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
                    }else if( data.c_status =='trash'){ 
                      ret='<span class="label label-danger">Trash</span>'; 
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

function restore_data(id) {
    window.location.href = baseURL + 'trash/restore/' + id;
    return false;
}

function delete_data(id) {
  var c= confirm("Anda akan menghapus data ini secara permanen. Lanjutkan?");
  if(c==true){
    window.location.href = baseURL + 'trash/delete/' + id;
  }
  return false;
}