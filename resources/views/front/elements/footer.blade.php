</body>
{!!HTML::script('front_name/js/jquery-1.12.1.min.js')!!}
{!!HTML::script('front_name/js/masonry.js')!!}
@yield('script')
    <script>
        $('#search_form').submit(function(e){
            var txt=$(this).find('input[name=search]').val();
            window.location='{{URL::route('letter')}}/'+txt;
            e.preventDefault();
        })
    </script>
</html>