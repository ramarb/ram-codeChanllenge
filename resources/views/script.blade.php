<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $(".container_list").children('div').each(function(){
            var arr = [];
            $(this).children('div').each(function(){
                var html = $(this).html();
                arr.push(html.trim())
            });

            //console.log(arr.join('|'));

            if(3 in arr){
                $.get('/admin/passers/1/edit',{'full_name':arr[1],'school':arr[3],'division':arr[4]})
            }

        });
    })
</script>
