
  (function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/controller_name
    var dataTable = $('#dynamic_table').dataTable( {
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : base + "/json",
        "columns": [
          { "data": "in_id" },
          { "data": "in_name" },
          { "data": "in_phone" },
          { "data": "in_email", "sClass": "hidden-xs" },
          { "data": "in_url", "sClass": "hidden-xs" },
          { "data": "in_message" },
          { "data": "in_post_date", "sClass": "hidden-xs" },
          { "data": function ( data, type, full, meta ) {
                    if( data.in_status =='active'){ 
                      ret='<span class="label label-success">Active</span>'; 
                    }else{
                      ret='<span class="label label-default">Non-Active</span>'; 
                    }
                      return ret;
                  }, "sClass": "hidden-xs" 
          },
          { "data" : function ( data, type, full, meta ) {
              return '<button class="btn btn-danger btn-xs" type="button" title="delete this message" onclick="delete_data('+data.in_id+')"> <i class="fa fa-trash-o"></i> </button>';
              }, "sClass": "hidden-xs text-center"
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
            // { "width": "8%", "targets": 1 }
          ]            
    });

    dataTable.fnSetColumnVis([0], false );  // hide kolom #0

}).call(this);

function delete_data(id) {
  var c= confirm("Anda akan menghapus pesan ini. Lanjutkan?");
  if(c==true){
    window.location.href = baseURL + 'inbox/delete/' + id;
  }
  return false;
}