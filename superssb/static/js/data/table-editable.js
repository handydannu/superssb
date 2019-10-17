
            //restoreRow
            function restoreRow ( oTable, nRow )
            {
                var aData = oTable.fnGetData(nRow);
                
                if ( aData != null ) {
          
                    var jqTds = $('>td', nRow);
    
                    for ( var i=0, iLen=jqTds.length ; i<iLen ; i++ ) {
                        oTable.fnUpdate( aData[i], nRow, i, false );
                    }
                }
            }
            //editRow
            function editRow ( oTable, nRow )
            {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);  
                
                if ( aData == null ) {
                    jqTds[1].innerHTML = '<input value=" " type="text">';
                    jqTds[2].innerHTML = '<input value=" " type="text">';
                } else {
                    jqTds[1].innerHTML = '<input value="'+aData[1]+'" type="text">';
                    jqTds[2].innerHTML = '<input value="'+aData[2]+'" type="text">';

                }
                jqTds[4].innerHTML = '<a class="save" href="">Save</a> <a class="cancel" href="">Cancel</a>';
            }
            //saveRow
            function saveRow ( oTable, nRow )
            {   
                var jqInputs = $('input', nRow);
                oTable.fnUpdate( jqInputs[0].value, nRow, 1, false );
                oTable.fnUpdate( jqInputs[1].value, nRow, 2, false );
                
                var row_id = nRow.id;
                        
                var mydata = 'id=' + row_id.substring(4,10) +
                    '&partnernumber=' +  jqInputs[0].value +
                    '&partnername=' +  jqInputs[1].value;

                $.ajax( {
                    dataType: 'html',
                    type: "POST",
                    url: "PartnersUpdate.php",
                    cache: false,
                    data: mydata,
                    success: function () { 
                        //alert('Record saved successfully.'); 
                    },
                    error: function() {alert('Save failed.');},
                    complete: function() {}
                } );
                
            }
            //copyRow
            function copyRow ( oTable, nRow )
            {     
                var aData = oTable.fnGetData(nRow);
                
                if ( aData != null ) {
                    var mydata =  
                        'id=' +  aData[0] +
                        '&partnernumber=' +  aData[1] +
                        '&partnername=' +  aData[2];
                }
                
                $.ajax( {
                    dataType: 'html',
                    type: "POST",
                    url: "PartnersAddCopy.php",
                    cache: false,
                    data: mydata,
                    success: function () { 
                        //alert('Record copied successfully.'); 
                    },
                    error: function() {alert('Copy failed.');},
                    complete: function() {
                        oTable.fnDraw();
                    }
                } );
                
            }
            //copyRow
            function addEmptyRow ( oTable, nRow )
            {                                     
                var mydata = 'id=Null';

                $.ajax( {
                    dataType: 'html',
                    type: "POST",
                    url: "PartnersAddCopy.php",
                    cache: false,
                    data: mydata,
                    success: function () { 
                        //alert('Record created successfully.'); 
                    },
                    error: function() {alert('Create failed.');},
                    complete: function() {
                        oTable.fnDraw();
                    }
                } );
   
            }
            //deleteRow
            function deleteRow ( oTable, nRow)
            {
                if (confirm("Confirm deletion?")) {

                    var row_id = nRow.id;
                    var mydata = 'id=' + row_id.substring(4,10);
                        
                    $.ajax( {
                        dataType: 'html',
                        type: "POST",
                        url: "PartnersDelete.php",
                        cache: false,
                        data: mydata,
                        success: function () {
                            oTable.fnDeleteRow( nRow );
                            oTable.fnDraw();
                        },
                        error: function() {},
                        complete: function() {}
                    } );
                
                    
                }
            }

            /*
             * Main javascript setup and 
             * 
             */
            $(document).ready(function(){
                
                var nEditing = null; //CRUD
                
                var aSelected = [];  //Row selection
                    
                var oTable = $('#datatables').dataTable({  
                    "bProcessing": true,
                    "bServerSide": true,                     //Server
                    "sAjaxSource": "/bola_klasemen/json", //PHP Source
                    "sServerMethod": "POST",                 //Override default GET           
                    "sPaginationType":"full_numbers",        //Paginations 
                    "aaSorting":[[2, "desc"]],
                    "aoColumns": [                           //Row control
                      { "data": "klas_p","sClass": "hidden-xs" },
                      { "data": "klas_w","sClass": "hidden-xs" },
                      { "data": "klas_d","sClass": "hidden-xs" },
                      { "data": "klas_l","sClass": "hidden-xs" },
                      { "data" : function ( data, type, full, meta ) {
                          var ret='<td class="actions"><div align="center" class="action-buttons"><a class="edit" href="javascript:;"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-pencil"></i></button></a> <a class="delete" href="javascript:;"><button class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash-o"></i></button></a></div></td>';
                          return ret;
                         }
                      }
                    ],         
                    "oColReorder": {
                        "iFixedColumns": 1
                    },
                    "bJQueryUI":true,                        //ThemeRoller
                    "sScrollX": "100%",                      //Scroller
                    "sScrollXInner": "110%",
                    "bScrollCollapse": true                   
                });
                
                
                /* Click event for Multiselect*/
                $('#datatables tbody tr').live('click', function () {
                    var id = this.id;
                    var index = jQuery.inArray(id, aSelected);
         
                    if ( index === -1 ) {
                        aSelected.push( id );
                    } else {
                        aSelected.splice( index, 1 );
                    }
         
                    $(this).toggleClass('row_selected');
                } );
                
                //Window adjust triggers table adjust
                $(window).bind('resize',function(){
                    oTable.fnAdjustColumnSizing(); 
                });
                   
                //Edit event
                $('#datatables a.edit').live('click', function (e) {    
                    e.preventDefault(); //prevent loop back
                    /* Get the row as a parent of the link that was clicked on */
                    var nRow = $(this).parents('tr')[0];
                    if ( nRow ) {
                        //Restore current editing to original
                        if ( nEditing != null ) {
                            restoreRow( oTable, nEditing );
                        }        
                        //Edit a different row
                        nEditing = nRow;
                        editRow( oTable, nRow );
                    }
                });
                //Save event
                $('#datatables a.save').live('click', function (e ) {  
                    e.preventDefault(); //prevent loop back
                    saveRow( oTable, nEditing );
                    nEditing = null;
                } );                   
                //Delete event
                $('#datatables a.delete').live('click', function (e ) {  
                    e.preventDefault(); //prevent loop back
                    var nRow = $(this).parents('tr')[0];
                    if ( nRow ) {
                        deleteRow(oTable, nRow);
                        nEditing = null;
                    }
                } );
                //Cancel event
                $('#datatables a.cancel').live('click', function (e ) {  
                    e.preventDefault(); //prevent loop back
                    var nRow = $(this).parents('tr')[0];
                    if ( nRow ) {
                        restoreRow(oTable, nRow);
                        nEditing = null;
                        oTable.fnDraw();
                    }
                } );            
                //Copy event
                $('#datatables a.copy').live('click', function (e ) {  
                    e.preventDefault(); //prevent loop back
                    var nRow = $(this).parents('tr')[0];
                    if ( nRow ) {
                        copyRow(oTable, nRow);
                        nEditing = null;
                        oTable.fnDraw();                        
                    }
                } );  
                //New event
                $('#new').live('click', function ( e) { 
                    e.preventDefault(); //prevent loop back
                    addEmptyRow(oTable);        
                    nEditing = null;
                } );
                    
                    
                /* @TODO Finish Column Search
                      //Column search
                      $("tfoot input").keyup( function () {
                          // Filter on the column (the index) of this element 
                          oTable.fnFilter( this.value, $("tfoot input").index(this) );
                      } );
  
                      //Support functions to provide a little bit of 'user friendlyness' to the textboxes in

                      $("tfoot input").each( function (i) {
                          asInitVals[i] = this.value;
                      } );
     
                      $("tfoot input").focus( function () {
                          if ( this.className == "search_init" )
                          {
                              this.className = "";
                              this.value = "";
                          }
                      } );
     
                      $("tfoot input").blur( function (i) {
                          if ( this.value == "" )
                          {
                              this.className = "search_init";
                              this.value = asInitVals[$("tfoot input").index(this)];
                          }
                      } );

                 */
        
                /* end of ready */
            });