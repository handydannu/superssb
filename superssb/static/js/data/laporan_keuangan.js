
  (function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#dynamic_table').dataTable( {
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : base + "/json",
        "columns": [
          { "data": "doc_id" },
          { "data" : function ( data, type, full, meta ) {
              var btn_group='<div class="btn-group">'+
                      '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button">Actions <span class="caret"></span></button>'+
                      '<ul role="menu" class="dropdown-menu">'+
                          '<li><a href="javascript:;" onclick="edit_channel('+data.doc_id+')"><i class="fa fa-pencil"></i> Edit</a></li>'+
                          '<li><a href="javascript:;" onclick="delete_channel('+data.doc_id+')"><i class="fa fa-trash-o"></i> Delete</a></li>'+
                      '</ul>'+
                  '</div>';
              return btn_group;
              }, "class": "actions"
          },
          { "data": "doc_title" },
          { "data": "ch_name" },
          { "data": function ( data, type, full, meta ) {
                    if( data.doc_year =='0000'){ 
                      ret=''; 
                    }else{
                      ret=data.doc_year; 
                    }
                      return ret;
                  }, "sClass": "hidden-xs" 
          },
          { "data": "doc_publish_date" },
          { "data": "doc_summary", "class": "hidden-xs" },
          { "data": "doc_file", "class": "hidden-xs" },
          { "data": function ( data, type, full, meta ) {
            if( data.doc_status == '1' ){
              ret = '<span class="label label-success">Active</span>';
            }
            else{
              ret = '<span class="label label-default">Not Active</span>';
            }
            return ret;
            }
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

var base = window.location.href;
function edit_channel(id) {
    window.location.href = base + '/edit/' + id;
    return false;
}
function delete_channel(id) {
  var c= confirm("Anda akan menghapus data ini secara permanen. Lanjutkan?");
  if(c==true){
    window.location.href = base + '/delete/' + id;
  }
  return false;
}