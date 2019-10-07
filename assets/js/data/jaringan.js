(function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#kantorcabang_table').dataTable( {
        destroy       : true,
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : BASEURL + "jaringan/json_kantorcabang",
        "columns": [
          { "data": "branch_id" },       
          { "data": "branch_name" },
          { "data": "branch_address" },
          { "data": "branch_phone" },
          { "data": "branch_fax" }
        ],  
      "lengthMenu": [[20, 50, 100, 200], [20, 50, 100, 200]],
      "order": [[ 0, "asc" ]],  // default order
      "sPaginationType": "full_numbers",
          aoColumnDefs: [
            {
              bSortable: false,
              aTargets: [1,2,3,4]  // kolom #1 tidak bisa sorting
            },
          ],
      "fnDrawCallback": function ( oSettings ) {
          for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ ) {
              $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
          }    
      }            
    });
    
    
      //dataTable.fnSetColumnVis([0], false );  // hide kolom #0
}).call(this);

(function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#kantorkas_table').dataTable( {
        destroy       : true,
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : BASEURL + "jaringan/json_kantorkas",
        "columns": [
          { "data": "kas_id" },
          { "data": "kas_name" },
          { "data": "kas_address" },
          { "data": "kas_phone" },
          { "data": "kas_fax" }
        ],  
      "lengthMenu": [[20, 50, 100, 200], [20, 50, 100, 200]],
      "order": [[ 0, "desc" ]],  // default order
      "sPaginationType": "full_numbers",
          aoColumnDefs: [
            {
              bSortable: false,
              aTargets: [1,2,3,4]  // kolom #1 tidak bisa sorting
            },
          ],
      "fnDrawCallback": function ( oSettings ) {
          for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ ) {
              $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
          }    
      }            
    });

    //dataTable.fnSetColumnVis([0], false );  // hide kolom #0

}).call(this);

(function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#lokasiatm_table').dataTable( {
        destroy       : true,
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : BASEURL + "jaringan/json_lokasiatm",
        "columns": [
          { "data": "atm_id" },
          { "data": "atm_location" },
          { "data": "atm_address" }
        ],  
      "lengthMenu": [[20, 50, 100, 200], [20, 50, 100, 200]],
      "order": [[ 0, "desc" ]],  // default order
      "sPaginationType": "full_numbers",
          aoColumnDefs: [
            {
              bSortable: false,
              aTargets: [1]  // kolom #1 tidak bisa sorting
            },
          ],
      "fnDrawCallback": function ( oSettings ) {
          for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ ) {
              $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
          }    
      }            
    });

    //dataTable.fnSetColumnVis([0], false );  // hide kolom #0

}).call(this);

(function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#paymentpoint_table').dataTable( {
        destroy       : true,
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : BASEURL + "jaringan/json_paymentpoint",
        "columns": [
          { "data": "pp_id" },
          { "data": "pp_location" },
          { "data": "pp_address" },
          { "data": "pp_phone" },
          { "data": "pp_fax" }
        ],  
      "lengthMenu": [[20, 50, 100, 200], [20, 50, 100, 200]],
      "order": [[ 0, "desc" ]],  // default order
      "sPaginationType": "full_numbers",
          aoColumnDefs: [
            {
              bSortable: false,
              aTargets: [1,2,3,4]  // kolom #1 tidak bisa sorting
            }
          ],
      "fnDrawCallback": function ( oSettings ) {
          for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ ) {
              $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
          }    
      }            
    });

    //dataTable.fnSetColumnVis([0], false );  // hide kolom #0

}).call(this);

(function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#office_channeling_table').dataTable( {
        destroy       : true,
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : BASEURL + "jaringan/json_office_channeling",
        "columns": [
          { "data": "oc_id" },       
          { "data": "oc_name" },
          { "data": "oc_address" },
          { "data": "oc_phone" },
          { "data": "oc_fax" }
        ],  
      "lengthMenu": [[20, 50, 100, 200], [20, 50, 100, 200]],
      "order": [[ 0, "asc" ]],  // default order
      "sPaginationType": "full_numbers",
          aoColumnDefs: [
            {
              bSortable: false,
              aTargets: [1,2,3,4]  // kolom #1 tidak bisa sorting
            },
          ],
      "fnDrawCallback": function ( oSettings ) {
          for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ ) {
              $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
          }    
      }            
    });
    
    
      //dataTable.fnSetColumnVis([0], false );  // hide kolom #0
}).call(this);

(function() {    
    var base = window.location.href;  // -> http://cms.blabla.com/user
    var dataTable = $('#mobil_kas_table').dataTable( {
        destroy       : true,
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : BASEURL + "jaringan/json_mobil_kas",
        "columns": [
          { "data": "mk_id" },       
          { "data": "mk_name" },
          { "data": "mk_address" }
        ],  
      "lengthMenu": [[20, 50, 100, 200], [20, 50, 100, 200]],
      "order": [[ 0, "asc" ]],  // default order
      "sPaginationType": "full_numbers",
          aoColumnDefs: [
            {
              bSortable: false,
              aTargets: [1,2]  // kolom #1 tidak bisa sorting
            },
          ],
      "fnDrawCallback": function ( oSettings ) {
          for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ ) {
              $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
          }    
      }            
    });
    
    
      //dataTable.fnSetColumnVis([0], false );  // hide kolom #0
}).call(this);


