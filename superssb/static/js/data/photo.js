
  (function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#dynamic-table').dataTable( {
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : base + "/json",
        "columns": [          
          { "data" : function ( data, type, full, meta ) {
              var ret='<div class="btn-group">'+
                          '<button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown"> Action <span class="caret"></span></button>'+
                          '<ul class="dropdown-menu" role="menu">'+
                              '<li><a href="photo/edit/'+data.ph_id+'" title="Edit""><i class="fa fa-pencil"></i> Edit Photo</a></li>'+
                              '<li><a onclick="delete_id('+ data.ph_id +');" href="javascript:;" title="Delete"><i class="fa fa-trash-o"></i> Delete Photo</a></li>'+
                              '<li class="divider"></li>'+
                              '<li><a href="javascript:;" onclick="publish('+data.ph_album_id+')"><i class="fa fa-check"></i> Publish </a></li>'+
                          '</ul>'+
                      '</div>';
              return ret;
             }
          },
          { "data": "album_title" },
          { "data": "album_date" },
          { "data": "ph_album_id" },
          { "data": "showdate", "width": "8%" },
          { "data": "ph_title" },
          { "data"  : function ( data, type, full, meta ) {
                      var myDate = data.album_created_date;
                      var myDate = myDate.split(' ');
                      var arr = myDate[0].split('-');

                      var ret='<img width="150px" src="'+imagesURL+'/photos/'+arr[0]+'/'+arr[1]+'/'+arr[2]+'/'+data.album_id+'/'+data.ph_images_thumbnail+'" alt="'+data.ph_title+'" />';
                        return ret;
                      },
            "sClass": "hidden-xs"          
          },
          { "data": "ph_credit", "sClass": "hidden-xs" },
          { "data": "ph_photographer", "sClass": "hidden-xs" },
          { "data": function ( data, type, full, meta ) {
                    if( data.ph_status =='1'){ 
                      ret='<span class="label label-success">publish</span>'; 
                    }else{
                      ret='<span class="label label-default">draft</span>'; 
                    }
                      return ret;
                  },
            "sClass": "hidden-xs" 
          }
        ],  

        // Row Grouping berdasarkan kolom ke 1 : album_title
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        },

        "lengthMenu": [[20, 50, 100, 200], [20, 50, 100, 200]],
        "order": [[ 2, 'desc' ], [ 3, 'desc' ]],  // default order: album_date, album_id
        "sPaginationType": "full_numbers",
         aoColumnDefs: [
            {
              bSortable: false,
              aTargets: [0]
            },
            { "width": "8%", "targets": [0,6] }
          ]            
    });

// Hide column 1 : album_title
dataTable.fnSetColumnVis([1,2,3], false );

}).call(this);    

function delete_id(id)
{
   var c= confirm("Anda akan menghapus Foto ini secara permanen. Teruskan?");
   if(c==true)
   {
      window.location.replace("photo/delete/"+id);
   }
   return false;
};

function publish(id)
{
    if(confirm('Action ini akan mem-publish foto pada satu album. Lanjutkan? \n')) window.location.replace('photo/publish/'+id);
    return false;
};