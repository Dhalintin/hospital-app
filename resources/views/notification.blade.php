@if (session('success'))
    <div class="text-blue-500 notification">{{ session('success') }}</div>
@elseif(session('failed'))
    <div class="text-red-600 notification" >{{ session('failed') }}</div>
@endif


<script>
    setTimeout(function(){
        $(".notification").text("")
    },3000)
</script>
