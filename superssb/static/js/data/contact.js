
   (function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#dynamic_table').dataTable( {
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : base + "/json",
        "columns": [
          { "data": "contact_id" },
          { "data" : function ( data, type, full, meta ) {
            if( data.contact_status =='1' ){
              var btn_group='<div class="btn-group">'+
                      '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button">Actions <span class="caret"></span></button>'+
                      '<ul role="menu" class="dropdown-menu">'+
                          '<li><a href="javascript:;" onclick="delete_channel('+data.contact_id+')"><i class="fa fa-trash"></i> Delete</a></li>'+
                          '<li><a href="javascript:;" onclick="change_channel('+data.contact_id+')"><i class="fa fa-refresh"></i> Set Not Active</a></li>'+
                      '</ul>'+
                  '</div>';
            }
            else{
              var btn_group='<div class="btn-group">'+
                      '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button">Actions <span class="caret"></span></button>'+
                      '<ul role="menu" class="dropdown-menu">'+
                          '<li><a href="javascript:;" onclick="delete_channel('+data.contact_id+')"><i class="fa fa-trash"></i> Delete</a></li>'+
                          '<li><a href="javascript:;" onclick="change_channel('+data.contact_id+')"><i class="fa fa-refresh"></i> Set Active</a></li>'+
                      '</ul>'+
                  '</div>';
            }
              return btn_group;
              }, "class": "actions"
          },
          { "data": "contact_name" },
          { "data": "contact_email" },
          { "data": "contact_title" },
          { "data": "contact_content"},
          { "data": "contact_created"},         
          { "data": function ( data, type, full, meta ) {   
                    if( data.contact_status =='1'){ 
                      ret='<span class="label label-success">Active</span>'; 
                    }else{
                      ret='<span class="label label-default">Non-Active</span>'; 
                    }
                      return ret;
                  }, "sClass": "hidden-xs" 
          }
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

function edit_channel(id) {
    window.location.href = baseURL + 'testimoni/edit/' + id;
    return false;
}
function change_channel(id) {
    window.location.href = baseURL + 'contact/change_status/' + id;
    return false;
}
function delete_channel(id) {
  var c= confirm("Anda akan menghapus Page ini secara permanen. Teruskan?");
  if(c==true){
    window.location.href = baseURL + 'contact/delete/' + id;
  }
  return false;
}