<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          @include('admin.includes.side_bar')
        </div>

        <!-- top navigation -->
        @include('admin.includes.top_panel')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Sequrity Questions <small id="notify_message"></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> -->
                      <li><a class="" href="{{ url('admin/add_security_questions')}}"><i class="fa fa-plus"></i> Add New</a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      
                    </p>
                    <table id="sc_questions" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Security Question</th>
                            <th>Status</th>
                            <th>Posted Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                      
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
         @include('admin.includes.footer')
        <!-- /footer content -->
      </div>
    </div>

    @include('admin.includes.script')
	
    <script>
        $(document).ready(function() {
            $('#sc_questions').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax":{
                   url :"{{url('admin/response_questions_list')}}",
                   type: "get",  
                   error: function(){
                     $("#employee_grid_processing").css("display","none");
                   }
                 },
                 "columnDefs": [ { orderable: false, targets: [4] } ]
            } );
        } );

        function change_security_question_status(questionID,this_id){
          $.ajax({
            type:"POST",
            url:"{{url('admin/change_security_questions_status')}}",
            data:{questionID:questionID,"_token": "{{ csrf_token() }}"},
            success: function(resp){
              if(resp=='true'){
                $(this_id).parent('td').find('span').removeClass('label_status-danger').addClass('label_status-success').html('Active');
                $.notify(
                      "Question Activated Successfully",
                      "success"
                );
              }
              else if(resp=='false'){
                $(this_id).parent('td').find('span').removeClass('label_status-success').addClass('label_status-danger').html('In Active');
                $.notify(
                      "Question In-activated Successfully",
                      "error"
                );
              }
            }
          });
        }
    </script>
  </body>
</html>
