<script>
  imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    userImg.src = URL.createObjectURL(file)
  }
}

  productInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    productImg.src = URL.createObjectURL(file)
  }
}
</script>
<script src="{{ asset('js/jquery.min.js')}}"></script> 
<script src="{{ asset('js/bootstrap.min.js')}}"></script>  
<script src="{{ asset('js/jquery.slimscroll.js')}}"></script> 
<script src="{{ asset('js/admin.js')}}"></script>
<script src="{{ asset('js/sweetalert.js')}}"></script>