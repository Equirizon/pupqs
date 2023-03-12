<script>
    function queueNow(){
        $.ajax({
            url:'ajax.php?action=update_queue',
            success:function(resp){
                resp = JSON.parse(resp)
                $('#sname').html(resp.data.name)
                $('#squeue').html(resp.data.queue_no)
                $('#window').html(resp.data.wname)
            }
        })
    }
</script>
<div>
    <a href="javascript:void(0)" onclick="queueNow()">Next Serve</a>
</div>
<div>
    <div><h3 class="text-center"><b>Now Serving</b></h3></div>
        <div>
            <h4 id="sname"></h4>
            <h3 id="squeue"></h3>
            <h5 id="window"></h5>
        </div>
    </div>
</div>