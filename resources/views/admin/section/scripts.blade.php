    

	
    <script src="{{ asset('js/manifest.js') }}" ></script>
    <script src="{{ asset('js/vendor.js') }}" ></script>
    <script src="{{ asset('js/admin.js') }}" ></script>    
	
	@yield('scripts')

	<script>
		setTimeout(function(){
			$('.alert').slideUp();
		} , 3000);
	</script>
</body>

</html>