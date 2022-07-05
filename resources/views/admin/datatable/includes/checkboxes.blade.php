






        $('#main-table tbody').on('click','.checkboxes',function (event) {
          if($(this).prop('checked')==false){
            $('#checkbox_all').prop('checked',false);
            if($('.checkboxes').filter(':checked').length==0){
              $('.selectButton').addClass('hide');}
            }else {
              if($('.selectButton').hasClass('hide')){
                $('.selectButton').removeClass('hide');
              }
          }
        });


        //stop Propagation on delete and edit buttons
        $('#main-table tbody').on('click','#deleteOneForm',function (event) {
         event.stopPropagation()
        });
        $('#main-table tbody').on('click','#editUsers',function (event) {
         event.stopPropagation()
        });

        $('#checkbox_all').on('click',function(){

          if($(this).prop('checked')==true){

            //check if the filter is applied or not before checking checkboxes
            //aslo check if all rows in one page or not
            var filterApplied=false;
            var currentPApplied=false;
            var length=0;
            var allLen=table.rows().data().length;
            var currentP=table.rows({ page: 'current' }).data();
            var filter=table.rows({filter: 'applied'},{ page: 'current' } ).data();

            //check if the search filter is on or not
             if(allLen!=filter.length){
               filterApplied=true;
             }
             //check if all rows in one page or more than one
             if(currentP.length!=allLen){
               currentPApplied=true;

             }

             if(filterApplied==true){
               length=filter.length;
             }else if(currentPApplied==true){
               length=currentP.length;
             }else{
               length=allLen;
             }

             if(length!=0){ //if the search filter retruns no rows
                if($('.selectButton').hasClass('hide')){
                   $('.selectButton').removeClass('hide');
                 }
                 for(var i=0;i<length;i++){
                   var attempt=filter[i][0].split(" ");
                   var id=(attempt[3]).replace('data-id=','').replace(/(^")|("$)/g, "");
                   $('#checkbox_'+id).prop('checked',true);
                 }
               }//end length if
          }else {
             $('.checkboxes').prop('checked',false);
             if(!$('.selectButton').hasClass('hide')){
                $('.selectButton').addClass('hide');
              }
          }
        });

    //unselect and uncheck all if new filter applied
     $('#main-table_filter').on('keyup','input',function(){
       $('#checkbox_all').prop('checked',false);
       $('.checkboxes').prop('checked',false);
     });

     $('[name="main-table_length"]').on('change',function(){
         $('#checkbox_all').prop('checked',false);
         $('.checkboxes').prop('checked',false);
     });
