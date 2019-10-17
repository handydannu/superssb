
  (function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#channels_table').dataTable( {
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : base + "/json",
        "columns": [
          { "data": "ch_id" },
          { "data" : function ( data, type, full, meta ) {
              var btn_group='<div class="btn-group">'+
                      '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button">Actions <span class="caret"></span></button>'+
                      '<ul role="menu" class="dropdown-menu">'+
                          '<li><a href="javascript:;" onclick="edit_channel('+data.ch_id+')"><i class="fa fa-pencil"></i> Edit</a></li>'+
                      '</ul>'+
                  '</div>';
              return btn_group;
              }, "class": "actions"
          },
          { "data": "ch_name" },
          { "data": "ch_slug", "sClass": "hidden-xs" },
          { "data": function ( data, type, full, meta ) {
                      var ret = '<span class="label label-warning">'+data.tp_name+'</span>'; 
                      return ret;
                  }, "sClass": "hidden-xs" 
          },
          { "data": function ( data, type, full, meta ) {
                    if( data.ch_status =='1'){ 
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
            { "width": "8%", "targets": [1,5] }
          ]            
    });

    dataTable.fnSetColumnVis([0], false );  // hide kolom #0

}).call(this);

function edit_channel(id) {
    window.location.href = baseURL + 'channels/edit/' + id;
    return false;
}
function delete_channel(id) {
  var c= confirm("Hapus secara permanen. Teruskan?");
  if(c==true){
    window.location.href = baseURL + 'channels/delete/' + id;
  }
  return false;
}