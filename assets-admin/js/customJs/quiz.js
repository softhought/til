
$(document).ready(function() {
    var basepath = $("#basepath").val();
    
  
    startTimer();
  
   // window.location.href = basepath+"question/result/10";
     
    $(document).on('click', '.answeroption', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var question_dtl_id = $(this).attr("data-questiondtl");
        var selectedoption = $(this).attr("data-selectedoption");
      //  var currRowID = $(this).attr('id');
      //  var rowDtlNo = currRowID.split('_');
  
       var questionset_master_id=$("#questionset_master_id").val();
       var quiz_master_id=$("#quiz_master_id").val();
      //  var inv_id = rowDtlNo[1];
      let question_number = $("#lastQuestion").val();
  
                  /* Disable button */
                    $("#btn_"+question_dtl_id+"_option_1").prop('disabled', true);
                    $("#btn_"+question_dtl_id+"_option_2").prop('disabled', true);
                    $("#btn_"+question_dtl_id+"_option_3").prop('disabled', true);
                    $("#btn_"+question_dtl_id+"_option_4").prop('disabled', true);
  
                    $("#btn_"+question_dtl_id+"_"+selectedoption).addClass("selectbtn");
       
  
            var urlpath = basepath + 'question/quiz_answer_action';
  
            $.ajax({
                type: "POST",
                url: urlpath,
                data: { 
                  questionset_master_id:questionset_master_id,
                  quiz_master_id:quiz_master_id,
                  question_dtl_id: question_dtl_id,
                  selectedoption: selectedoption,
                  question_number: question_number,
                },
                dataType: "json",
                timeout: 3000, // Set timeout to 3 seconds (3000 milliseconds)
                success: function(result) {
                    if (result.msg_status == 1) {
                      
                      $("#btn_"+question_dtl_id+"_"+selectedoption).removeClass("selectbtn");
                  
                      $("#total_score").html(" "+result.total_score);
                       
                      let btn_id="#btn_"+question_dtl_id+"_"+selectedoption;
                        if (result.answer_status==1) {
                          $(btn_id).removeClass("blue-btn");
                          $(btn_id).addClass("green-btn");
                          $(btn_id).append('   <i class="fas fa-check"></i>');
                        } else {
                          $(btn_id).removeClass("blue-btn");
                          $(btn_id).addClass("red-btn");
                          $(btn_id).append('   <i class="fas fa-times"></i>');
  
                          $("#btn_"+question_dtl_id+"_"+result.correct_answer).removeClass("blue-btn");
                          $("#btn_"+question_dtl_id+"_"+result.correct_answer).addClass("green-btn");
                        }
  
                    }
  
                  
  
                    if (question_number==10) {
                       window.location.href = basepath+"question/prizelist/"+quiz_master_id;
                    } else {
                        /* Redirect to Next Question */                     
                        setTimeout(function() { nextQuestion(); }, 1000);
                     // nextQuestion();
                        
                    }
  
                    
  
                    
  
                },
                error: function(jqXHR, textStatus, errorThrown) {
  
                    $("#btn_"+question_dtl_id+"_"+selectedoption).removeClass("selectbtn");
                    /* enable button */
                    $("#btn_"+question_dtl_id+"_option_1").prop('disabled', false);
                    $("#btn_"+question_dtl_id+"_option_2").prop('disabled', false);
                    $("#btn_"+question_dtl_id+"_option_3").prop('disabled', false);
                    $("#btn_"+question_dtl_id+"_option_4").prop('disabled', false);
                 
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    // alert(msg);  
                }
            });
  
  
    });
  
   });
  
  
   function nextQuestion(){
     $('#timer').text("25");
     $(".questionDiv").hide();
     let lastQuestion=parseInt($("#lastQuestion").val());

    /* Second check to skip after 10 question */
   

     let nextQuestion = lastQuestion + 1;
     $("#lastQuestion").val(nextQuestion);
     $("#question_num_count").text(nextQuestion);
     $("#question_"+nextQuestion).show();
     startTimer();// Reset Timmer
     
   }
  
  
   function finalSubmit(){
  
   }
  
   var timer; // Declare timer variable outside the function scope
   function startTimer(){
    
    // Clear the previous interval if it exists
    clearInterval(timer);
    var seconds = 25;
       timer = setInterval(function(){
          seconds--;
          var formattedSeconds = seconds < 10 ? '0' + seconds : seconds;
          $('#timer').text(formattedSeconds);
          if(seconds <= 0){
              clearInterval(timer);
              // Perform actions when timer ends
              // $('#anil').trigger('click');
              let basepathurl = $("#basepath").val();
              var quiz_master_id=$("#quiz_master_id").val();
              let question_number = $("#lastQuestion").val();
              if (question_number > 9) {
                window.location.href = basepathurl+"question/prizelist/"+quiz_master_id;
             }
                nextQuestion();
             
             
              // Add any additional actions you want to perform
          }
      }, 1000);
  }