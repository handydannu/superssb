
  (function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#dynamic_table').dataTable( {
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : base + "/json",
        "columns": [
          { "data": "pp_id" },
          { "data" : function ( data, type, full, meta ) {
              var btn_group='<div class="btn-group">'+
                      '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button">Actions <span class="caret"></span></button>'+
                      '<ul role="menu" class="dropdown-menu">'+
                          '<li><a href="javascript:;" onclick="edit_channel('+data.pp_id+')"><i class="fa fa-pencil"></i> Edit</a></li>'+
                          '<li><a href="javascript:;" onclick="delete_channel('+data.pp_id+')"><i class="fa fa-pencil"></i> Delete</a></li>'+
                      '</ul>'+
                  '</div>';
              return btn_group;
              }, "class": "actions"
          },
          { "data": "pp_location" },
          { "data": "pp_address" },
          { "data": "pp_phone" },
          { "data": "pp_fax" },
          { "data": "pp_created" },
          { "data": function ( data, type, full, meta ) {
                    if( data.pp_status =='0'){ 
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
    window.location.href = baseURL + 'payment_point/edit/' + id;
    return false;
}
function delete_channel(id) {
  var c= confirm("Anda akan menghapus Page ini secara permanen. Teruskan?");
  if(c==true){
    window.location.href = baseURL + 'payment_point/delete/' + id;
  }
  return false;
}