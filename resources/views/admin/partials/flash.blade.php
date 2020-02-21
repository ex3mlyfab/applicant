@if(Session::has('message'))
<script>
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
        jQuery(function(){ One.helpers('notify', {type: 'info', icon: 'fa fa-info-circle mr-1', message: '{{ Session::get('message') }}!'});
        });
            break;

        case 'warning':
        One.helpers('notify', {type: 'warning', icon: 'fa fa-info-exclamation mr-1', message: '{{ Session::get('message') }}!'});


        case 'success':
        jQuery(function(){ One.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: '{{ Session::get('message') }}!'});
        });
            break;

        case 'danger':

        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: '{{ Session::get('message') }}!'});
            break;
    }
</script>
@endif
@if($errors->any())
<script>
    $(document).ready(function () {
        @foreach($errors->all() as $error)

        One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: '{{ $error }}!'});


        @endforeach
    });
</script>
@endif
