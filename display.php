<style>
	.left-side{
		position: absolute;
		width: calc(50%);
		height: calc(100%);
		left: 0;
		top:0;
		background: #FAFBFC;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.right-side{
		position: absolute;
		width: calc(50%);
		height: calc(100%);
		right: 0;
		top:0;
		background:gray;
	}
	.slideShow{
		display: flex;
		justify-content: center;
		align-items: center;
		width: calc(100%);
		height: calc(100%);
		padding: auto;
	}
	.slideShow img,.slideShow video{
		max-width: calc(100%);
		max-height: calc(100%);
		opacity: 0;
		transition: all .5s ease-in-out;
	}
	.slideShow video{
		width: calc(100%);
	}
	a.btn.btn-sm.btn-success {
    z-index: 99999;
    position: fixed;
    left: 1rem;
	}
	.card_header{
	border-radius: 20px 20px 0 0;
	}
	.card_border{
		border-radius: 20px;
		background-color: white;
	}
</style>
<?php include "admin/db_connect.php" ?>
<?php 
$tname = $conn->query("SELECT * FROM transactions where id =".$_GET['id'])->fetch_array()['name'];
function nserving(){
	include "admin/db_connect.php";

	$query = $conn->query("SELECT q.*,t.name as wname FROM queue_list q inner join transaction_windows t on t.id = q.window_id where date(q.date_created) = '".date('Y-m-d')."' and q.transaction_id = '".$_GET['id']."' and q.status = 1 order by q.id desc limit 1  ");
	if($query->num_rows > 0){
		foreach ($query->fetch_array() as $key => $value) {
			if(!is_numeric($key))
			$data[$key] = $value;
		}
		return json_encode(array('status'=>1,"data"=>$data));
	}else{
		return json_encode(array('status'=>0));

	}
	$conn->close();
}
?>
<a href="index.php" class="btn btn-sm btn-success"><i class="fa fa-home"></i> Home</a>
<div class="left-side">
	<div class="col-md-10 offset-md-1">
		<div class="card card_border">
			<div class="justify-content-center d-flex card_header" style="background-color:#7b1113">
				<label class="text-white h2 mt-3 mb-3 text-center"><b><?php echo $tname ?></b></label>
			</div>
			<div class="card-body">
				<h3 class="text-center" id="window"></h3>
			</div>
		</div>
		<div class="card card_border mt-5">
			<div class="justify-content-center d-flex card_header" style="background-color:#7b1113">
				<label class="text-white h2 mt-3 mb-3"><b>Now Serving</b></label>
			</div>
			<div class="card-body">
				<h3 class="text-center" id="sname"></h3>
				<h1 class="text-center" id="squeue"></h1>
				
			</div>
			</div>
	</div>
</div>
<div class="right-side">
	<?php
	$uploads = $conn->query("SELECT * FROM file_uploads order by rand() ");
	$slides = array();
	while($row= $uploads->fetch_assoc()){
		$slides[] = $row['file_path'];
	}
	?>
	<div class="slideShow">
		
	</div>
</div>
<script>
	var slides = <?php echo json_encode($slides) ?>;
	var scount = slides.length;
		if(scount > 0){
				$(document).ready(function(){
					render_slides(0)
				})
		}
	function render_slides(k){
		if(k >= scount)
			k = 0;
		var src = slides[k]
		k++;
		var t = src.split('.');
		var file ;
			t = t[1];
			if(t == 'mp4'){
				file = $("<video id='slide' src='admin/assets/uploads/"+src+"' onended='render_slides("+k+")' autoplay='true' muted='muted'></video>");
			}else{
				file = $("<img id='slide' src='admin/assets/uploads/"+src+"' onload='slideInterval("+k+")' />" );
			}
			console.log(file)
			if($('#slide').length > 0){
				$('#slide').css({"opacity":0});
				setTimeout(function(){
						$('.slideShow').html('');
				$('.slideShow').append(file)
				$('#slide').css({"opacity":1});
				if(t == 'mp4')
					$('video').trigger('play');

				
				},500)
			}else{
				$('.slideShow').append(file)
				$('#slide').css({"opacity":1});

							}
				
	}
	function slideInterval(i=0){
		setTimeout(function(){
		render_slides(i)
		},2500)

	}
	
	$(document).ready(function(){
		var queue = '';
		var renderServe = setInterval(function(){
			$.ajax({
				url:'admin/ajax.php?action=get_queue',
				method:"POST",
				data:{id:'<?php echo $_GET['id'] ?>'},
				success:function(resp){
					resp = JSON.parse(resp)
					$('#sname').html(resp.data.name)
					$('#squeue').html(resp.data.queue_no)
					$('#window').html(resp.data.wname)
				}
			})
			
		},1500)
	})

</script>