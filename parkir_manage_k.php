<div class="col-md-12">

<h2>
	Histori Parkir Keluar
</h2>

<hr>

<a href="change_status_gerbang.php?ig=2" class="btn btn-sm btn-info">Buka / Tutup Gerbang</a>

<hr>

	<table class="table table-bordered" id="tb_users">
		<thead>
			<tr class="bg-info text-light">
				<th>No</th>
				<th>Nama</th>
				<th>Plat</th>
				<th>Gambar</th>
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
        <h4 class="modal-title">Add Plat Number</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form  method="POST" class="form" accept-charset="utf-8" id="user_form" enctype="multipart/form-data">
	        <input type="hidden" name="idp" id="id_parkir" />
        	<div class="form-group">
        		<label>Plat Number :</label>
        		<input type="text" name="no_plat" id="no_plat" class="form-control" required="">
        	</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="in_user" onclick="editData();">Submit</button>
        </form>
        <button type="button" class="btn btn-secondary" id="btn-close" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="detail">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">User Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        	<div class="form-group">
        		<label>Name :</label>
        		<h4 type="text" name="user_name" id="user_name"  > </h4>
        	</div>
        	<div class="form-group">
        		<label>E-mail :</label>
        		<h4 type="email" name="user_email" id="user_email"  > </h4>
        	</div>
        	<div class="form-group">
        		<label>Address :</label>
        		<h4 name="user_address" id="user_address" > </h4>
        	</div>
        	<div class="form-group">
        		<label>Phone Number :</label>
        		<h4 type="number" name="user_phone" id="user_phone"  ></h4>
        	</div>
        	<div class="form-group">
        		<label>Plate Number</label>
        		<h4 type="text" name="user_plate_number" id="user_plate_number"  ></h4>
        	</div>
        	<div class="form-group">
        		<img src="" class="img img-responsive" id="img" style="widows: 250px; height: 310px;" alt="">
        	</div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<link rel="stylesheet" type="text/css" href="assets/css/jquery-confirm.min.css">
<script type="text/javascript" src="assets/js/jquery-confirm.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.select.min.js"></script>

<script type="text/javascript">

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
			});


	var tbl;
	var notif;

	jQuery(document).ready(function($) {

		tbl= $('#tb_users').DataTable( {
			bJQueryUI: true,
			sPaginationType: "full_numbers",
		    "ajax" : "parkir_process_k.php?action=get",
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
		            "data":"user_name",
		            "targets": 1
		        },
		        {
		            "data":"nomor_plat",
		            "targets": 2
		        },
		        {
		        	"targets" : 1,
		        	"orderable": false,
		        	"render" : function(data,type,full,meta){
		        		if (full.user_name == null) {
		        			return "<center>unknown</center>";
		        		}else{
		        			return "<center> <a href='javascript:void(0)' data-toggle='modal' onclick='detail(\""+full.nomor_plat+"\")' title='Detail' class='label label-info'>"+full.user_name+"</a></center>";
		        		}

		            }
		        },{
		        	"targets" : 2,
		        	"orderable": false,
		        	"render" : function(data,type,full,meta){
		        		if (full.nomor_plat == "") {
		        			var no_plat = '<center><button class="btn btn-xs btn-info btn-sm edit-btn" ><i class="fa fa-edit"></i> Insert</button></center>';
		        			return "<center> Can't Detect Plate Number "+no_plat+"</center>";
		        		}else{
		        			return "<center>"+full.nomor_plat+"</center>";
		        		}

		            }
		        },{
		        	"targets" : 3,
		        	"data"    : 'img',
		        	"render" : function(data,type,full,meta){
		          		var img = "<a rel='example_group' href='"+data+"' class=''><img src='"+data+"' class='img-thumbnail iframe' width='50' height='35' /></a>";
		          		return "<center>"+img+"</center>";
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


		$('#tb_users tbody').on('click', '.edit-btn', function () {
	        $('#modal_form').modal();
	        $('#id_parkir').val(tbl.row($(this).parents('tr')).data().id_parkir);
	    });

			setInterval(function refresh_table(){
				tbl.ajax.reload();
			}, 1000);

	});


	function editData(){
		$.ajax({
		    url: 'parkir_process_k.php',
		    type: 'POST',
		    data: {
		        no_plat: $('#no_plat').val(),
		        idp:$('#id_parkir').val(),
		        action:'add'
		    },
		    success: function(data){

		    		var result = jQuery.parseJSON(data);

		        tbl.ajax.reload();
		        // $('#modal_form').modal('hid');
		        $('#btn-close').trigger('click');

		    }
		});
	}

	function detail(no_p){
		$.ajax({
			url: 'parkir_process_k.php',
			type: 'POST',
			data: {
				action:'detail',
				no_plat:no_p
			},
			success: function(data){
			var result = jQuery.parseJSON(data);
				$('#detail').modal();
				$('#test').append(result.user_id);
				$('#user_id').text(result.user_id);
				$('#user_name').text(result.user_name);
				$('#user_email').text(result.user_email);
				$('#user_address').text(result.user_address);
				$('#user_phone').text(result.user_phone);
				$('#user_plate_number').text(result.user_plate_number);
				$('#img').attr('src',result.user_image);

			}
		});

	}

</script>
