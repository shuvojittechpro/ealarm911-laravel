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
          

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>User Name</th>
                            <th>Join date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Serial Number</th>
                            <th>User Name</th>
                            <th>Join date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

          </div>
          <br />
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
            $('#example').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax":{
                   url :"{{url('admin/get_userlist')}}", // json datasource
                   type: "GET",  // type of method  ,GET/POST/DELETE
                   error: function(){
                     $("#employee_grid_processing").css("display","none");
                   }
                 }
            } );
        } );
    </script>
  </body>
</html>
