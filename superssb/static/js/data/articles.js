
  (function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#dynamic_table').dataTable( {
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : base + "/json",
        "deferRender": true,
        "columns": [
          { "data": "c_id" },
          { "data" : function ( data, type, full, meta ) {
              var btn_group='<div class="btn-group">'+
                      '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button">Actions <span class="caret"></span></button>'+
                      '<ul role="menu" class="dropdown-menu">'+
                          '<li><a href="javascript:;" onclick="edit_data('+data.c_id+')"><i class="fa fa-pencil"></i> Edit</a></li>'+
                          '<li><a href="javascript:;" onclick="delete_data('+data.c_id+')"><i class="fa fa-trash-o"></i> Delete</a></li>'+
                          '<li class="divider"></li>'+
                          '<li><a href="javascript:;" onclick="publish('+data.c_id+')"><i class="fa fa-check"></i> Publish </a></li>'+
                      '</ul>'+
                  '</div>';
              return btn_group;
              }, "class": "actions"
          },
          { "data": "c_publish_date"},
          //{ "data": "c_title" },
          { "data": function ( data, type, full, meta ) {
                    if( data.c_subtitle !=''){ 
                      ret='<small><em>'+data.c_subtitle+'</em></small><br />'+data.c_title; 
                    }else if (data.c_content_type == 'video'){
                      ret='<small><em> Video </em></small><br />'+data.c_title; 
                    }else{
                      ret=data.c_title; 
                    }
                      return ret;
                  }, "sClass": "hidden-xs" 
          },
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
          { "data"  : function ( data, type, full, meta ) {
                      var myDate = data.c_created_date;
                      var myDate = myDate.split(' ');
                      var arr = myDate[0].split('-');
                      var ret='<img width="100px" src="'+imagesURL+'/posts/'+arr[0]+'/'+arr[1]+'/'+arr[2]+'/'+data.c_id+'/'+data.c_images_thumbnail+'" alt="" />';
                      return ret;
                  },
            "sClass": "hidden-xs"          
          },
          { "data": "ch_name" },
          { "data": "fe_name" },
          { "data": function ( data, type, full, meta ) {
                    if( data.authorName =='OTHERS'){ 
                      ret=data.c_author_name;
                    }else{
                      ret=data.authorName; 
                    }
                      return ret;
                  }, "sClass": "hidden-xs" 
          }
        ],  
      "lengthMenu": [[20, 50, 100, 200], [20, 50, 100, 200]],
      "order": [[ 2, "desc" ]],  // default order
      "aaSorting": [],
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

var base_uri = window.location.href;
var base     = window.location.pathname;
var baseURL  = someFunction(baseURL);



function edit_data(id) {
    window.location.href = base_uri + '/edit/' + id;
    return false;
}
function thumb_data(id) {
    window.location.href = base_uri + '/thumbnail/' + id;
    return false;
}
function delete_data(id) {
  var c= confirm("Anda yakin Hapus ?");
  if(c==true){
    window.location.href = base_uri  + '/delete/' + id;
  }
  return false;
}

function someFunction(site)
{
// if site has an end slash (like: www.example.com/),
// then remove it and return the site without the end slash
return site.replace(/\/$/, '') // Match a forward slash / at the end of the string ($)
}

function publish(id)
{
    if(confirm('Action ini akan mem-publish Artikel yang dipilih. Lanjutkan? \n')) window.location.replace(base_uri+'/publish/'+id);
    return false;
};