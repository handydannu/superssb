
  (function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#dynamic-table').dataTable( {
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : base + "/json",
        "columns": [
          { "data": "uid" },
          { "data" : function ( data, type, full, meta ) {
              var btn_group='<div class="btn-group">'+
                      '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button">Actions <span class="caret"></span></button>'+
                      '<ul role="menu" class="dropdown-menu">'+
                          '<li><a href="javascript:;" onclick="edit_user('+data.uid+')"><i class="fa fa-pencil"></i> Edit</a></li>'+
                          '<li><a href="javascript:;" onclick="delete_user('+data.uid+')"><i class="fa fa-trash-o"></i> Delete</a></li>'+
                      '</ul>'+
                  '</div>';
              return btn_group;
              }, "class": "actions"
          },
          { "data": "username" },
          { "data": "nama", "sClass": "hidden-xs" },
          { "data": "email", "sClass": "hidden-xs"  },
          { "data": function ( data, type, full, meta ) {
                    if( data.active =='1'){ 
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
            }
          ]            
    });

    dataTable.fnSetColumnVis([0], false );  // hide kolom #0

}).call(this);

function edit_user(id) {
    window.location.href = baseURL + 'user/edit/' + id;
    return false;
}
function delete_user(id) {
  var c= confirm("Anda yakin Hapus ?");
  if(c==true){
    window.location.href = baseURL + 'user/delete/' + id;
  }
  return false;
}