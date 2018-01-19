<div class="col-md-12">
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-sm  btn-primary" data-toggle="modal" id="user_add">
 Add User
</button>
<button type="button"  class="btn btn-sm btn-round btn-danger pull-right" id="deleteData" data-toggle="confirmation" data-singleton="true"><i class="fa fa-trash-o"></i> Hapus Data</button>
<hr>

	<table class="table table-bordered" id="tb_users">
		<thead>
			<tr class="bg-info text-light">
				<th>No</th>
				<th>Username</th>
				<th>Role</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>


<!-- The Modal -->
<div class="modal fade" id="modal_form">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form  method="POST" class="form" accept-charset="utf-8" id="user_form" enctype="multipart/form-data">
	        <input type="hidden" name="id" id="id_user" />
        	<div class="form-group">
        		<label>Username :</label>
        		<input type="text" name="username" id="username" class="form-control" required="">
        	</div>
        	<div class="form-group">
        		<label>Password :</label>
        		<input type="password" name="password" id="password" class="form-control" required="">
        	</div>
        	<div class="form-group">
        		<label>Role :</label>
        		<select class="form-control" name="role" id="role">
        			<option value="" selected disabled>Pilih Role</option>
        			<option value="1">Admin</option>
        		</select>
        	</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="in_user" onclick="saveData();">Submit</button>
        </form>
        <button type="button" class="btn btn-secondary" id="btn-close" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<link rel="stylesheet" type="text/css" href="assets/css/jquery-confirm.min.css">    
<script type="text/javascript" src="assets/js/jquery-confirm.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.select.min.js"></script>

<script type="text/javascript">

	var tbl;
	var notif;
	
	jQuery(document).ready(function($) {

		$('#user_add').click(function(event) {
			$('#username').val("");
			$('#password').val("");
			$('#role').val("");
			$('#id_user').val("0");
			$("#modal_form").modal({
			    show     : true,
			    backdrop : 'static',
			    keyboard : false,
			});
		});
		
		tbl= $('#tb_users').DataTable( {
			bJQueryUI: true,
			sPaginationType: "full_numbers",
		    "ajax" : "loginuser_process.php?action=get",
		    select: {
		        style: 'multi+shift',
		    },
		    columnDefs: [                
		        {
		            "orderable": false,
		            "className": 'select-checkbox',
		            "targets": 0,
		            "data":null,
		            "defaultContent": "",
		            "width":"5%"
		        },
		        {
		            "data":"username",
		            "targets": 1
		        },
		        {
		            "data":"level",
		            "targets": 2,
		            "render":function(data,type,full,meta){
		            	if(data==1){
		            		return "Admin";
		            	}

		            	return "";
		            }
		        },
		        {
		            "data":null,
		            "width" : '5%',
		            "targets": 3,
		            "render":function(data, type, full, meta ){
		            	return '<center><button class="btn btn-info btn-sm edit-btn" title="edit data"><i class="fa fa-edit"></i> Edit</button></center>';
		            }
		        },
		    ],
		    select: {
		        style:    'os',
		        selector: 'td:first-child'
		    },
		    order: [[ 1, 'asc' ]]
		});

		tbl.on( 'order.dt search.dt', function () {
		        tbl.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
		            cell.innerHTML = i+1;
		        } );
		    } ).draw();
	    

	    $('#deleteData').click( function(){
            /* get selected row count and its data */
            var count = tbl.rows('.selected').data().length;
            var item = tbl.rows('.selected').data();
            var delcount=0;

            /* perform deletion */
            if(count > 0){ /* if has selected count >= 1 */
            	
            	$.confirm({
            		theme: 'bootstrap',
            	    title: 'Hapus Data',
            	    content: 'Hapus '+ count +' yang telah dipilih?',
            	    icon: 'fa fa-warning',
            	    buttons: {
            	        confirm: function () {
            	            for (var i = 0; i <= count - 1; i++) {
                                var did=item[i]['id'];
                                $.post( 'loginuser_process.php?action=del&id=' + did).success(function(data){
                                	var result = jQuery.parseJSON(data);

                                	tbl.ajax.reload(); 
                                });


                            };
                        	
            	        },
            	        cancel: function () {
            	            
            	        },
            	    }
            	});

            	
               
            }else{

            	$.alert({
            		theme: 'bootstrap',
            	    title: 'Hapus Data',
            	    icon: 'fa fa-warning',
            	    content: 'Tidak ada data yang terpilih untuk dihapus!',
            	});            
            }
        });

        $('#tb_users tbody').on('click', '.edit-btn', function () {
	        $('#modal_form').modal();
	        $('#username').val(tbl.row($(this).parents('tr')).data().username);
	        $('#password').val("");
	        $('#role').val(tbl.row($(this).parents('tr')).data().level).change();
	        $('#id_user').val(tbl.row($(this).parents('tr')).data().id);
	    }); 
	});

	function saveData(){

		if($('#username').val()==''){
			$('.alert-div').fadeIn('slow');
		}else{
			$.ajax({
			    url: 'loginuser_process.php',
			    type: 'POST',
			    data: {
			        username: $('#username').val(),
			        password:$('#password').val(),
			        role : $('#role').val(),
			        id:$('#id_user').val(),
			        action:'add'
			    },
			    success: function(data){
			    	var result = jQuery.parseJSON(data);
			        document.getElementById("user_form").reset();		        
			      	$('#display_icon').val("").change();
			        $('#btn-close').trigger('click');
			        tbl.ajax.reload();
			        
			    }
			});
		}
	}

	function editData(){
		$.ajax({
		    url: 'loginuser_process.php',
		    type: 'POST',
		    data: {
		        username: $('#username').val(),
		        password:$('#password').val(),
		        role : $('#role').val(),
		        id:$('#id').val(),
		        action:'add'
		    },
		    success: function(data){

		    	var result = jQuery.parseJSON(data);

		        document.getElementById("form_data_edit").reset();
		      
		        tbl.ajax.reload();
		        $('#modal_form').modal('toggle');

		        $.gritter.add({
	                // (string | mandatory) the heading of the notification
	                title: 'Ubah Data',
	                sticky: false,
                    time: '5000',
                    text: result.msg,
	            });
		    }
		});
	}
</script>