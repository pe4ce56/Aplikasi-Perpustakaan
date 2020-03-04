@if (Session::has('sweet_alert.alert'))
<script>
   Swal.fire({
      text: "{!! Session::get('sweet_alert.text') !!}",
      title: "{!! Session::get('sweet_alert.title') !!}",
      @if(Session::get('sweet_alert.timer'))
        timer: {!! Session::get('sweet_alert.timer') !!},
      @endif
      icon: "{!! Session::get('sweet_alert.icon') !!}",
  });
</script>
@endif