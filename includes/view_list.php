<?php
include 'functions.php';

viewlist();

?>
<script>
      $(document).ready(function(){

        let list_item =  $('.list_item');
      let i;
      
      for(i = 0; i < list_item.length; i++){
        list_item[i].addEventListener("click",function(){
            let task_container = this.nextElementSibling;   
         
         if(task_container.style.maxHeight){
             task_container.style.maxHeight = null;
         }else{
             task_container.style.maxHeight = "100%" ;
// task_container.scrollHeight + "px"
         }
        })
     
      }

        //submit add task form
        $('#form_add_task').submit(function(e){
        e.preventDefault();

      let postData = $(this).serialize();
      
      $.post("includes/add_task.php",postData,function(data){
        $('#feedback_task').html(data);
     $('#form_add_task')[0].reset();

      })
         //display tasks
    setTimeout(function() {  displayList(); }, 1000);
  
      });

            function displayList(){
          $.ajax({
            url: "includes/view_list.php",
            type:'post',
            success:function(show_list){
              if(!show_list.error){
                $('#view_list').html(show_list);


              }
              
            }

          })
      }


      //delete list
      $('.del_list').click(function(){
        let del_id = $(this).attr('list-id');

        let confirmalert = confirm("Are you sure you want to delete?");
if (confirmalert == true) {
      $.post("includes/delete_list.php",{del_id:del_id},function(data){
   
        $('.feedback_list').html(data);
            //display tasks
    setTimeout(function() {  displayList(); }, 1000);
     
      });
    }
      });

      $('.edit_list').click(function(){
        let edit_id = $(this).attr('list-id');
        $.post("includes/update_list.php",{edit_id:edit_id},function(data){

            $('#edit_list').html(data);

        });

      });

    ///delete task
      $('.del_task').click(function(){
        let task_id = $(this).attr('task-id');
        var confirmalert = confirm("Are you sure you want to delete?");

        if (confirmalert == true) {
        $.post("includes/delete_task.php",{task_id:task_id},function(data){
          $('.feedback_task').html(data);
          setTimeout(function() {  displayList(); }, 1000);

        });
    }

      });

      //checked task
     
    $('.check_box').change(function(){
    let task_id = $(this).attr('task-id');
    let checked = 'checked';
    let uncheck = 'uncheck';
     if(this.checked){

      $.post("includes/check_task.php",{task_id:task_id,checked:checked},function(data){
        $('.feedback_task').html(data)

      });

     }else{
      $.post("includes/check_task.php",{task_id:task_id,uncheck:uncheck},function(data){
        $('.feedback_task').html(data)

      });
      

     } 
    });

 //search list using search
    $('#search').keyup(function(){
  let text = $(this).val().toUpperCase();
  let list = $('.list_item');
  // let list_name = $('.list_item').attr('list-name');
   
  for(i = 0;i < list.length;i++){
   let list_name = list[i].getAttribute('list-name');
    if(list_name.toUpperCase().indexOf(text) > -1){
      list[i].style.display = "";
    }else{
      list[i].style.display = "none";
    }

  }
   });
    
 
    

      })//document
</script>