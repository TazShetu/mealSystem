<script src="{{asset('v2/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('v2/vendor/popper.js/umd/popper.min.js')}}"> </script>
<script src="{{asset('v2/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('v2/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="{{asset('v2/js/front.js')}}"></script>


<script>
    $(function() {
        $('#sidebar li a').filter(function(){
            return this.href === location.href;
        }).addClass('active');
    });
</script>